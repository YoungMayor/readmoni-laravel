<?php

namespace App\Http\Controllers\Admin;

use App\Facades\PaystackPay AS PAY;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\PayoutController as UserPayoutController;
use App\Http\Controllers\User\UserNotificationController;
use App\Payout;
use App\Providers\RouteServiceProvider AS RSP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function show(Request $request){
        $payStackBal = PAY::getBAlance();
        $userFunds = BalanceController::totalPendingFunds();

        $reminant = abs($payStackBal - $userFunds); 
        $class = $payStackBal > $userFunds ? 'success' : 'danger' ;

        $pendingPay = UserPayoutController::totalPending();

        return view(RSP::ADMIN_PAYOUT, [
            'PS_Bal' => number_format($payStackBal, 2), 
            'User_Fund' => number_format($userFunds, 2), 
            'reminant' => number_format($reminant, 2), 
            'rem_class' => $class , 
            'pending' => number_format($pendingPay)
        ]);
    }

    public function retrieve(Request $request){
        $payouts = Payout::whereNull('payee_id')
                            ->whereNull('paid_amt')
                            ->whereNull('payout_code')
                            ->join('users', 'payouts.user_id', 'users.id')
                            ->join('balances', 'payouts.user_id', 'balances.user_id')
                            ->select('*', 'payouts.id as req_id', 'users.id as user_id')
                            ->latest()
                            ->simplePaginate(25);

        $payoutList = [];
        $ind = 0;
        foreach($payouts as $thisPayout){
            $amount = UserPayoutController::payableAmount($thisPayout->amount); 

            $payoutList[$ind] = [
                'key' => $thisPayout->user_key, 
                'nme' => $thisPayout->full_name,
                'csh_rw' => $amount,
                'csh_fm' => number_format($amount, 2), 
                /** 'uid' => $thisPayout->user_id, */
                'rid' => $thisPayout->req_id, 
                'aud' => route('admin.audit.page', [
                    'user_key' => $thisPayout->user_key
                ])
            ];
            $ind++;
        }
        
        if ($payoutList){
            $response['list'] = $payoutList;
            $response['next'] = $payouts->currentPage() + 1;
        }else{
            $response['list'] = [];
            $response['next'] = $payouts->currentPage();
        }
        return json_encode($response);
    }

    public function cancelPayout($user_id){
        $payout = Payout::where('user_id', $user_id)->whereNull('paid_amt')->latest()->first();

        if (!$payout){
            return redirect()->back();
        }
        if (UserPayoutController::pendingPayout($user_id)){
            $payoutID = $payout->id;
            $payout->fill([
                'payee_id' => Auth::id(), 
                'paid_amt' => 0, 
                'payout_code' => 'cancelled'
            ]);
            $payout->save();
            UserNotificationController::payoutCancelled($payoutID);
        }
        return redirect()->back();
    }

    public function massPayout(Request $request){
        // dd($request->all());
    }
}
