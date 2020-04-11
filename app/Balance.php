<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'balances';
    protected $primaryKey = 'id';
  
    // public $timestamps = false;
  
    protected $guarded = [];
}
