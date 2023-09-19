<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

use App\Helpers\Helper;

use App\Category;

use Setting;

class City extends Model
{

	public $fillable = ['name','state_id'];
}
