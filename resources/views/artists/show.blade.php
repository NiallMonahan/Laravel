<x-app-layout>
    <div class="p-8">
        <h1>{{ $artist->name }}</h1>
        <p>Genre: {{ $artist->genre }}</p>
        <p>Bio: {{ $artist->bio }}</p>
    </div>
</x-app-layout>