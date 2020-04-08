<?php

namespace App\Facades; 

use Illuminate\Support\Facades\Facade;

class ReadMoni extends Facade{
    protected static function getFacadeAccessor(){
        return 'ReadMoni';
    }
}