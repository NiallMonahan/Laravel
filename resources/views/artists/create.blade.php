<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-950">
        <div class="w-full max-w-2xl mx-auto py-10 px-6 rounded-2xl bg-gray-900 border border-gray-800 shadow-md">
            <h1
                class="text-2xl font-bold mb-6 bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent text-center">
                Add New Artist
            </h1>

            <x-artist-form :action="route('artists.store')" method="POST" />
        </div>
    </div>
</x-app-layout>