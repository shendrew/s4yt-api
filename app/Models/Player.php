<?php

namespace App\Models;

use App\Traits\HasCoins;
use App\Traits\Referable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Player extends Model implements HasMedia
{
    use Referable, HasCoins, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade_id',
        'education_id',
        'country_iso',
        'state_iso',
        'city_id'
    ];

    /**
     * Get the player's user.
     */
    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }
}
