<?php

namespace App\Facades; 

use Illuminate\Support\Facades\Facade;

class PAY extends Facade{
    protected static function getFacadeAccessor(){
        return 'PaystackPay';
        // return 'FlutterwavePay';
    }
}