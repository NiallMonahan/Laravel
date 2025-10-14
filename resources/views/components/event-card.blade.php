@props([
  'title',
  'description' => null,
  'image' => null,
  'date' => null,
  'location' => null,
  'bookUrl' => null,   // keeping your existing prop name for the Show link
])

@php
  use Illuminate\Support\Str;

  // 1) Start with whatever is stored in DB
  $path = $image;

  // 2) If it's an external URL, use it as-is
  if ($path && Str::startsWith($path, ['http://','https://'])) {
      $img = $path;
  } else {
      // 3) Normalize local paths
      //    - strip leading slash
      //    - if it's just a filename, prefix with images/events/
      //    - allow both 'images/...' and 'storage/...'
      $path = $path ? ltrim($path, '/') : null;

      if ($path && !Str::startsWith($path, ['images/','storage/'])) {
          $path = 'images/events/'.$path;
      }

      // 4) If still empty, use placeholder
      $img = $path ? asset($path) : asset('images/events/placeholder.jpg');
  }
@endphp

<article class="group overflow-hidden rounded-2xl border border-slate-700 bg-slate-900 shadow-sm transition hover:shadow-lg">

  {{-- Image --}}
  <a href="{{ $bookUrl ?? '#' }}" class="block relative">
    <img src="{{ $img }}" alt="{{ $title }}"
         class="h-44 w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]">
    @if($date)
      <span class="absolute bottom-2 left-2 rounded-md bg-white/90 px-2 py-0.5 text-xs font-medium text-slate-700 backdrop-blur">
        {{ \Carbon\Carbon::parse($date)->format('M j, Y') }}
      </span>
    @endif
  </a>

  {{-- Content --}}
  <div class="p-5 space-y-3">
    <h3 class="text-base font-semibold text-slate-900">
      <a href="{{ $bookUrl ?? '#' }}" class="hover:underline">{{ $title }}</a>
    </h3>

    @if($location)
      <div class="mt-1 text-xs text-slate-500 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5Z"/>
        </svg>
        {{ $location }}
      </div>
    @endif

    @if($description)
      <p class="text-sm text-slate-600">
        {{ Str::limit(strip_tags($description), 120) }}
      </p>
    @endif

    <div class="pt-1">
      <a href="{{ $bookUrl ?? '#' }}"
         class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-indigo-500">
        View details
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
          <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
        </svg>
      </a>
    </div>
  </div>
</article>
