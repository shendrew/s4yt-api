<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPartner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
    ];

    public function question()
    {
        return $this->hasOne('App\Models\Question');
    }

    public function visit()
    {
        return $this->hasMany('App\Models\Visit');
    }
}
