<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserNotification;
use App\User;

class UserNotificationController extends Controller
{
    public static $catICON = [
        'act' => '', #use check
        'ref' => '', #referal
        ''
    ];
    protected static function saveNotification($id, $note, $cat){
        return UserNotification::create([
            'user_id' => $id, 
            'note' => $note, 
            'category' => $cat
        ]);
    }

    public static function accountActivated($id, $amt){
        $user = User::find($id);
        if (!$user){
            return false;
        }
        $name = $user->full_name;
        $amt = number_format($amt, 2);

        self::saveNotification($id, "Congratulations $name, Your Account was successfully activated. And your funds have been credited with N$amt. Read and earn more!!!", 'act');

        return true;
    }

    public static function referalBonus($refererID, $refererName, $amt){
        $amt = number_format($amt, 2);

        self::saveNotification($refererID, "N$amt has been received as referal bonus from $refererName", 'ref');

        return true;
    }
}
