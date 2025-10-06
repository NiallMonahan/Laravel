<div>
    <!-<x-app-layout>
        <h1 class="text-2xl font-bold mb-6">All Events</h1>

        @if($events->isEmpty())
            <p class="text-gray-600">No events found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->title }} image"
                            class="w-full h-64 object-cover" onerror="this.src='{{ asset('images/PlaceHolder2.jpg') }}'">
                        <div class="p-5">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2 text-center">
                                {{ $event->title ?? 'Untitled Event' }}
                            </h2>
                            <p class="text-sm text-gray-600 text-justify">
                                {{ $event->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>
                @endforeach


            </div>
        @endif
        </x-app-layout>
</div>