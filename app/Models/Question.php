<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question'
    ];

    public function event_partner()
    {
        return $this->belongsTo('App\Models\EventPartner');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
