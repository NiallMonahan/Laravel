<x-app-layout>
    <div class="py-8">
        <x-event-details :title="$event->title" :description="$event->description" :image="$event->image"
            :event_date="$event->event_date" :location="$event->location" :capacity="$event->capacity" />
    </div>

    {{-- Tickets section with matching styling --}}
    <div class="max-w-xl mx-auto">
        {{-- List all tickets for this event --}}
        <div
            class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300 mb-6">
            <h2 class="text-xl font-bold mb-4 text-gray-100">Tickets</h2>

            @if($event->tickets->count() > 0)
                <ul class="space-y-2">
                    @foreach ($event->tickets as $ticket)
                        <li
                            class="border border-gray-700 p-3 rounded-lg bg-gray-800 text-gray-300 flex justify-between items-center">
                            <div>
                                <span class="font-medium text-gray-100">{{ $ticket->holder_name }}</span>
                                <span class="text-gray-400">— Seat: {{ $ticket->seat_number ?? 'N/A' }}</span>
                                <span class="text-pink-400 font-medium">(€{{ number_format($ticket->price, 2) }})</span>
                            </div>

                            {{-- Action buttons grouped together --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ route('tickets.edit', $ticket) }}"
                                    class="inline-flex items-center justify-center rounded-md bg-pink-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-pink-500 shadow-sm hover:shadow-pink-500/30 transition">
                                    Edit
                                </a>

                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400">No tickets purchased yet.</p>
            @endif
        </div>
        <x-ticket-form :event="$event" />
        <h2 class="text-xl text-white font-bold mt-6 mb-2">Artists</h2>

        <ul class="space-y-1">
            @foreach($event->artists as $artist)
                <li class="text-gray-300">{{ $artist->name }}</li>
            @endforeach
        </ul>

    </div>
</x-app-layout>