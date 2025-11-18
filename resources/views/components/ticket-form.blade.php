
@props([
    'action' => route('tickets.store'),
    'method' => 'POST',
    'ticket' => null,
    'event' => null
])

<div class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300">
    <h3 class="text-lg font-semibold mb-4 text-gray-100">
        {{ $ticket ? 'Edit Ticket' : 'Add New Ticket' }}
    </h3>

    <form action="{{ $action }}" method="POST" class="space-y-4">
        @csrf
        @if(in_array($method, ['PUT','PATCH','DELETE']))
            @method($method)
        @endif
        
        <input type="hidden" name="event_id" value="{{ $event->id }}">

        {{-- Holder Name --}}
        <div>
            <label for="holder_name" class="mb-1 block text-sm font-semibold text-gray-200">Holder Name</label>
            <input type="text" 
                   id="holder_name" 
                   name="holder_name"
                   class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                          focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
                   placeholder="Full name of ticket holder"
                   value="{{ old('holder_name', $ticket->holder_name ?? '') }}" 
                   required>
            @error('holder_name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Seat Number --}}
        <div>
            <label for="seat_number" class="mb-1 block text-sm font-semibold text-gray-200">Seat Number</label>
            <input type="text" 
                   id="seat_number" 
                   name="seat_number"
                   class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                          focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
                   placeholder="e.g., A15 or General Admission"
                   value="{{ old('seat_number', $ticket->seat_number ?? '') }}">
            @error('seat_number') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Price --}}
        <div>
            <label for="price" class="mb-1 block text-sm font-semibold text-gray-200">Price</label>
            <input type="number" 
                   step="0.01" 
                   id="price" 
                   name="price"
                   class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                          focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
                   placeholder="0.00"
                   value="{{ old('price', $ticket->price ?? '') }}" 
                   required>
            @error('price') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-md bg-pink-600 px-4 py-2 text-sm font-medium text-white
                           shadow-sm transition hover:bg-pink-500 hover:shadow-pink-500/30">
                {{ $ticket ? 'Update Ticket' : 'Add Ticket' }}
            </button>

            @if($ticket)
                <a href="{{ route('events.show', $event) }}"
                   class="text-sm text-gray-300 underline underline-offset-4 hover:text-gray-100">
                    Cancel
                </a>
            @endif
        </div>
    </form>
</div>