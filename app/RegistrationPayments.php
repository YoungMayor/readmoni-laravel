<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationPayments extends Model
{
    protected $table = 'registration_payments';
    protected $primaryKey = 'id';
  
    // public $timestamps = false;
  
    protected $guarded = [];
}
