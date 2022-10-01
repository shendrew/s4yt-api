<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content-type',
        'content',
    ];

    public function pages()
    {
        return $this->belongsToMany('App\Models\Page');
    }
}
