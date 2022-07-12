<?php

namespace App\Traits;

use App\Models\Configuration;

trait HasCoins
{

    protected static function bootHasCoins()
    {
        static::creating(function ($model) {
           $model->coins = (int)Configuration::getValueByKey(Configuration::REGISTER_COINS);;
        });
    }

}
