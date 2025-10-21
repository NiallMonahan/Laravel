<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent">
        All Events
    </h1>


    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($events->isEmpty())
        <p class="text-gray-600">No events found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-[1600px] mx-auto">
            @foreach($events as $event)
                <div class="space-y-3">
                    <x-event-card :title="$event->title" :description="$event->description" :image="$event->image"
                        :date="$event->event_date ?? null" :location="$event->location ?? null" :bookUrl="route('events.show', $event)" />

                    <div class="flex items-center gap-2">
                        <a href="{{ route('events.edit', $event) }}"
                            class="inline-flex items-center justify-center rounded-md bg-pink-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-pink-500 shadow-sm hover:shadow-pink-500/30 transition">
                            Edit
                        </a>

                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="m-0"
                            onsubmit="return confirm('Delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="inline-flex items-center justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm font-medium text-gray-200 border border-gray-700 hover:bg-red-600 hover:text-white hover:border-red-500 shadow-sm hover:shadow-red-500/30 transition">
                                Delete
                            </button>
                        </form>
                    </div>


                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>