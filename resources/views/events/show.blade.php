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
                        <li class="border border-gray-700 p-3 rounded-lg bg-gray-800 text-gray-300">
                            <span class="font-medium text-gray-100">{{ $ticket->holder_name }}</span>
                            <span class="text-gray-400">— Seat: {{ $ticket->seat_number ?? 'N/A' }}</span>
                            <span class="text-pink-400 font-medium">(€{{ number_format($ticket->price, 2) }})</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400">No tickets purchased yet.</p>
            @endif
        </div>

        {{-- Form to create a new ticket --}}
        <div
            class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-100">Add New Ticket</h3>

            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="mb-4">
                    <label for="holder_name" class="block text-sm font-medium text-gray-300 mb-2">Holder Name</label>
                    <input type="text" id="holder_name" name="holder_name"
                        class="w-full border border-gray-700 rounded-lg bg-gray-800 text-gray-100 px-3 py-2 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition duration-200"
                        required>
                </div>

                <div class="mb-4">
                    <label for="seat_number" class="block text-sm font-medium text-gray-300 mb-2">Seat Number</label>
                    <input type="text" id="seat_number" name="seat_number"
                        class="w-full border border-gray-700 rounded-lg bg-gray-800 text-gray-100 px-3 py-2 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition duration-200">
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                    <input type="number" step="0.01" id="price" name="price"
                        class="w-full border border-gray-700 rounded-lg bg-gray-800 text-gray-100 px-3 py-2 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition duration-200"
                        required>
                </div>

                <x-primary-button>Add Ticket</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>