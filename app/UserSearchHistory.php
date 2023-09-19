<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSearchHistory extends Model
{
    protected $guarded = [];

    protected $table = 'user_search_history';
    
    
    public function videoTape() {
        return $this->belongsTo('App\VideoTape','video_id','id')
                ->leftJoin('channels' , 'video_tapes.channel_id' , '=' , 'channels.id')
                ->videoResponse();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
