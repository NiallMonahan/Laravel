@props(['event'])

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