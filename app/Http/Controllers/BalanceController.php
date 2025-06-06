<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\User\UserNotificationController;

use Illuminate\Support\Facades\DB;

use App\Balance;
use App\User;

class BalanceController extends Controller
{
    protected static function creditAccount($userID, $amt){
        return Balance::updateOrCreate(
            ['user_id' => $userID], 
            ['amount' => DB::raw("amount+$amt")]
        );
    }

    protected static function debitAccount($userID, $amt){
        return Balance::updateOrCreate(
            ['user_id' => $userID], 
            ['amount' => DB::raw("amount-$amt")]
        );
    }
    
    public static function activationBonus($id){
        self::creditAccount($id, config('app.REGISTRATION_BONUS'));
        
        UserNotificationController::accountActivated($id, config('app.REGISTRATION_BONUS'));

        return true;
    }
    
    public static function payoutMade($userID, $amount, $request_id){
        self::debitAccount($userID, $amount);
        
        UserNotificationController::payoutMade($request_id);

        return true;
    }

    public static function readBonus($id){
        return self::creditAccount($id, config('app.READ_BONUS'));
    }

    public static function payReferal($id){
        $user = User::find($id);
        $referer = User::where('user_key', $user->referer)->first();
        if (!$referer){
            return false;
        }
        $refererID = $referer->id;

        self::creditAccount($refererID, config('app.REFERAL_BONUS'));
        
        UserNotificationController::referalBonus($refererID, $user->full_name, config('app.REFERAL_BONUS'));

        return true;
    }

    public static function userBalance($id){
        return Balance::where('user_id', $id)->first()->amount ?? 0;
    }

    public static function totalPendingFunds(){
        return Balance::get()->sum('amount');
    }
}
