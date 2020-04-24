<?php

/**
 * Mechanism build incomplete
 */

namespace App\Tools; 

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class FlutterwavePay{
    public const BANKS = [
        [
            'id' => '191', 
            'full_name' => 'Access Bank', 
            'short_name' => 'acc', 
            'full_code' => '044', 
            'short_code' => '044', 

        ],
        /** 
        [
            'id' => '27', 
            'full_name' => 'ALAT by WEMA', 
            'short_name' => 'alat', 
            'full_code' => '035150103', 
            'short_code' => '035A', 
            
        ], 
        */
        [
            'id' => '145', 
            'full_name' => 'CitiBank Nigeria', 
            'short_name' => 'citi', 
            'full_code' => '023', 
            'short_code' => '023', 
            
        ],
        [
            'id' => '170', 
            'full_name' => 'Diamond Access Bank', 
            'short_name' => 'dab', 
            'full_code' => '063', 
            'short_code' => '063', 

        ],
        [
            'id' => '152', 
            'full_name' => 'Ecobank Nigeria', 
            'short_name' => 'eco', 
            'full_code' => '050', 
            'short_code' => '050', 

        ],
        [
            'id' => '144', 
            'full_name' => 'Fidelity Bank', 
            'short_name' => 'fid', 
            'full_code' => '070', 
            'short_code' => '070', 

        ],
        [
            'id' => '137', 
            'full_name' => 'First Bank of Nigeria', 
            'short_name' => 'fbn', 
            'full_code' => '011', 
            'short_code' => '011', 

        ],
        [
            'id' => '186', 
            'full_name' => 'First City Monument Bank', 
            'short_name' => 'fcmb', 
            'full_code' => '214', 
            'short_code' => '214', 

        ],
        [
            'id' => '177', 
            'full_name' => 'Guaranty Trust Bank', 
            'short_name' => 'gtb', 
            'full_code' => '058', 
            'short_code' => '058', 

        ],
        [
            'id' => '175', 
            'full_name' => 'Heritage Bank', 
            'short_name' => 'htb', 
            'full_code' => '030', 
            'short_code' => '030', 

        ],
        [
            'id' => '181', 
            'full_name' => 'Keystone Bank', 
            'short_name' => 'ksb', 
            'full_code' => '082', 
            'short_code' => '082', 

        ],
        /**
        [
            'id' => '13', 
            'full_name' => 'Polaris Bank', 
            'short_name' => 'pol', 
            'full_code' => '076151006', 
            'short_code' => '076', 

        ],
        */
        [
            'id' => '180', 
            'full_name' => 'Skye Bank', 
            'short_name' => 'skye', 
            'full_code' => '076', 
            'short_code' => '076', 

        ],
        [
            'id' => '158', 
            'full_name' => 'Stanbic IBTC Bank', 
            'short_name' => 'stan', 
            'full_code' => '221', 
            'short_code' => '221', 

        ],
        [
            'id' => '142', 
            'full_name' => 'Standard Chartered Bank', 
            'short_name' => 'scb', 
            'full_code' => '068', 
            'short_code' => '068', 

        ],
        [
            'id' => '179', 
            'full_name' => 'Sterling Bank', 
            'short_name' => 'ster', 
            'full_code' => '232', 
            'short_code' => '232', 

        ],
        [
            'id' => '190', 
            'full_name' => 'Union Bank of Nigeria', 
            'short_name' => 'unib', 
            'full_code' => '033', 
            'short_code' => '033', 

        ],
        [
            'id' => '178', 
            'full_name' => 'United Bank for Africa', 
            'short_name' => 'uba', 
            'full_code' => '032', 
            'short_code' => '032', 

        ],
        [
            'id' => '146', 
            'full_name' => 'Unity Bank', 
            'short_name' => 'unit', 
            'full_code' => '215', 
            'short_code' => '215', 

        ],
        [
            'id' => '168', 
            'full_name' => 'Wema Bank', 
            'short_name' => 'wem', 
            'full_code' => '035', 
            'short_code' => '035', 

        ],
        [
            'id' => '141', 
            'full_name' => 'Zenith Bank', 
            'short_name' => 'zen', 
            'full_code' => '057', 
            'short_code' => '057', 

        ],
    ];

    public static function getAllBanks(){
        return collect(self::BANKS);
    }

    public static function shortCodeToBank($shortCode){
        $banks = self::getAllBanks(); 
        return $banks->firstWhere('short_code', $shortCode) ?? null;
    }

    public static function shortNameToBank($shortCode){
        $banks = self::getAllBanks(); 
        return $banks->firstWhere('short_name', $shortCode) ?? null;
    }

    public static function getBank($code){
        return self::shortCodeToBank($code) ?? self::shortNameToBank($code) ?? false;
    }

    public static function toRegGateway(User $user){
        $email = $user->email;
        $full_name = $user->full_name;
        $key = $user->user_key;
        
        $metadata = [
            'full_name' => $full_name, 
            'key' => $key
        ];
        $amount = config("app.REGISTRATION_FEE") * 100; 
        
        $secretKey = config('app.FLUTTERWAVE_SECRET_KEY');
        $pubKey = config('app.FLUTTERWAVE_PUBLIC_KEY');
        
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'customer_email' => $email, 
                'currency' => 'NGN', 
                'txref' => 'REG_PYT-'.$key.uniqid(),
                'PBFPubKey' => $pubKey,
                'metadata' => json_encode($metadata), 
                'redirect_url' => route('user.activate.confirm.process')
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

        if(!$tranx->data && !$tranx->data->link){
            Log::channel('activation')->error("Flutterwave API Transaction error: {$tranx->message}. For User: {$key}. Full Error: {$response}");

            return redirect()->route("user.error.page")->with('error', "An error occurred during payment");

            die();
        }

        return redirect($tranx->data->link);
    }

    public static function verifyRegRef($reference, &$redirect = false){
        $secretKey = config('app.FLUTTERWAVE_SECRET_KEY');
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode([
                'SECKEY' => $secretKey,
                'txref' => $reference,
            ]),
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

            $redirect = redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }
  
        return json_decode($response);
    }


    public static function verifyAccount($account_num, $code){
        $secretKey = config('app.FLUTTERWAVE_SECRET_KEY');
        $publicKey = config('app.FLUTTERWAVE_PUBLIC_KEY');

        $bank = self::getBank($code);
        if (!$bank){
            return false;
        }

        $bankCode = $bank['short_code'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/resolve_account",
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'recipientaccount' => $account_num,
            'destbankcode' => $bankCode, 
            'PBFPubKey' => $publicKey
        ]),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }

        $reply = json_decode($response);
        echo $account_num;
        echo $bankCode;
        dd($reply);
        if (!$reply->data->data->responsecode == "00"){
            return false;
        }
        return [
            'name' => $reply->data->data->accountname, 
            'number' => $reply->data->data->accountnumber, 
        ];
    }

    public static function createRecipent($name, $num, $desc, $code){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transferrecipient",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'type' => 'nuban',
            'name' => "$name", 
            'description' => "$desc",
            'account_number' => "$num",
            'bank_code' => "$code",
            'currency' => "NGN",
        ]),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }

        $reply = json_decode($response);
        if (!$reply->status){

            return false;
        }
        return $reply->data->recipient_code;
    }

    public static function payRecipent($amount, $recipient, $reason){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transfer",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'source' => 'balance',
            'amount' => $amount, 
            'recipient' => "$recipient",
            'reason' => "$reason",
        ]),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }

        $reply = json_decode($response);
        if ($reply->status != true || $reply->status != "pending"){
            return false;
        }
        return $reply->data->transfer_code;
    }

    /**
     * Make Bulk Payments to a collection of users. 
     * 
     * @todo Verify PayStack Account and remove the hack line on this method
     *
     * @param [collection] $payouts A collection of users built up of
     * Payout, User, Balance, UserBank
     * @return boolean
     */
    public static function payRecipient_bulk($payouts){
        return true; /** Hack Line  */

        $transfers = [];
        foreach ($payouts as $payout){
            $transfers[] = [
                'amount' => $payout->paid_amount,
                'recipient' => $payout->recipient_code, 
                'reference' => $payout->payout_code
            ];
        }
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transfer",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'source' => 'balance',
            'currency' => 'NGN', 
            'transfers' => $transfers
        ]),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }

        $reply = json_decode($response);
        if ($reply->status != true || $reply->status != "pending"){
            return false;
        }
        return $reply->data;
    }

    public static function getAllRecipents($page, $count){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transferrecipient",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return redirect()->route("user.error.page")->with('error', "An error occurred");

            die();
        }

        $reply = json_decode($response);

        if (!$reply->status){
            return false;
        }
        return $reply;
    }


    public static function getBalance(){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/balance",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "content-type: application/json",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            /**
             * @todo Log Error to paystack channel
             * // Log::channel('activation')->error("Payment Verification failed. cUrl returned: $err. Transaction Reference: {$reference}");
             */

            return 0;

            die();
        }

        $reply = json_decode($response);
        if ($reply->status != true){
            return 0;
        }

        return $reply->data[0]->balance ?? 0;
    }
}