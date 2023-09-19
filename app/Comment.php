<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $appends = ['replies_count'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }
}
