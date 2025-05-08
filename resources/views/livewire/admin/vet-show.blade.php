<div class="py-8 px-6 text-white dark:bg-gray-900 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Vet Details</h1>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
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
                    <div><strong>Website:</strong> {{ $veterinarianProfile->clinic->website }}</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Location</h2>
                <div id="clinic-map" class="h-64 rounded" style="height: 300px;"></div>
            </div>
        </div>



        {{-- Right Column: Calendar --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Appointments</h2>
            <div id="calendar" class="rounded overflow-hidden"></div>
        </div>
    </div>

    <div id="calendar-data"
         data-appointments='{{ $appointmentsJson }}'
         data-vet-id="{{ $veterinarianProfile->user_id }}"
         class="hidden">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clinicLat = {{ $veterinarianProfile->clinic->latitude ?? 0 }};
        const clinicLng = {{ $veterinarianProfile->clinic->longitude ?? 0 }};

        if (clinicLat && clinicLng) {
            const map = L.map('clinic-map').setView([clinicLat, clinicLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([clinicLat, clinicLng])
                .addTo(map)
                .bindPopup("{{ $veterinarianProfile->clinic->name }}")
                .openPopup();
        }
    });
</script>
