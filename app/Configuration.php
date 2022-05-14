<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    const INITIAL_COINS = "initial_coins";
    const GAME_START = 'game_start';
    const GAME_END = 'game_end';
    const WINNERS_ANNOUNCED = 'winners_announced';
    const LOGIN_DISABLED = 'login_disabled';


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
