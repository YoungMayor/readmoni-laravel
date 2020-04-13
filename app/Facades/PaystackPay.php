<?php

namespace App\Facades; 

use Illuminate\Support\Facades\Facade;

class PaystackPay extends Facade{
    protected static function getFacadeAccessor(){
        return 'PaystackPay';
    }
}