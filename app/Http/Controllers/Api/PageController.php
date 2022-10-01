<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showModal($id)
    {
        $page = Page::all()->where('id', $id);

        return $page->modal();
    }
}
