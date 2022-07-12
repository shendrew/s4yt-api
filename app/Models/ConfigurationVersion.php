<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ConfigurationVersion extends Pivot
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
