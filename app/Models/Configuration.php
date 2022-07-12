<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Configuration extends Model
{
    const REGISTER_COINS = 'register_coins';
    const MAX_REVIEWERS = 'max_reviewers';
    const MAX_AMOUNT_REWARDS = 'max_amount_awards';
    const MAX_EVENT_PARTNERS = 'max_event_partners';
    const GAME_START = 'game_start';
    const GAME_END = 'game_end';
    const WINNERS_ANNOUNCED = 'winners_announced';
    const LOGIN_DISABLED = 'login_disabled';
    const DEFAULT_PASSWORD = 'default_password';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key'
    ];

    public function versions()
    {
        return $this->belongsToMany('App\Models\Version')->withPivot('value');
    }

    public static function getValueByKey(string $key)
    {
        $version_id = Cache::remember('current_version', 60*60*24*28, function() {
            return Version::currentVersion();
        });
        return ((self::where('key', $key)->first())->versions()->where('version_id', $version_id)->select('value')->get())[0]->value;
    }
}
