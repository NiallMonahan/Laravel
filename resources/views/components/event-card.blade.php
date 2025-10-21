@props([
    'title' => 'Untitled Event',
    'description' => null,
    'image' => 'PlaceHolder.jpg',
    'date' => null,
    'location' => null,
    'bookUrl' => '#',
])

<div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-md overflow-hidden flex flex-col transition transform hover:scale-[1.02] hover:shadow-pink-500/20 hover:shadow-lg">
    <img
        src="{{ asset('images/events/' . $image) }}"
        alt="{{ $title }} image"
        class="w-full h-64 object-cover"
    />

    <div class="p-5 flex flex-col gap-2">
        <h3 class="text-xl font-semibold text-white hover:text-pink-400 transition">
            {{ $title }}
        </h3>

        @if($date || $location)
            <div class="text-sm text-gray-400">
                @if($date)
                    <div>{{ \Illuminate\Support\Carbon::parse($date)->toFormattedDateString() }}</div>
                @endif
                @if($location)
                    <div>{{ $location }}</div>
                @endif
            </div>
        @endif

        @if($description)
            <p class="text-sm text-gray-300 line-clamp-3">{{ $description }}</p>
        @endif

        <a href="{{ $bookUrl }}"
           class="mt-3 inline-block text-center bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-500 transition font-medium shadow-sm hover:shadow-pink-500/30">
            Book Now!
        </a>
    </div>
</div>
