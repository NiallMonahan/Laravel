<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">All Events</h1>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($events->isEmpty())
        <p class="text-gray-600">No events found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="space-y-3">
                    <x-event-card :title="$event->title" :description="$event->description" :image="$event->image"
                        :date="$event->event_date ?? null" :location="$event->location ?? null" :bookUrl="route('events.show', $event)" />

                    <div class="flex items-center gap-2">
                        <a href="{{ route('events.edit', $event) }}"
                            class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-indigo-500">
                            Edit
                        </a>

                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="m-0"
                            onsubmit="return confirm('Delete this event?')" class="inline-flex items-center">
                            @csrf
                            @method('DELETE')
                            <button
                                class="inline-flex items-center justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-500 ">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>