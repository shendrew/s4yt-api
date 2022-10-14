<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModalRequest;
use App\Http\Requests\UpdateModalRequest;
use App\Models\Modal;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ModalController extends Controller
{
    public function index(): View
    {
        $modals = Modal::paginate(20);
        return view('admin.modals.index', compact('modals'));
    }

    public function create(): View
    {
        return view('admin.modals.create');
    }

    public function store(StoreModalRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Modal::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'], '-'),
            'content_type' => $validated['content_type'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('modal.index')->with('success','Modal created.');
    }

    public function show($id) : View
    {
        $modal = Modal::find($id);
        return view('admin.modals.show', compact('modal'));
    }

    public function update($id, UpdateModalRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $modal=Modal::find($id);

        if ($modal->title != $validated['title'])
        {
            $request->validated([
                'title' => 'required|string|unique:modals',
            ]);
        }

        $modal->title=$validated['title'];
        $modal->slug=Str::slug($validated['title'], '-');
        $modal->content_type=$validated['content_type'];
        $modal->content=$validated['content'];

        $modal->save();

        return redirect()->route('modal.index')->with('success', 'Modal updated.');
    }

    public function edit($id): View
    {
        $modal = Modal::find($id);
        return view('admin.modals.edit', compact('modal'));
    }

    public function destroy($id) : RedirectResponse
    {
        Modal::destroy($id);
        return redirect()->route('modal.index')->with('success', 'Modal deleted');
    }
}
