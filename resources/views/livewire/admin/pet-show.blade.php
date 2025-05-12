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
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Appointments</h3>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Appointment
                </a>
            </div>
            
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                @forelse($pet->appointments as $appointment)
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</p>
                                <p class="text-gray-900 dark:text-white font-medium">
                                    {{ \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y H:i') }}
                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($appointment->status === 'scheduled') text-blue-800 dark:text-blue-200
                                    @elseif($appointment->status === 'completed') bg-green-100
                                    @elseif($appointment->status === 'cancelled') dark:bg-red-900
                                    @else @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Veterinarian</p>
                                <p class="text-gray-900 dark:text-white">{{ $appointment->veterinarian->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</p>
                                <p class="text-gray-600 dark:text-gray-300">{{ $appointment->notes ?: '—' }}</p>
                            </div>
                            <div class="flex space-x-3 justify-end">
                                <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No appointments</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new appointment.</p>
                        <div class="mt-6">
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                New Appointment
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
