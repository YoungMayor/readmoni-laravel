<?php

namespace App\Tools; 

use Illuminate\Support\Facades\Auth;

class PaystackPay{
    public const BANKS = [
        [
            'id' => '1', 
            'full_name' => 'Access Bank', 
            'short_name' => 'acc', 
            'full_code' => '044150149', 
            'short_code' => '044', 

        ],
        [
            'id' => '27', 
            'full_name' => 'ALAT by WEMA', 
            'short_name' => 'alat', 
            'full_code' => '035150103', 
            'short_code' => '035A', 
            
        ],
        [
            'id' => '2', 
            'full_name' => 'CitiBank Nigeria', 
            'short_name' => 'citi', 
            'full_code' => '023150005', 
            'short_code' => '023', 
            
        ],
        [
            'id' => '3', 
            'full_name' => 'Diamond Access Bank', 
            'short_name' => 'dab', 
            'full_code' => '063150162', 
            'short_code' => '063', 

        ],
        [
            'id' => '4', 
            'full_name' => 'Ecobank Nigeria', 
            'short_name' => 'eco', 
            'full_code' => '050150010', 
            'short_code' => '050', 

        ],
        [
            'id' => '6', 
            'full_name' => 'Fidelity Bank', 
            'short_name' => 'fid', 
            'full_code' => '070150003', 
            'short_code' => '070', 

        ],
        [
            'id' => '7', 
            'full_name' => 'First Bank of Nigeria', 
            'short_name' => 'fbn', 
            'full_code' => '011151003', 
            'short_code' => '011', 

        ],
        [
            'id' => '8', 
            'full_name' => 'First City Monument Bank', 
            'short_name' => 'fcmb', 
            'full_code' => '214150018', 
            'short_code' => '214', 

        ],
        [
            'id' => '9', 
            'full_name' => 'Guaranty Trust Bank', 
            'short_name' => 'gtb', 
            'full_code' => '058152036', 
            'short_code' => '058', 

        ],
        [
            'id' => '10', 
            'full_name' => 'Heritage Bank', 
            'short_name' => 'htb', 
            'full_code' => '030159992', 
            'short_code' => '030', 

        ],
        [
            'id' => '11', 
            'full_name' => 'Keystone Bank', 
            'short_name' => 'ksb', 
            'full_code' => '082150017', 
            'short_code' => '082', 

        ],
        [
            'id' => '13', 
            'full_name' => 'Polaris Bank', 
            'short_name' => 'pol', 
            'full_code' => '076151006', 
            'short_code' => '076', 

        ],
        [
            'id' => '14', 
            'full_name' => 'Stanbic IBTC Bank', 
            'short_name' => 'stan', 
            'full_code' => '221159522', 
            'short_code' => '221', 

        ],
        [
            'id' => '15', 
            'full_name' => 'Standard Chartered Bank', 
            'short_name' => 'scb', 
            'full_code' => '068150015', 
            'short_code' => '068', 

        ],
        [
            'id' => '16', 
            'full_name' => 'Sterling Bank', 
            'short_name' => 'ster', 
            'full_code' => '232150016', 
            'short_code' => '232', 

        ],
        [
            'id' => '17', 
            'full_name' => 'Union Bank of Nigeria', 
            'short_name' => 'unib', 
            'full_code' => '032080474', 
            'short_code' => '032', 

        ],
        [
            'id' => '18', 
            'full_name' => 'United Bank for Africa', 
            'short_name' => 'uba', 
            'full_code' => '033153513', 
            'short_code' => '033', 

        ],
        [
            'id' => '19', 
            'full_name' => 'Unity Bank', 
            'short_name' => 'unit', 
            'full_code' => '215154097', 
            'short_code' => '215', 

        ],
        [
            'id' => '20', 
            'full_name' => 'Wema Bank', 
            'short_name' => 'wem', 
            'full_code' => '035150103', 
            'short_code' => '035', 

        ],
        [
            'id' => '21', 
            'full_name' => 'Zenith Bank', 
            'short_name' => 'zen', 
            'full_code' => '057150013', 
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

    public static function verifyAccount($account_num, $code){
        $secretKey = config('app.PAYSTACK_SECRET_KEY');

        $bank = self::getBank($code);
        if (!$bank){
            return false;
        }

        $bankCode = $bank['short_code'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=$account_num&bank_code=$bankCode",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
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
        return [
            'name' => $reply->data->account_name, 
            'number' => $reply->data->account_number, 
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
}