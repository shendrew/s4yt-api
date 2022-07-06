<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public static function currentVersion()
    {
        return (self::where('active', true)->first())->id;
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
