<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function sponsorable()
    {
        return $this->morphTo();
    }

    protected $fillable = [
        'name'
    ];
}

class Business_Sponsor extends Model
{
    public function sponsor()
    {
        return $this->morphOne('App\Sponsor', 'sponsorable');
    }
}

class Raffle_Sponsor extends Model
{
    public function sponsor()
    {
        return $this->morphOne('App\Sponsor', 'sponsorable');
    }
}

class Partner_Sponsor extends Model
{
    public function sponsor()
    {
        return $this->morphOne('App\Sponsor', 'sponsorable');
    }
}
