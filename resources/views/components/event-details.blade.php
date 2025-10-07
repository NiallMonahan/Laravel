<div>
    @props(['title', 'description', 'image', 'event_date', 'location', 'capacity'])

    <!-- Event Details Component -->
    <div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto">
        <!-- Event Title -->
        <h1 class="font-bold text-gray-800 mb-2 text-3xl">{{ $title }}</h1>

        <!-- Event Image -->
        <div class="overflow-hidden rounded-lg mb-4 flex justify-center">
            <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full max-w-md h-auto object-cover rounded-lg"
                onerror="this.src='{{ asset('images/PlaceHolder2.jpg') }}'">
        </div>


        <!-- Date / Location / Capacity -->
        <div class="text-gray-600 text-sm mb-4 space-y-1">
            @if($event_date)
                <div><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($event_date)->toFormattedDateString() }}
                </div>
            @endif
            @if($location)
                <div><strong>Location:</strong> {{ $location }}</div>
            @endif
            @if($capacity)
                <div><strong>Capacity:</strong> {{ $capacity }}</div>
            @endif
        </div>

        <!-- Description -->
        <h3 class="text-lg font-semibold mb-1">Description</h3>
        <p class="text-gray-700 leading-relaxed">{{ $description }}</p>
    </div>

</div>