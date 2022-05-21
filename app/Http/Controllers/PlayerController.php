<?php

namespace App\Http\Controllers;

use App\Education;
use App\Role;
use App\Services\LocationService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePlayerRequest;

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
     * @param LocationService $locationService
     * @return View
     */
    public function create(LocationService $locationService): View
    {
        $educations = Education::all();
        $countries = $locationService->getCountries();
        dd($countries->body());
        return view('admin.players.create', compact('educations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return RedirectResponse
     */
    public function store(StorePlayerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        (new PlayerService())->addPlayer($validated, Configuration::getValueByKey(Configuration::REGISTER_TICKETS));
        return redirect()->route('player.index')->with('success', 'Player added successfully.');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('admin.players.show-edit');
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

    public function destroy($id): RedirectResponse
    {
        $player = User::find($id);

        if(!$player) {
            return redirect()->route('player.index')->with('error', 'Player not found.');
        }

        User::destroy($player->id);
        return redirect()->route('player.index')->with('success', 'Player deleted successfully.');
    }
}
