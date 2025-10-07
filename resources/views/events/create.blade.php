<div>
    <x-app-layout>
        <h1 class="text-2xl font-bold mb-6">Add New Event</h1>

        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Title</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="4" required></textarea>
            </div>

            <div>
                <label class="block font-semibold">Date</label>
                <input type="date" name="event_date" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Location</label>
                <input type="text" name="location" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Image</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            <x-primary-button>Create Event</x-primary-button>
        </form>
    </x-app-layout>

</div>