<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'education_id',
        'grade_id',
        'country',
        'state',
        'city_id'
    ];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function education() : HasOne {
        return $this->HasOne(Education::class);
    }

    public function grade() : HasOne {
        return $this->HasOne(Grade::class);
    }
}
