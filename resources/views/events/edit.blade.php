<div>
    <x-app-layout>
        <div class="max-w-2xl mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Edit Event</h1>

            <x-event-form :action="route('events.update', $event)" method="PUT" :event="$event" />
        </div>
    </x-app-layout>
</div>