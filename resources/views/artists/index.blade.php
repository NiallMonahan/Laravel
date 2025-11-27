<x-app-layout>

    <!--Title  -->
    <div class="max-w-[1600px] mx-auto px-4 text-center py-8">
        <h1
            class="text-4xl font-extrabold bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent tracking-tight">
            All Artists
        </h1>
    </div>

    <!-- Artists List -->
    @if($artists->isEmpty())
        <p class="text-gray-600">No artists found.</p>
    @else
        <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                @foreach($artists as $artist)
                    <div class="space-y-3">
                        <x-artist-card :artist="$artist" />
                    </div>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>