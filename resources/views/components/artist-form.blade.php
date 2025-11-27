@props([
  'action' => route('artists.store'),
  'method' => 'POST',
  'artist'  => null,
])

<form action="{{ $action }}" method="POST" 
      class="space-y-5 rounded-2xl border border-gray-800 bg-gray-900 p-6 shadow-md">
  @csrf
  @if(in_array($method, ['PUT','PATCH','DELETE']))
    @method($method)
  @endif

  {{-- Name --}}
  <div>
    <label for="name" class="mb-1 block text-sm font-semibold text-gray-200">Name</label>
    <input id="name" type="text" name="name"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                  focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           placeholder="Artist name"
           value="{{ old('name', $artist->name ?? '') }}" required>
    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Genre --}}
  <div>
    <label for="genre" class="mb-1 block text-sm font-semibold text-gray-200">Genre</label>
    <input id="genre" type="text" name="genre"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                  focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
           placeholder="Music genre"
           value="{{ old('genre', $artist->genre ?? '') }}" required>
    @error('genre') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Bio --}}
  <div>
    <label for="bio" class="mb-1 block text-sm font-semibold text-gray-200">Bio</label>
    <textarea id="bio" name="bio" rows="4"
              class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 placeholder-gray-400
                     focus:border-pink-500 focus:ring-2 focus:ring-pink-500/40 transition"
              placeholder="Tell us about the artist...">{{ old('bio', $artist->bio ?? '') }}</textarea>
    @error('bio') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Image --}}
  <div>
    <label for="image" class="mb-1 block text-sm font-semibold text-gray-200">Image</label>
    <input id="image" type="file" name="image" accept="image/*"
           class="w-full rounded-lg border border-gray-700 bg-gray-800 p-2.5 text-gray-100 
                  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 
                  file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 
                  hover:file:bg-pink-100">
    @error('image') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
  </div>

  {{-- Actions --}}
  <div class="flex items-center gap-3">
    <button type="submit"
            class="inline-flex items-center justify-center rounded-md bg-pink-600 px-4 py-2 text-sm font-medium text-white
                   shadow-sm transition hover:bg-pink-500 hover:shadow-pink-500/30">
      {{ $artist ? 'Update Artist' : 'Create Artist' }}
    </button>

    <a href="{{ route('artists.index') }}"
       class="text-sm text-gray-300 underline underline-offset-4 hover:text-gray-100">
      Cancel
    </a>
  </div>
</form>