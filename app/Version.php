<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Version extends Model
{
    protected $fillable = [
        'year',
        'month'
    ];

    public function version_users() : BelongsToMany {
        return $this->belongsToMany(Version_User::class);
    }
}
