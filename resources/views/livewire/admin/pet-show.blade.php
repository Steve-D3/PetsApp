<div class="py-8 px-6 text-white dark:bg-gray-900 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Pet Details</h1>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-gray-900 dark:text-white">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="{{ $pet->name }}" class="rounded-lg w-full h-auto mb-4">
            </div>
            <div>
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
        </div>

        <div class="mt-8">
            <h3 class="text-xl font-semibold mb-2">Appointments</h3>
            @forelse($pet->appointments as $appointment)
                <div class="border-b border-gray-700 py-2">
                    <p><strong>Date:</strong> {{ $appointment->start_time }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                    <p><strong>Vet:</strong> {{ $appointment->veterinarian->name }}</p>
                    <p><strong>Notes:</strong> {{ $appointment->notes }}</p>
                </div>
            @empty
                <p>No appointments found.</p>
            @endforelse
            </div>
    </div>
</div>
