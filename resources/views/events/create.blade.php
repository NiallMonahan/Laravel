<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-950">
        <div class="w-full max-w-2xl mx-auto py-10 px-6 rounded-2xl bg-gray-900 border border-gray-800 shadow-md">
            <h1
                class="text-2xl font-bold mb-6 bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent text-center">
                Add New Event
            </h1>

            <x-event-form :action="route('events.store')" method="POST" />
        </div>
    </div>
</x-app-layout>