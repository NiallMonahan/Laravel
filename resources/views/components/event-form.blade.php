@props([
  'action' => route('events.store'),
  'method' => 'POST',
  'event'  => null,
])

@php
$artists = \App\Models\Artist::all();
// Gets selected artists as an array for editing
$selectedArtists = $event ? $event->artists->pluck('id')->toArray() : [];
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"
      class="space-y-5 rounded-2xl border border-gray-800 bg-gray-900 p-6 shadow-md">
  @csrf
  @if(in_array($method, ['PUT','PATCH','DELETE']))
    @method($method)
  @endif

  {{-- Title --}}
  <div>
    <label for="title" class="mb-1 block text-sm font-semibold text-gray-200">Title</label>
    <input id="title" type="text" name="title"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                  focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           placeholder="Event title"
           value="{{ old('title', $event->title ?? '') }}" required>
    @error('title') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Description --}}
  <div>
    <label for="description" class="mb-1 block text-sm font-semibold text-gray-200">Description</label>
    <textarea id="description" name="description" rows="4"
              class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                     focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
              placeholder="What's happening? When, who, why?">{{ old('description', $event->description ?? '') }}</textarea>
    @error('description') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Date --}}
  <div>
    <label for="event_date" class="mb-1 block text-sm font-semibold text-gray-200">Date</label>
    <input id="event_date" type="date" name="event_date"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100
                  focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           value="{{ old('event_date',
              ($event?->event_date instanceof \Carbon\Carbon)
                ? $event->event_date->format('Y-m-d')
                : ($event?->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '')
           ) }}" required>
    @error('event_date') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Location --}}
  <div>
    <label for="location" class="mb-1 block text-sm font-semibold text-gray-200">Location</label>
    <input id="location" type="text" name="location"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                  focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           placeholder="Venue or address"
           value="{{ old('location', $event->location ?? '') }}" required>
    @error('location') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Coordinates --}}
  <div class="grid grid-cols-2 gap-4">
    <div>
      <label for="latitude" class="mb-1 block text-sm font-semibold text-gray-200">Latitude</label>
      <input id="latitude" type="number" step="0.0000001" name="latitude"
             class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                    focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
             placeholder="e.g. 53.3498"
             value="{{ old('latitude', $event->latitude ?? '') }}">
      @error('latitude') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="longitude" class="mb-1 block text-sm font-semibold text-gray-200">Longitude</label>
      <input id="longitude" type="number" step="0.0000001" name="longitude"
             class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                    focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
             placeholder="e.g. -6.2603"
             value="{{ old('longitude', $event->longitude ?? '') }}">
      @error('longitude') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
    </div>
  </div>

  {{-- Artists Selection --}}
  <div>
    <label class="mb-3 block text-sm font-semibold text-gray-200">Select Artists</label>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-48 overflow-y-auto border border-gray-700 rounded-lg p-3 bg-gray-800">
      @if($artists->isEmpty())
        <p class="text-gray-400 text-sm col-span-2 text-center py-4">No artists available. <a href="{{ route('artists.create') }}" class="text-pink-400 hover:text-pink-300 underline">Create one first</a></p>
      @else
        @foreach($artists as $artist)
          <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-700 p-2 rounded transition">
            <input type="checkbox" 
                   name="artists[]" 
                   value="{{ $artist->id }}"
                   {{ in_array($artist->id, old('artists', $selectedArtists)) ? 'checked' : '' }}
                   class="w-4 h-4 text-pink-600 bg-gray-800 border-gray-600 rounded focus:ring-pink-500 focus:ring-2">
            <div class="flex-1">
              <div class="text-sm font-medium text-gray-100">{{ $artist->name }}</div>
              @if($artist->genre)
                <div class="text-xs text-gray-400">{{ $artist->genre }}</div>
              @endif
            </div>
          </label>
        @endforeach
      @endif
    </div>
    @error('artists') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Image --}}
  <div>
    <label for="image" class="mb-1 block text-sm font-semibold text-gray-200">Image</label>
    <input id="image" type="file" name="image"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 file:mr-4 file:rounded-md file:border-0
                  file:bg-gray-700 file:px-3 file:py-2 file:text-gray-100 hover:file:bg-gray-600
                  text-gray-100 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           {{ $event ? '' : 'required' }}>
    @error('image') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror

    @if($event?->image)
      <div class="mt-3 inline-flex items-center gap-3 rounded-lg border border-gray-800 bg-gray-900 p-2">
        <img src="{{ asset("images/events/" . $event->image) }}" alt="Event image"
             class="h-20 w-20 rounded object-cover ring-1 ring-gray-700">
        <span class="text-sm text-gray-300">Current image</span>
      </div>
    @endif
  </div>

  {{-- Actions --}}
  <div class="flex items-center gap-3">
    <button type="submit"
            class="inline-flex items-center justify-center rounded-md bg-pink-600 px-4 py-2 text-sm font-medium text-white
                   shadow-sm transition hover:bg-pink-500 hover:shadow-pink-500/30">
      {{ $event ? 'Update Event' : 'Create Event' }}
    </button>

    <a href="{{ route('events.index') }}"
       class="text-sm text-gray-300 underline underline-offset-4 hover:text-gray-100">
      Cancel
    </a>
  </div>
</form>
