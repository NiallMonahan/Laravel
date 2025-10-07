<div>
    <x-app-layout>
        <h1 class="text-2xl font-bold mb-6">All Events</h1>

        @if($events->isEmpty())
            <p class="text-gray-600">No events found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <x-event-card :title="$event->title" :description="$event->description" :image="$event->image"
                        :date="$event->event_date ?? null" :location="$event->location ?? null" :bookUrl="route('events.show', $event->id)" />

                @endforeach
            </div>
        @endif
    </x-app-layout>
</div>