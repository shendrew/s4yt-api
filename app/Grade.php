<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grade extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
