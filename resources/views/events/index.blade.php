<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent">
        All Events
    </h1>

    <!--  Made the alert message dissapear after 2 seconds with javascript -->
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition.opacity.duration.500ms
            class="mb-4 rounded-md border border-green-700 bg-green-900/30 p-3 text-green-400 shadow-sm shadow-green-500/20 max-w-[1600px] mx-auto">
            {{ session('success') }}
        </div>
    @endif


    <!-- Search bar -->
    <div class="max-w-[1600px] mx-auto px-4">
        <form action="{{ route('events.index') }}" method="GET" class="flex items-center gap-2 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="w-full bg-gray-800 text-gray-100 border border-gray-800 
                   rounded-xl px-4 py-2 focus:outline-none focus:ring-2 
                   focus:ring-pink-500/40 placeholder-gray-400 transition">
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-gray-100 font-semibold 
                   px-4 py-2 rounded-xl transition hover:shadow-pink-500/30">
                Search
            </button>
        </form>
    </div>




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