<div>
    @props(['title', 'description', 'image', 'event_date', 'location', 'capacity'])

    <div
        class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300 max-w-xl mx-auto">
        <!-- Title -->
        <h1
            class="font-bold text-gray-100 mb-4 text-3xl bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-indigo-400 text-center">
            {{ $title }}
        </h1>

        <!-- Event Image -->
        <div class="overflow-hidden rounded-xl mb-6 flex justify-center">
            <img src="{{ asset('images/events/' . $image) }}" alt="{{ $title }}"
                class="w-full max-w-md h-auto object-cover rounded-xl transition-transform duration-500 hover:scale-105"
                onerror="this.src='{{ asset('images/PlaceHolder2.jpg') }}'">
        </div>

        <!-- Date / Location / Capacity -->
        <div class="text-gray-300 text-sm mb-6 space-y-1">
            @if($event_date)
                <div><strong class="text-gray-100">Date:</strong>
                    {{ \Illuminate\Support\Carbon::parse($event_date)->toFormattedDateString() }}</div>
            @endif
            @if($location)
                <div><strong class="text-gray-100">Location:</strong> {{ $location }}</div>
            @endif
            @if($capacity)
                <div><strong class="text-gray-100">Capacity:</strong> {{ $capacity }}</div>
            @endif
        </div>

        <!-- Description -->
        <h3 class="text-lg font-semibold mb-2 text-gray-100">Description</h3>
        <p class="text-gray-400 leading-relaxed">{{ $description }}</p>
    </div>
</div>