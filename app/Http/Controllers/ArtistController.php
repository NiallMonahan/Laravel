<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all artists from the database
        $artists = \App\Models\Artist::all();

        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // access to admins only 
        if (auth()->user()->role !== 'admin') {
            return redirect()
                ->route('artists.index')
                ->with('error', 'Access denied.');
        }

        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artist = Artist::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'bio' => $request->bio,
        ]);

        if ($request->hasFile('image')) {
            $imageName = strtolower(preg_replace('/[ !-]/', '_', $artist->name)) . '.jpg';
            $request->file('image')->move(public_path('images/artists'), $imageName);
        }

        return redirect()->route('artists.index')->with('success', 'Artist created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        // Display the artist details page
        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        // Load the edit form with existing artist data
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:255',
        ]);


        $artist->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'genre' => $request->genre,
        ]);

        // Handle image upload with naming convention
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            $oldImageName = strtolower(preg_replace('/[ !-]/', '_', $artist->getOriginal('name'))) . '.jpg';
            $oldImagePath = public_path('images/artists/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Save new image with updated name
            $imageName = strtolower(preg_replace('/[ !-]/', '_', $artist->name)) . '.jpg';
            $request->file('image')->move(public_path('images/artists'), $imageName);
        }

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        // Delete the artist from the database
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artist deleted.');
    }
}
