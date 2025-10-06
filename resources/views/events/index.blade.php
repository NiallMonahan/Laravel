<div>
    <!-<x-app-layout>
        <h1 class="text-2xl font-bold mb-6">All Events</h1>

        @if($events->isEmpty())
            <p class="text-gray-600">No events found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="p-4 bg-white shadow rounded-xl">
                        <img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->title }} image"
                            class="w-full h-48 object-cover rounded-lg mb-3"
                            onerror="this.src='{{ asset('images/PlaceHolder.jpg') }}'">
                        <h2 class="text-lg font-semibold">{{ $event->title ?? 'Untitled Event' }}</h2>
                        <p class="text-sm text-gray-700 mt-2">{{ $event->description ?? 'No description available.' }}</p>
                    </div>
                @endforeach

            </div>
        @endif
        </x-app-layout>
</div>