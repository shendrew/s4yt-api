<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function sponsorable()
    {
        return $this->morphTo();
    }
}
