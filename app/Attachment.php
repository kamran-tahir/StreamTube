<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';
    protected $guarded = [];


    public function attachable()
    {
        return $this->morphTo();
    }
}
