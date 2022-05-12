<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'name'
    ];

    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
