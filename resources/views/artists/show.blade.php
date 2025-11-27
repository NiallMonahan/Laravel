<x-app-layout>
    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <!-- Artist Details -->
            <div
                class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300 mb-6">
                <div class="flex flex-col items-center text-center gap-6">
                    <!-- Artist Name -->
                    <h1 class="text-4xl font-extrabold text-white mb-4">
                        {{ $artist->name }}
                    </h1>

                    <!-- Artist Image -->
                    <div class="w-48 h-48 rounded-lg overflow-hidden border-4 border-pink-500 shadow-lg">
                        <img src="{{ asset('images/artists/' . strtolower(preg_replace('/[ !-]/', '_', $artist->name)) . '.jpg') }}"
                            alt="{{ $artist->name }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Artist Info -->
                    <div>
                        <div
                            class="inline-block bg-pink-500 text-white px-4 py-2 rounded-full text-lg font-semibold mb-4">
                            {{ $artist->genre }}
                        </div>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            {{ $artist->bio }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Events section -->
            <div
                class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300 mb-6">
                <h2 class="text-xl font-bold mb-4 text-gray-100">Upcoming Events</h2>

                @if($artist->events->count() > 0)
                    <ul class="space-y-2">
                        @foreach ($artist->events as $event)
                            <li
                                class="border border-gray-700 p-3 rounded-lg bg-gray-800 text-gray-300 flex justify-between items-start">
                                <div class="flex-1 pr-4">
                                    <div class="font-medium text-gray-100">{{ $event->title }}</div>
                                    <div class="text-gray-400">{{ $event->event_date }}</div>
                                    <div class="text-pink-400 font-medium">{{ $event->location }}</div>
                                </div>
                                <a href="{{ route('events.show', $event) }}"
                                    class="inline-flex items-center justify-center rounded-md bg-pink-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-pink-500 shadow-sm hover:shadow-pink-500/30 transition whitespace-nowrap flex-shrink-0">
                                    View Event
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400">No upcoming events for this artist.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>