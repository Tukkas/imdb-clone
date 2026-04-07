<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::latest()->get();
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Actor::create([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor created successfully.');
    }

    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $actor->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor updated successfully.');
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();

        return redirect()->route('actors.index')->with('success', 'Actor deleted successfully.');
    }
}