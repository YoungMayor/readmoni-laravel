<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Providers\RouteServiceProvider as RSP;

use App\User;
use App\RegistrationPayments as PAYMENT;

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

        
        $email = $user->email;
        $full_name = $user->full_name;
        $metadata = [
            'full_name' => $full_name, 
            'key' => $key
        ];
        $amount = config("app.REGISTRATION_FEE") * 100; 
        
        $secretKey = config('app.PAYSTACK_SECRET_KEY');
        
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email, 
                'metadata' => json_encode($metadata)
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer $secretKey",
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));
        
        $response = curl_exec($curl);

        $err = curl_error($curl);

        if($err){
            Log::channel('activation')->error("Redirect To Paystack Gateway Failed. cUrl returned: $err. For User: {$key}");

            return redirect()->route("user.error.page")->with('error', "An error occurred during payment");

            die();
        }

        $tranx = json_decode($response);

        if(!$tranx->status){
            Log::channel('activation')->error("Paystack API Transaction error: {$tranx->message}. For User: {$key}. Full Error: {$response}");

            return redirect()->route("user.error.page")->with('error', "An error occurred during payment");

            die();
        }

        return redirect($tranx->data->authorization_url);
    }

    
    public function handleGatewayCallback(){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');
  
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        $params = json_encode($_GET);
        
        if(!$reference){
            return redirect()->route("index");

            die('No reference supplied');
        }
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer $secretKey",
                "cache-control: no-cache"
            ],
        ));
  
        $response = curl_exec($curl);
        $err = curl_error($curl);
  
        if($err){
            Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }
  
        $tranx = json_decode($response);
  
        if(!$tranx->status){
            Log::channel('activation')->error("Paystack API Verification error: {$tranx->message}. Transaction Reference: {$reference}. Full Error: {$response}");
    
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

            return redirect()->route("user.activate.success.page", [
                'key' => $key
            ]);

            // Credit User start balance
            // Credit referer ref bonus
            // redirect to dashboard

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
