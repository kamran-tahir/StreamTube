<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelVerification extends Model
{
    protected $table = 'channel_verification';
    protected $guarded = [];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(States::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function selfImage()
    {
        return $this->morphOne(Attachment::class, 'attachable')->where('type','self');
    }

    public function idFrontImage()
    {
        return $this->morphOne(Attachment::class, 'attachable')->where('type','id_front');
    }

    public function idBackImage()
    {
        return $this->morphOne(Attachment::class, 'attachable')->where('type','id_back');
    }
}
