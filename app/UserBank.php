<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    protected $table = 'user_banks';
    protected $primaryKey = 'id';
  
    // public $timestamps = false;
  
    protected $guarded = [];
}
