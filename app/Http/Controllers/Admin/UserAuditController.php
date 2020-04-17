<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\PayoutController;
use App\Http\Controllers\User\UserNotificationController;
use App\Providers\RouteServiceProvider as RSP;
use App\User;
use App\UserBank;
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
}
