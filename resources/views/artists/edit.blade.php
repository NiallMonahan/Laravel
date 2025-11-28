<div>
    <x-app-layout>
        <div class="max-w-2xl mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Edit Artist</h1>

            <x-artist-form :action="route('artists.update', $artist)" method="PUT" :artist="$artist" />
        </div>
    </x-app-layout>
</div>