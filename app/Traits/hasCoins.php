<?php

namespace App\Traits;

use App\Configuration;

trait HasCoins
{

    protected static function bootHasCoins()
    {
        static::creating(function ($model) {
           $model->coins = (int)Configuration::getValueByKey(Configuration::INITIAL_COINS);
        });
    }

}
