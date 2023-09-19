<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelPost extends Model
{
    protected $table = 'channel_posts';
    protected $guarded = [];


    public function channel()
    {
        return $this->hasOne('App\Channel', 'id', 'channel_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function likes()
    {
        return $this->hasMany('App\PostReaction', 'post_id')->where('like',1);
    }

    public function disLikes()
    {
        return $this->hasMany('App\PostReaction', 'post_id')->where('like',0);
    }

    public function category()
    {
        return $this->belongsTo('App\ForumCategory','category_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('id', 'desc');
    }

    public function commentsCount()
    {
        $directCommentsIds = $this->comments->pluck('id');
        $repliesCount = Comment::whereIn('parent_id',$directCommentsIds)->count();

        return count($directCommentsIds) + $repliesCount;
    }

    
}
