<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\PayoutController;
use App\Http\Controllers\User\UserNotificationController;
use App\Providers\RouteServiceProvider as RSP;
use App\User;
use App\UserBank;
use App\Payout;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuditController extends Controller
{
    public function show(Request $request, $user_key){
        $user = User::where('user_key', $user_key)->first();
        $bank = UserBank::where('user_key', $user_key)->first();
        $userBalance =  BalanceController::userBalance($user->id);
        $payable = PayoutController::payableAmount($userBalance);

        return view(RSP::ADMIN_AUDIT, [
            'user' => $user,
            'bank' => $bank,
            'balance' => [
                'total' => number_format($userBalance, 2), 
                'payable' => number_format($payable, 2), 
                'reminant' => number_format($userBalance - $payable, 2)
            ], 
            'requested' => PayoutController::pendingPayout($user->id)
        ]);
    }

    public function sendMessage(Request $request){
        $messageTypes = ['p', 'n'];

        $vRule = [
            'recipent' => [
                'required', 
                'exists:users,id'
            ], 
            'message' => [
                'required',
                'string', 
                'min:8', 
                'max:255'
            ],
            'type' => [
                'required', 
                Rule::in($messageTypes)
            ]
        ];

        $vMsg= [
            'recipent.required' => 'An error occurred. Please reload this Page.', 
            'recipent.exists' => 'An error occurred. Please reload this page, if problem persist, report to the Developer', 
            'message' => 'Sending blank messages is not allowed', 
            'message.string' => 'The message must be of type text', 
            'message.min' => 'Message length too short', 
            'message.max' => 'Message length too long. Keep messages short and descriptive'
        ];

        $validator = Validator::make($request->all(), $vRule, $vMsg);

        if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
        }

        switch ($request->type) {
            case 'p':
                UserNotificationController::customSuccess($request->recipent, $request->message, Auth::id());
                break;
            
            case 'n':
                UserNotificationController::customError($request->recipent, $request->message, Auth::id());
                break;
        }

        $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Message sent"])->render();
      
        return json_encode($response);
    }

    public function getHistory(Request $request){
        $vRule = [
            'page' => [
                'required', 
                'numeric'
            ], 
            'user' => [
                'required', 
                'exists:users,id',
            ], 
            'type' => [
                'required', 
                Rule::in(['payment', 'transfer'])
            ]
        ];

        $validator = Validator::make($request->all(), $vRule);

        if ($validator->fails()) {
            $response['list'] = [];
            $response['next'] = $request->page;
            return json_encode($response);
        }

        switch ($request->type) {
            case 'payment':
                return $this->getPayment($request);
                break;
            
            case 'transfer':
                //
                break;
        }

        $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Message sent"])->render();
      
        return json_encode($response);
    }

    protected function getPayment(Request $request){
        $payments = Payout::where('user_id', $request->user)
                    ->join('users', 'payouts.payee_id', 'users.id')
                    ->select('*', 'payouts.updated_at AS pay_date')
                    ->latest('payouts.updated_at')
                    ->simplePaginate();
        
        $list = [];
        $ind = 0;
        foreach($payments as $thisPayment){
            $list[$ind] = [
                'dte' => date("jS, M, y", strtotime($thisPayment->pay_date)),
                'nme' => $thisPayment->full_name, 
                'amt' => number_format($thisPayment->paid_amt, 2), 
                'cls' => $thisPayment->payout_code == 'cancelled'? 'table-danger' : 'table-success'
            ];
            $ind++;
        }
        
        if ($list){
            $response['list'] = $list;
            $response['next'] = $payments->currentPage() + 1;
        }else{
            $response['list'] = [];
            $response['next'] = $payments->currentPage();
        }

        return json_encode($response);
    }
}
