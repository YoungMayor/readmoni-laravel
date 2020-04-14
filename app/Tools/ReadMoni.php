<?php

namespace App\Tools; 

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserNotificationController AS NOTIF;
use App\Facades\PaystackPay;

use App\User;

class ReadMoni{
    protected $imgPATH = "assets/img";
    protected $genderMapping = [
        'm' => 'Male', 
        'f' => 'Female', 
        'u' => 'Rather Not Say'
    ];
    public const CHAT_NAME_REGEX = "/^[A-z][A-z0-9\.\_]{3,23}$/";

    public function sayHello(){
        echo "Hello World";
    }

    public function avatar($id = false){
        if (!$id){
            $id = Auth::id();
        }
        $user = User::where('user_key', $id)->orWhere('id', $id)->orWhere('email', $id)->orwhere('chat_name', $id)->first();

        if (!$user){
            return asset("$this->imgPATH/no_user.png");
        }
        $userAvatar = $user->avatar;
        if ($userAvatar && Storage::disk('avatar')->exists($userAvatar)){
            return Storage::disk('avatar')->url($userAvatar);
        }else{
            return asset("$this->imgPATH/default_avatar.png");
        }
    }

    public function beautyDate($expression){
        if (!$expression){
            $time = time();
        }else{
            $time = strtotime($expression);
        }
        return date("F d, Y", $time);
    }

    public function parseGender($expression){
        return $this->genderMapping[$expression] ?? $this->genderMapping['u'];
    }

    public function genderSelect($val){
        $markup = "";
        foreach ($this->genderMapping as $id => $label){
            if ($val == $id){
                $checked = "checked='true'";
            }else{
                $checked = "";
            }
            $markup .= <<<HTML_
        <div class="custom-control custom-control-inline custom-radio">
            <input class="custom-control-input" type="radio" id="gender_$id" name="gender" value="$id" required="" $checked>
            <label class="custom-control-label" for="gender_$id">$label</label>
        </div>
HTML_;
        }
        return $markup;
    }

    public function notificationIconMap(){
        $map = json_encode(NOTIF::$catICON);

            return <<<SCRIPT_
            <script>
                var notificationsIconMap = $map
            </script>
SCRIPT_;
    }

    public function unreadNotifications(){
        $count = NOTIF::unreadNotificationCount();
            return <<<HTML_
            <span class="badge badge-danger badge-counter">$count</span>
HTML_;
    }

    public function bankSelectOptions(){
        $banks = PaystackPay::getAllBanks();
        $banks->each(function($bank){
            echo "<option value='{$bank['short_name']}'>{$bank['full_name']}</option>";
        });
    }
}