<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Education;
use App\Grade;
use App\Role as RoleModel;
use App\Services\LocationService;
use App\Services\PlayerService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use Spatie\Permission\Models\Role;
use App\Coin;

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
            $q->whereIn('name', [RoleModel::BU_PLAYER, RoleModel::PLAYER]);
        });

        $players = $players->paginate(20);
        return view('admin.players.index',compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param LocationService $locationService
     * @return View
     */
    public function create(LocationService $locationService): View
    {
        $educations = Education::all();
        $grades =  Grade::all();
        $countries = ($locationService->getCountries())->json();
        $roles = Role::whereIn('name', [RoleModel::PLAYER, RoleModel::BU_PLAYER])->get();
        return view('admin.players.create', compact('educations', 'countries', 'grades', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return RedirectResponse
     */
    public function store(StorePlayerRequest $request, PlayerService $playerService): RedirectResponse
    {
        $validated = $request->validated();
        $playerService->addPlayer($validated, Configuration::getValueByKey(Configuration::INITIAL_COINS), true);
        return redirect()->route('player.index')->with('success', 'Player added successfully.');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('admin.players.show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlayerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdatePlayerRequest $request, $id, PlayerService $playerService): RedirectResponse
    {
        $validated = $request->validated();
        $player = User::find($id);

        if(!$player) {
            return redirect()->route('player.index')->with('error', 'Player not found.');
        }

        if($player->email != $validated['email']) {
            $request->validate([
                'email' => 'required|string|email|unique:users',
            ]);
        }

        $playerService->updatePlayer($validated, $player);

        return redirect()->route('player.index')->with('success', 'Player updated successfully.');
    }

        /**
    * Show the form for edit a resource.
    *
    * @param $id
    * @return View
    */
    public function edit($id, LocationService $locationService): View
    {
        $user = User::find($id);
        $grades = Grade::all();
        $educations = Education::all();
        $countries = ($locationService->getCountries())->json();
        $ciso = LocationService::getCiso($user->country, $countries);
        $roles = Role::whereIn('name', [RoleModel::PLAYER, RoleModel::BU_PLAYER])->get();
        return view('admin.players.edit', compact('user', 'grades', 'educations', 'countries', 'roles', 'ciso'));
    }

    public function destroy($id): RedirectResponse
    {
        $player = User::find($id);

        if(!$player) {
            return redirect()->route('player.index')->with('error', 'Player not found.');
        }

        Coin::where('user_id', $player->id)->delete();
        User::destroy($player->id);
        return redirect()->route('player.index')->with('success', 'Player deleted successfully.');
    }
}
