<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Version_User extends Model
{
    public function user() : HasOne {
        return $this->HasOne(User::class);
    }

    public function version() : HasOne {
        return $this->hasOne(Version::class);
    }

    public function raffle_items() : BelongsToMany {
        return $this->belongsToMany(raffle_items::class());
    }
}
