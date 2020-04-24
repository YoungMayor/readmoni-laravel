<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider as RSP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use App\User;
use App\RegistrationPayments as PAYMENT;

use App\Http\Controllers\BalanceController;

use App\Facades\PAY;

class ActivateAccountController extends Controller
{
    public function showActivateAccountPage($key){
        $user = $this->pendingActivation($key, $red); 
        if ($red){
            return $red;
        }

        if ($user){
            return view(RSP::USER_ACTIVATE, [
                'user' => $user
            ]);
        }else{
            return redirect()->route("index");
        }
    }

    public function pendingActivation($key, &$red = false){
        $user = User::where("user_key", $key)->first(); 
        if (!$user){
            $red = redirect()->route('user.error.page')->with('note', "User Account is not registered");
            return false;
        }

        if ($user->account_activated == "y"){
            $red = redirect()->route("user.activate.success.page", [
                'key' => $key
            ]);
            return false;
            die();
        }

        return $user;
    }

    public function redirectToGateWay(Request $request){
        $key = $request->key;
        $user = $this->pendingActivation($key, $red); 
        if ($red){
            return $red;
        }

        if (!$user){
            return redirect()->route("index");
        }

        return PAY::toRegGateway($user);
    }

    
    public function handleGatewayCallback(){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');
  
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        $params = json_encode($_GET);
        
        if(!$reference){
            return redirect()->route("index");

            die('No reference supplied');
        }
        $redirect = false;
        $tranx = PAY::verifyRegRef($reference, $redirect);
        
        if ($redirect){
            return $redirect;
        }

        if(!$tranx->status){
            Log::channel('activation')->error("Paystack API Verification error: {$tranx->message}. Transaction Reference: {$reference}.");
    
            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }
  
        if($tranx->data->status == 'success'){
            $email = $tranx->data->customer->email;
            $key = $tranx->data->metadata->key; 
            $amount = $tranx->data->amount / 100; 

            $payment = Payment::updateorCreate(
                [
                    'user_key' => $key,
                    'transaction_reference' => $reference
                ], 
                [
                    'transaction_reference' => $reference, 
                    'amount' => $amount
                ]
            );

            $this->activateAccount($key);

            $user = User::where('user_key', $key)->first();
            $userID = $user->id;

            BalanceController::activationBonus($userID);
            BalanceController::payReferal($userID);

            return redirect()->route("user.activate.success.page", [
                'key' => $key
            ]);
        }

        Log::channel('activation')->error("Uncaught Payment Verification Failure");

        return redirect()->route("user.error.page")->with('error', "An error occurred");
    }

    protected function activateAccount($key){
        $user = User::where('user_key', $key)->first();
        $user->account_activated = 'y'; 
        $user->save();
    }

    public function showAccountActivatedPage($key){
        $user = User::where('user_key', $key)->first(); 
        return view(RSP::USER_ACTIVATED, [
            'key' => $user->user_key, 
            'name' => $user->full_name
        ]);
    }
}
