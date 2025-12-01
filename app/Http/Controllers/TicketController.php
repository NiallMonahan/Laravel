<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'holder_name' => 'required|string|max:255',
            'seat_number' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the new ticket
        Ticket::create($validated);

        // Return to the previous page (Event show) with a success message
        return back()->with('success', 'Ticket added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // Get the event associated with this ticket
        $event = $ticket->event;

        // Pass both ticket and event to the edit view
        return view('tickets.edit', compact('ticket', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'holder_name' => 'required|string|max:255',
            'seat_number' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        $ticket->update($validated);

        $event = $ticket->event;

        // Redirect back to the event details page showing the updated ticket
        return redirect()->route('events.show', $ticket->event)->with('success', 'Ticket updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // Delete the ticket from the database
        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully!');
    }
}
