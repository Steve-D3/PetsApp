<div class="py-8 px-6 text-white dark:bg-gray-900 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Vet Details</h1>

    <div class=" xl:mx-60 lg:mx-40 mx-6 my-20 grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Left Column: Vet and Clinic Info --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Profile Information</h2>
                <div class="space-y-2 text-gray-800 dark:text-gray-100">
                    <div><strong>Name:</strong> {{ $veterinarianProfile->user->name }}</div>
                    <div><strong>Email:</strong> {{ $veterinarianProfile->user->email }}</div>
                    <div><strong>Phone:</strong> {{ $veterinarianProfile->phone_number }}</div>
                    <div><strong>Specialty:</strong> {{ $veterinarianProfile->specialty }}</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Clinic Info</h2>
                <div class="space-y-2 text-gray-800 dark:text-gray-100">
                    <div><strong>Name:</strong> {{ $veterinarianProfile->clinic->name }}</div>
                    <div><strong>Address:</strong> {{ $veterinarianProfile->clinic->address }}</div>
                    <div><strong>Website:</strong> <a href="{{ $veterinarianProfile->clinic->website }}">{{ $veterinarianProfile->clinic->website }}</a></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Clinic Location
                    </h2>
                </div>
                <div id="clinic-map" class="h-80 w-full relative overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-900">
                        <div class="text-center">
                            <div class="animate-pulse">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Loading map...</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-600">
                    <p>Drag to explore the area around the clinic</p>
                </div>
            </div>
        </div>



        {{-- Right Column: Calendar --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 pt-6 pb-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Appointments</h2>
                <a href="{{ route('appointments.create', $veterinarianProfile) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add
                </a>
            </div>
            <div class="p-6 h-full">
                <div id="calendar" class="rounded overflow-hidden mt-10"></div>
            </div>
        </div>
    </div>

    <div id="calendar-data"
         data-appointments='{{ $appointmentsJson }}'
         data-vet-id="{{ $veterinarianProfile->user_id }}"
         class="hidden">
    </div>
</div>

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-B4RCZd7ZZBSoRJpJxMeRQc/ZnC9LA1k64g0146DcoNE="
          crossorigin=""/>
@endpush

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    
    <script>
    function initMap() {
        const clinicLat = {{ $veterinarianProfile->clinic->latitude ?? '51.260197' }};
        const clinicLng = {{ $veterinarianProfile->clinic->longitude ?? '4.402771' }};
        const clinicName = @json($veterinarianProfile->clinic->name ?? '');
        
        if (!clinicLat || !clinicLng) {
            document.getElementById('clinic-map').innerHTML = 
                '<div class="h-full flex items-center justify-center text-gray-500 dark:text-gray-400">' +
                '   <p>Location not available</p>' +
                '</div>';
            return;
        }

        const mapContainer = document.getElementById('clinic-map');
        const loadingElement = mapContainer.querySelector('div[class*="absolute"]');
        
        // Initialize map with essential options
        const map = L.map('clinic-map', {
            center: [clinicLat, clinicLng],
            zoom: 15,
            zoomControl: false,
            attributionControl: false,
            preferCanvas: true
        });
        
        // Set map container styles
        Object.assign(mapContainer.style, {
            display: 'block',
            visibility: 'visible',
            height: '320px'
        });
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
            minZoom: 3
        }).addTo(map);
        
        // Add zoom control
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);
        
        // Add marker with custom icon
        const marker = L.marker([clinicLat, clinicLng], {
            icon: L.divIcon({
                html: `
                    <div class="relative">
                        <div class="animate-ping absolute inline-flex h-8 w-8 rounded-full bg-indigo-400 opacity-75"></div>
                        <div class="relative inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>`,
                className: '',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })
        }).addTo(map);
        
        // Add popup
        if (clinicName) {
            marker.bindPopup(`
                <div class="p-2">
                    <h3 class="font-bold text-gray-900 dark:text-white">${clinicName}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">${@json($veterinarianProfile->clinic->address ?? '')}</p>
                    <div class="mt-2">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${clinicLat},${clinicLng}" 
                           target="_blank" 
                           class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                            Get Directions
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            `).openPopup();
        }
        
        // Configure map interactions
        map.dragging.enable();
        map.scrollWheelZoom.enable();
        map.doubleClickZoom.enable();
        if (map.tap) map.tap.disable();
        
        // Remove loading state
        if (loadingElement) {
            loadingElement.style.opacity = '0';
            setTimeout(() => loadingElement.remove(), 300);
        }
        
        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => map.invalidateSize(true), 100);
        });
    }
    
    // Initialize map when Livewire is ready or on DOM load
    if (window.Livewire) {
        window.Livewire.hook('morph.updated', initMap);
    } else {
        document.addEventListener('livewire:load', initMap);
    }
    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endpush
