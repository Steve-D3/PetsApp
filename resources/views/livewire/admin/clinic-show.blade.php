@push('scripts')
    <script>
        function initMap() {
            // Geocode the address when the component mounts
            const geocoder = new google.maps.Geocoder();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: { lat: 50.8503, lng: 4.3517 }, // Default to Brussels, will be updated after geocoding
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM,
                },
            });

            const address = '{{ $clinic->address }}, {{ $clinic->postal_code }} {{ $clinic->city }}, {{ $clinic->country }}';
            
            geocoder.geocode({ 'address': address }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: '{{ $clinic->name }}',
                        animation: google.maps.Animation.DROP,
                    });
                }
            });
        }

        // Load the Google Maps API with your API key
        function loadGoogleMaps() {
            const script = document.createElement('script');
            const apiKey = '{{ config('services.google.maps_key') }}';
            if (!apiKey) {
                console.error('Google Maps API key is not configured');
                document.getElementById('map').innerHTML = '<div class="p-4 text-center text-gray-500 dark:text-gray-400">Map cannot be loaded: Missing Google Maps API key</div>';
                return;
            }
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        // Load the map when the page is fully loaded
        document.addEventListener('DOMContentLoaded', loadGoogleMaps);
    </script>
@endpush

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.clinics.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Clinics
            </a>
        </div>

        <!-- Clinic Header -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $clinic->name }}</h1>
                        
                        <!-- Contact Info -->
                        <div class="mt-4 space-y-2">
                            <!-- Address -->
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-gray-900 dark:text-white">{{ $clinic->address }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $clinic->postal_code }} {{ $clinic->city }}, {{ $clinic->country }}</p>
                                </div>
                            </div>

                            @if($clinic->phone || $clinic->email || $clinic->website)
                                <div class="space-y-1">
                                    @if($clinic->phone)
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <a href="tel:{{ $clinic->phone }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ $clinic->phone }}
                                            </a>
                                        </div>
                                    @endif

                                    @if($clinic->email)
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <a href="mailto:{{ $clinic->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ $clinic->email }}
                                            </a>
                                        </div>
                                    @endif

                                    @if($clinic->website)
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                            <a href="{{ $clinic->website }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ parse_url($clinic->website, PHP_URL_HOST) }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="mt-6 md:mt-0 md:ml-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Clinic Stats</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow">
                                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalVets }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Veterinarians</p>
                                </div>
                                <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow">
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $upcomingAppointments }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Upcoming Appointments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Location</h3>
                    </div>
                    <div class="h-64 md:h-80 relative" id="map">
                        <!-- Map will be loaded here -->
                    </div>
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $clinic->address }}, {{ $clinic->postal_code }} {{ $clinic->city }}, {{ $clinic->country }}
                        </div>
                        <a 
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($clinic->address . ', ' . $clinic->postal_code . ' ' . $clinic->city . ', ' . $clinic->country) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 dark:text-blue-100 dark:bg-blue-800 dark:hover:bg-blue-700"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Open in Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Veterinarians Section -->
        <div class="mt-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Veterinarians</h2>
                <div class="mt-2 md:mt-0">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="searchVet"
                        placeholder="Search veterinarians..."
                        class="w-full md:w-64 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                </div>
            </div>

            @if($veterinarians->count() > 0)
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($veterinarians as $vet)
                            <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                        <span class="text-blue-600 dark:text-blue-300 font-medium">
                                            {{ substr($vet->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $vet->user->name }}
                                            @if($vet->specialty)
                                                <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $vet->specialty }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $vet->user->email }}
                                            @if($vet->license_number)
                                                <span class="ml-2 text-xs text-gray-400">License: {{ $vet->license_number }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <button
                                            wire:click="viewVet({{ $vet->id }})"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                            title="View Details"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                        {{ $veterinarians->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No veterinarians found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            @if($searchVet)
                                No veterinarians match your search criteria.
                            @else
                                There are currently no veterinarians assigned to this clinic.
                            @endif
                        </p>
                        <div class="mt-6">
                            <button
                                type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Veterinarian
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Veterinarian Details Modal -->
    @if($showVetModal && $vetToView)
        <div class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeVetModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" class="bg-white dark:bg-gray-800 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none" wire:click="closeVetModal">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div>
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                {{ $vetToView->user->name }}
                            </h3>
                            <div class="mt-2">
                                <div class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                    <p class="flex items-center justify-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $vetToView->user->email }}
                                    </p>
                                    @if($vetToView->specialty)
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $vetToView->specialty }}
                                            </span>
                                        </p>
                                    @endif
                                    @if($vetToView->license_number)
                                        <p>
                                            <span class="font-medium">License:</span> {{ $vetToView->license_number }}
                                        </p>
                                    @endif
                                    @if($vetToView->biography)
                                        <div class="mt-4 text-left">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">About</h4>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                {{ $vetToView->biography }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button
                            type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm"
                            wire:click="closeVetModal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
