<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Add New Event</h1>

        <x-event-form :action="route('events.store')" method="POST" />
    </div>
</x-app-layout>