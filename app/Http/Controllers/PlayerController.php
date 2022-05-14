<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlayerController extends Controller
{
    /**
     * Display a list of the resource user.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $players = User::whereHas('roles', function($q) {
            $q->whereIn('name', [Role::BU_PLAYER, Role::PLAYER]);
        });

        $players = $players->paginate(20);
        return view('admin.players.index',compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.players.create');
    }
}
