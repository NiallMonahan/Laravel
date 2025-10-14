@props([
  'action' => route('events.store'),
  'method' => 'POST',
  'event'  => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-4">
  @csrf
  @if(in_array($method, ['PUT','PATCH','DELETE']))
    @method($method)
  @endif

  <div>
    <label class="block font-semibold" for="title">Title</label>
    <input id="title" type="text" name="title" class="w-full border rounded p-2"
           value="{{ old('title', $event->title ?? '') }}" required>
    @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block font-semibold" for="description">Description</label>
    <textarea id="description" name="description" class="w-full border rounded p-2" rows="4" required>
{{ old('description', $event->description ?? '') }}</textarea>
    @error('description') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block font-semibold" for="event_date">Date</label>
    <input id="event_date" type="date" name="event_date" class="w-full border rounded p-2"
           value="{{ old('event_date',
              ($event?->event_date instanceof \Carbon\Carbon)
                ? $event->event_date->format('Y-m-d')
                : ($event?->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '')
           ) }}" required>
    @error('event_date') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block font-semibold" for="location">Location</label>
    <input id="location" type="text" name="location" class="w-full border rounded p-2"
           value="{{ old('location', $event->location ?? '') }}" required>
    @error('location') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block font-semibold" for="image">Image</label>
    <input id="image" type="file" name="image" class="w-full border rounded p-2" {{ $event ? '' : 'required' }}>
    @error('image') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

    @if($event?->image)
      <div class="mt-2">
        <img src="{{ asset($event->image) }}" alt="Event image" class="w-24 h-24 object-cover rounded">
      </div>
    @endif
  </div>

  <div class="flex items-center gap-3">
    <x-primary-button>{{ $event ? 'Update Event' : 'Create Event' }}</x-primary-button>
    <a href="{{ route('events.index') }}" class="underline text-sm">Cancel</a>
  </div>
</form>
