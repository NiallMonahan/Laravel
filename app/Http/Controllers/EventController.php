<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all events from the database
        $events = Event::all();

        // Send the events to the index view
        return view('events.index', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Follow Anne's method: move the file to the public folder
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/events'), $imageName);
            $validated['image'] = $imageName;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Laravel automatically finds the event by ID (implicit model binding)
        return view('events.show', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        // Only replace the image if a new one was uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/events', 'public'); // storage/app/public/images/events
            $validated['image'] = 'storage/' . $path; // so asset($event->image) works
        }

        $event->update($validated);

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
}
