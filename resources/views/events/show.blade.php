<x-app-layout>
    <div class="py-8">
        <x-event-details :title="$event->title" :description="$event->description" :image="$event->image"
            :event_date="$event->event_date" :location="$event->location" :capacity="$event->capacity" />
    </div>

    {{-- List all tickets for this event --}}
    <h2 class="text-xl font-bold mt-6 mb-2">Tickets</h2>

    <ul>
        @foreach ($event->tickets as $ticket)
            <li class="border p-2 rounded mb-2">
                {{ $ticket->holder_name }}
                — Seat: {{ $ticket->seat_number ?? 'N/A' }}
                (€{{ number_format($ticket->price, 2) }})
            </li>
        @endforeach
    </ul>

    {{-- Form to create a new ticket --}}
    <form action="{{ route('tickets.store') }}" method="POST" class="mt-4 border-t pt-4">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">

        <div class="mb-2">
            <label class="block text-sm">Holder Name</label>
            <input type="text" name="holder_name" class="border rounded w-full" required>
        </div>

        <div class="mb-2">
            <label class="block text-sm">Seat Number</label>
            <input type="text" name="seat_number" class="border rounded w-full">
        </div>

        <div class="mb-2">
            <label class="block text-sm">Price</label>
            <input type="number" step="0.01" name="price" class="border rounded w-full" required>
        </div>

        <x-primary-button>Add Ticket</x-primary-button>
    </form>

</x-app-layout>