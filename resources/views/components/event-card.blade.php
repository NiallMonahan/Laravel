<div>
    <!@props([
    'title' => 'Untitled Event',
    'description' => null,
    'image' => 'PlaceHolder.jpg',
    'date' => null,
    'location' => null,
    'bookUrl' => '#',
])

<div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col hover:scale-[1.02] transition">
    <img
        src="{{ asset('images/' . $image) }}"
        alt="{{ $title }} image"
        class="w-full h-64 object-cover"
        onerror="this.src='{{ asset('images/PlaceHolder.jpg') }}'"
    />
    <div class="p-5 flex flex-col gap-2">
        <h3 class="text-xl font-semibold text-gray-900">{{ $title }}</h3>

        @if($date || $location)
            <div class="text-sm text-gray-600">
                @if($date)
                    <div>{{ \Illuminate\Support\Carbon::parse($date)->toFormattedDateString() }}</div>
                @endif
                @if($location)
                    <div>{{ $location }}</div>
                @endif
            </div>
        @endif

        @if($description)
            <p class="text-sm text-gray-700 line-clamp-3">{{ $description }}</p>
        @endif

        <a href="{{ $bookUrl }}"
           class="mt-3 inline-block text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Book Now!
        </a>
    </div>
</div>
</div>