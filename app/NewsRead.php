<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsRead extends Model
{
    protected $table = 'news_reads';
    protected $primaryKey = 'id';
  
    // public $timestamps = false;
  
    protected $guarded = [];
}
