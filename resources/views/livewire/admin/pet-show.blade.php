<div class="py-8 px-6 text-white dark:bg-gray-900 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Pet Details</h1>

    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-gray-900 dark:text-white">
        <!-- Top: Photo + Pet/Owner Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Pet Photo -->
            <div class="col-span-1">
                <img
                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                    alt="{{ $pet->name }}"
                    class="rounded-lg w-full h-auto object-cover border border-gray-300"
                >
            </div>

            <!-- Pet Info -->
            <div class="col-span-1 md:col-span-1 space-y-2">
                <h2 class="text-2xl font-semibold mb-2">{{ $pet->name }}</h2>
                <p><strong>Species:</strong> {{ $pet->species }}</p>
                <p><strong>Breed:</strong> {{ $pet->breed }}</p>
                <p><strong>Gender:</strong> {{ $pet->gender }}</p>
                <p><strong>Birth Date:</strong> {{ $pet->birth_date }}</p>
                <p><strong>Weight:</strong> {{ $pet->weight }} kg</p>
                <p><strong>Allergies:</strong> {{ $pet->allergies }}</p>
                <p><strong>Food Preferences:</strong> {{ $pet->food_preferences }}</p>
                <p><strong>Sterilized:</strong> {{ $pet->sterilized ? 'Yes' : 'No' }}</p>
            </div>

            <!-- Owner Info -->
            <div class="col-span-1 space-y-2">
                <h2 class="text-2xl font-semibold mb-2">Owner Details</h2>
                <p><strong>Name:</strong> {{ $pet->owner->name }}</p>
                <p><strong>Email:</strong> {{ $pet->owner->email }}</p>
            </div>
        </div>

        <!-- Appointments -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Appointments</h3>
            @forelse($pet->appointments as $appointment)
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 border-b border-gray-300 py-4">
                    <div>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                    </div>
                    <div>
                        <p><strong>Vet:</strong> {{ $appointment->veterinarian->name }}</p>
                    </div>
                    <div>
                        <p><strong>Notes:</strong> {{ $appointment->notes ?: '—' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No appointments found.</p>
            @endforelse
        </div>
    </div>
</div>
