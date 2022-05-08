<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    const INITIAL_COINS = "initial_coins";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Get the value of config with key as needle
     *
     * @param string $key
     * @return mixed
     */
    public static function getValueByKey(string $key)
    {
        return (self::where('key', $key)->first())->value;
    }
}
