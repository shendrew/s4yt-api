<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coin_id',
        'coin_action_id',
        'action_by'
    ];
}
