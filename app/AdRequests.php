<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdRequests extends Model
{
    protected $fillable = ['first_name','last_name','email','phone','address','ad_type','ad_time','ad_duration','url','file','updated_at','created_at'];
  
}
