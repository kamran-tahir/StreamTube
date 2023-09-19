<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

use App\Helpers\Helper;

use App\Category;

use Setting;

class States extends Model
{

	public $fillable = ['name','country_id'];
}
