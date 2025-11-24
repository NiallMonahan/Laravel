@props([
    'artist',
])

@php
$img_url = asset('images/artists/' . strtolower(preg_replace('/[ !-]/', '_', $artist->name)) . ".jpg");
@endphp

<div class="group rounded-2xl border border-gray-800 bg-gray-900 p-5 shadow-md hover:shadow-xl transition duration-300
            hover:border-pink-500 cursor-pointer flex flex-col items-center text-center">

    {{-- Artist Image --}}
    <div class="w-32 h-32 mb-4 overflow-hidden rounded-full border border-gray-700 group-hover:border-pink-500 transition">
        <img 
            src="{{ $img_url }}"
            alt="{{ $artist->name }}"
            class="w-full h-full object-cover"
        >
    </div>

    {{-- Artist Name --}}
    <h2 class="text-lg font-semibold text-gray-100 group-hover:text-pink-400 transition">
        {{ $artist->name }}
    </h2>

    {{-- Bio (shortened automatically) --}}
    @if($artist->bio)
        <p class="text-sm text-gray-400 mt-2 line-clamp-3">
            {{ $artist->bio }}
        </p>
    @endif

</div>

