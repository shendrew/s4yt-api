<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name',
    ];

    public function modal()
    {
        return $this->hasOne('App\Models\Modal');
    }
}
