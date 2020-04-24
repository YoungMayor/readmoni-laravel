<?php

namespace App\Facades; 

use Illuminate\Support\Facades\Facade;

class FlutterwavePay extends Facade{
    protected static function getFacadeAccessor(){
        return 'FlutterwavePay';
    }
}