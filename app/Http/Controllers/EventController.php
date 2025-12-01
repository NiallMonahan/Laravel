<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Grab whatever the user typed in the search bar
        $search = $request->input('search');

        // If we actually have a search word, try to match it against title or description
        if ($search) {
            $events = Event::where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->get();
        } else {
            $events = Event::all();
        }

        // Hand the events to the blade view so it can list them out
        return view('events.index', compact('events'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the current user has admin role - only admins can create events
        if (auth()->user()->role !== 'admin') {
            return redirect()
                ->route('events.index')
                ->with('error', 'Access denied.');
        }

        return view('events.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate all incoming form data
        // latitude/longitude are optional but must be valid coordinates if provided
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'artists' => 'array',
            'artists.*' => 'exists:artists,id',
        ]);

        // Deal with the uploaded picture if the user sent one
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/events'), $imageName);
            $validated['image'] = $imageName;
        }

        // Create the event record in the database
        $event = Event::create($validated);

        // Attach selected artists to the event using the many-to-many relationship
        // This creates records in the artist_event pivot table
        if (!empty($request->artists)) {
            $event->artists()->attach($request->artists);
        }

        // Redirect back to events list with success message
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Get the event and all its related tickets and artists
        $event->load('tickets', 'artists');

        // Pass the event (with tickets and artists) to the view
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Load the edit form view and pass the existing event data
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'event_date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'artists' => 'array',
            'artists.*' => 'exists:artists,id',
        ]);

        // Only replace the image if a new one was uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/events', 'public'); // storage/app/public/images/events
            $validated['image'] = 'storage/' . $path; // so asset($event->image) works
        }

        $event->update($validated);

        // Sync selected artists with the event
        if (isset($request->artists)) {
            $event->artists()->sync($request->artists);
        } else {
            $event->artists()->detach();
        }

        return redirect()->route('events.index')->with('success', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Only delete the image if it's a real uploaded file, not a shared placeholder
        if (
            $event->image
            && file_exists(public_path($event->image))
            && !str_contains($event->image, 'placeholder')
        ) {

            unlink(public_path($event->image));
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }


    public function map()
    {
        // only events that have coordinates 
        $events = Event::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('artists')
            ->get();

        return view('events.map', compact('events'));
    }
}
