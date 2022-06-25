<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Raffle_Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'stock'
    ];

    public function version_user() : HasOne {
        return $this->hasOne(version_users::class);
    }
}
