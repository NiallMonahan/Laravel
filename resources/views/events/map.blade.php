<x-app-layout>
    <div class="py-8">
        <div class="max-w-[1600px] mx-auto px-4">
            <h1
                class="text-4xl font-extrabold bg-gradient-to-r from-pink-500 to-indigo-400 bg-clip-text text-transparent tracking-tight text-center mb-8">
                Events Map
            </h1>

            <!-- Map Container -->
            <div id="map" class="w-full h-96 md:h-[600px] rounded-2xl border border-gray-800 shadow-md"></div>

            <!-- Events List Below Map -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($events as $event)
                    <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 hover:border-pink-500 transition">
                        <h3 class="text-lg font-semibold text-gray-100 mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-400 text-sm mb-2">{{ $event->location }}</p>
                        <p class="text-pink-400 text-sm mb-3">{{ $event->event_date }}</p>

                        @if($event->artists->count() > 0)
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($event->artists as $artist)
                                    <span class="bg-pink-600 text-white text-xs px-2 py-1 rounded">{{ $artist->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('events.show', $event) }}"
                            class="inline-flex items-center text-sm text-pink-400 hover:text-pink-300 transition">
                            View Details →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize map centered on Ireland
            const map = L.map('map').setView([53.3498, -6.2603], 7);

            // Add tile layer (OpenStreetMap)
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Events data from Laravel
            const events = @json($events);

            // Add markers for each event
            events.forEach(event => {
                if (event.latitude && event.longitude) {
                    // Create custom pink icon
                    const pinkIcon = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: #ec4899; width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                        iconSize: [24, 24],
                        iconAnchor: [12, 12]
                    });

                    // Create compact popup content
                    const artistsList = event.artists.map(artist => artist.name).join(', ');
                    const popupContent = `
                        <div class="bg-gray-900 text-gray-100 p-3 rounded-lg border border-gray-800">
                            <h3 class="font-semibold text-pink-400 mb-2">${event.title}</h3>
                            <p class="text-xs text-gray-300 mb-1">${event.location} • ${event.event_date}</p>
                            ${artistsList ? `<p class="text-xs text-gray-400 mb-2">${artistsList}</p>` : ''}
                            <a href="/events/${event.id}" class="inline-block bg-pink-600 hover:bg-pink-700 text-white px-2 py-1 rounded text-xs transition">
                                View Details
                            </a>
                        </div>
                    `;

                    // Add marker to map
                    L.marker([event.latitude, event.longitude], { icon: pinkIcon })
                        .addTo(map)
                        .bindPopup(popupContent, {
                            maxWidth: 250,
                            className: 'custom-popup',
                            closeButton: true,
                            autoPan: true
                        });
                }
            });

            // If no events with coordinates, show message
            if (events.length === 0) {
                L.popup()
                    .setLatLng([53.3498, -6.2603])
                    .setContent('No events with location coordinates yet. Add some events with coordinates to see them on the map!')
                    .openOn(map);
            }
        });
    </script>

    <!-- Custom CSS for popup styling -->
    <style>
        .custom-popup .leaflet-popup-content-wrapper {
            background: transparent !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .custom-popup .leaflet-popup-tip {
            background: #1f2937 !important;
            border: 1px solid #374151 !important;
        }

        .custom-popup .leaflet-popup-close-button {
            color: #ec4899 !important;
            background: #1f2937 !important;
            border-radius: 50% !important;
            width: 20px !important;
            height: 20px !important;
            right: 5px !important;
            top: 5px !important;
        }

        .custom-popup .leaflet-popup-close-button:hover {
            background: #374151 !important;
        }

        .custom-popup .leaflet-popup-content {
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
</x-app-layout>