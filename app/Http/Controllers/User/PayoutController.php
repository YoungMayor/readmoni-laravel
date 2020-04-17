<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Controller;

use App\Payout;
use App\User;
use App\UserBank;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function request(Request $request){
        $minPyt = config('app.MINIMUM_PAYOUT'); 
        $pytFactor = config('app.PAYOUT_FACTOR'); 

        $userBalance = BalanceController::userBalance(Auth::id());
        if ($userBalance < $minPyt){
            $minPytFMT = number_format($minPyt, 2);
            return redirect()->route('user.error.page')->with([
                'note' => "Insufficient funds, you need a minimum of N$minPytFMT before you can make payment requests"
            ]);
        }

        $pendigPyt = self::pendingPayout(Auth::id());
        if ($pendigPyt){
            return redirect()->route('user.error.page')->with([
                'note' => "We apologise for delay. Your payment has been received and is being processed"
            ]);
        }

        $validBank = $this->validBankDetails(Auth::user()->user_key);
        if (!$validBank){
            return redirect()->route('user.error.page')->with([
                'note' => "Payments cannot be made because your bank account is not setup. Please visit your Profile and setup your account"
            ]);
        }

        $payable = number_format(self::payableAmount($userBalance), 2); 
        $this->saveRequest(Auth::id());

        return redirect()->route('user.success.page')->with([
            'note' => "Your payment request has been received. Your expected payment is N$payable. Read and earn more!!!"
        ]);
    }

    public static function pendingPayout($id){
        return Payout::where('user_id', $id)->whereNull('paid_amt')->count();
    }

    public static function totalPending(){
        return Payout::whereNull('payee_id')->whereNull('paid_amt')->whereNull('payout_code')->count();
    }

    public static function payableAmount($amount){
        $factor = config('app.PAYOUT_FACTOR');
        return $amount - ($amount % $factor);
    }

    protected function saveRequest($id){
        UserNotificationController::paymentRequest($id);
        
        return Payout::create([
            'user_id' => $id
        ]);
    }

    protected function validBankDetails($userKey){
        return UserBank::where('user_key', $userKey)->whereNotNull('account_number')->whereNotNull('recipient_code')->count();
    }
}
