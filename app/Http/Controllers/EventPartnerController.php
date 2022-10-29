<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventPartner;
use Illuminate\Console\Scheduling\Event;

class EventPartnerController extends Controller
{
    public function index(): View
    {
        $event_partner = EventPartner::paginate(20);
        return view('admin.event_partner.index', compact('event_partner'));
    }

    public function create(): View
    {
        return view('admin.event_partner.create');
    }

    public function store(StoreEventPartnerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        EventPartner::create([
            'slug' => Str::slug($validated['slug'], '-'),
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'meet_day' => $validated['meet_day'],
            'meet_from' => $validated['meet_from'],
            'meet_to' => $validated['meet_to'],
            'meet_link' => $validated['meet_link'],
            'awards_confirmed' => $validated['awards_confirmed'],
            'youtube_link' => $validated['youtube_link'],
            'active' => $validated['active'],
            'step' => $validated['step']
        ]);

        return redirect()->route('event_partner.index')->with('success','Event partner created.');
    }

    public function show($id) : View
    {
        $event_partner = EventPartner::find($id);
        return view('admin.event_partner.show', compact('event_partner'));
    }

    public function update($id, StoreEventPartnerRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $event_partner = EventPartner::find($id);

        $event_partner->slug = Str::slug($validated['slug'], '-');
        $event_partner->short_description = $validated['short_description'];
        $event_partner->description = $validated['description'];
        $event_partner->meet_day = $validated['meet_day'];
        $event_partner->meet_from = $validated['meet_from'];
        $event_partner->meet_to = $validated['meet_to'];
        $event_partner->meet_link = $validated['meet_link'];
        $event_partner->awards_confirmed = $validated['awards_confirmed'];
        $event_partner->youtube_link = $validated['youtube_link'];
        $event_partner->active = $validated['active'];
        $event_partner->step = $validated['step'];

        $event_partner->save();

        return redirect()->route('event_parnter.index')->with('success', 'Event partner updated.');
    }

    public function edit($id): View
    {
        $event_partner = EventPartner::find($id);
        return view('admin.event_partner.edit', compact('event_partner'));
    }

    public function destroy($id) : RedirectResponse
    {
        EventPartner::destroy($id);
        return redirect()->route('event_partner.index')->with('success', 'Event partner deleted.');
    }
}
