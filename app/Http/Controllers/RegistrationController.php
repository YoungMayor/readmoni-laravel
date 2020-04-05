<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider as RSP;
use App\User;

class RegistrationController extends Controller
{
    public static function createKey(){
        $allAlphas = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $shuffled = str_shuffle($allAlphas);
        $firstTwoLetters = substr($shuffled, 0, 2);
        $lastLetter = substr($shuffled, -1);
        $btwNos = str_pad(rand(100, 9999), 4, 0, STR_PAD_LEFT);

        $generatedKey = $firstTwoLetters . "-" . $btwNos . $lastLetter;
        $user = User::where("user_key", $generatedKey)->first();

        if ($user) {
            return self::createKey();
        } else {
            return $generatedKey;
        }
    }

    public function showRegistrationForm(){
        return view(RSP::USER_REG_FIRST, [
            'key' => self::createKey()
        ]);
    }

    public function registerAccount(Request $request){
        //
    }
}
