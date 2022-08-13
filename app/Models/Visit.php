<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'last_visited'
    ];

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public function event_partner()
    {
        return $this->belongsTo('App\Models\EventPartner');
    }
}
