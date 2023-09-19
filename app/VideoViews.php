<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoViews extends Model
{
    //
    public $fillable = ['id','video_id','ip','user_id'];
}