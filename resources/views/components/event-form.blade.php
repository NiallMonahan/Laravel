@props([
  'action' => route('events.store'),
  'method' => 'POST',
  'event'  => null,
])

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
              placeholder="What’s happening? When, who, why?">{{ old('description', $event->description ?? '') }}</textarea>
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

  <label class="block text-sm text-gray-200">Artists</label>
<select name="artists[]" multiple class="w-full bg-gray-800 text-gray-200">
    @foreach($artists as $artist)
        <option value="{{ $artist->id }}" 
            @if(isset($event) && $event->artists->contains($artist->id)) selected @endif>
            {{ $artist->name }}
        </option>
    @endforeach
</select>

</form>
