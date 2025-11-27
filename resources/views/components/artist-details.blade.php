@props([
    'name' => '',
    'genre' => '',
    'bio' => '',
    'image' => '',
])

<div class="max-w-xl mx-auto mb-6">
    <div class="border border-gray-800 rounded-2xl shadow-md p-6 bg-gray-900 hover:shadow-pink-500/20 transition duration-300">
        <div class="flex flex-col items-center text-center gap-6">
            <!-- Artist Name -->
            <h1 class="text-4xl font-extrabold text-white mb-4">
                {{ $name }}
            </h1>

            <!-- Artist Image -->
            <div class="w-48 h-48 rounded-lg overflow-hidden border-4 border-pink-500 shadow-lg">
                <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover">
            </div>

            <!-- Artist Info -->
            <div>
                <!-- <div class="inline-block bg-pink-500 text-white px-4 py-2 rounded-full text-lg font-semibold mb-4">
                    {{ $genre }}
                </div> -->
                <p class="text-gray-300 text-lg leading-relaxed">
                    {{ $bio }}
                </p>
            </div>
        </div>
    </div>
</div>