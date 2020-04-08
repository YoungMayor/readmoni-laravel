<?php

namespace App\Tools; 

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\User;

class ReadMoni{
    protected $imgPATH = "assets/img";

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
}