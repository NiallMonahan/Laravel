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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                @foreach($artists as $artist)
                    <div class="flex flex-col">
                        <x-artist-card :artist="$artist" />

                        @if(auth()->user()->role === 'admin')
                            <div class="flex items-center justify-center gap-3 mt-4">
                                <a href="{{ route('artists.edit', $artist) }}"
                                    class="inline-flex items-center justify-center rounded-md bg-pink-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-pink-500 shadow-sm hover:shadow-pink-500/30 transition">
                                    Edit
                                </a>

                                <form action="{{ route('artists.destroy', $artist) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this artist?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>