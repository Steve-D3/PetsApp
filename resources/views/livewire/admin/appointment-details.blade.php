<div class="py-6 bg-gray-200 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
            <div class="px-6 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $appointment->pet->name }}
                                <span class="text-gray-500 dark:text-gray-400 font-normal">'s Appointment</span>
                            </h1>
                            <span
                                class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                        <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $appointment->pet->owner->name }}
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                        <button type="button" wire:click="$toggle('showMedicalRecordForm')"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-150">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Add Record
                        </button>
                        <button type="button" wire:click="$toggle('showTreatmentForm')"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-700 dark:hover:bg-green-600 transition-colors duration-150">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Add Treatment
                        </button>
                        <button type="button" wire:click="$toggle('showVaccineForm')"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:bg-purple-700 dark:hover:bg-purple-600 transition-colors duration-150">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Add Vaccine
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Info -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Appointment Details
                </h2>
            </div>
            <div class="px-6 py-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</p>
                        <p class="text-sm text-gray-900 dark:text-white font-medium">
                            {{ $appointment->start_time->format('F j, Y') }}
                            <span class="text-gray-500 dark:text-gray-400">at
                                {{ $appointment->start_time->format('g:i A') }}</span>
                        </p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                            {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                            {{ $appointment->status === 'scheduled' || $appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Veterinarian</p>
                        <div class="flex items-center">
                            <div
                                class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center mr-2">
                                <svg class="h-4 w-4 text-indigo-600 dark:text-indigo-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-900 dark:text-white font-medium">
                                {{ $appointment->veterinarian->user->name }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Clinic</p>
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-gray-400 dark:text-gray-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="text-sm text-gray-900 dark:text-white">
                                {{ $appointment->veterinarian->clinic?->name ?? 'Not specified' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical Record -->
        @if($appointment->pet->medicalRecords->count() > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Latest Medical Record
                    </h2>
                    <button type="button" wire:click="$toggle('showAllMedicalRecords')"
                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-800/50 transition-colors duration-150">
                        View All Records
                    </button>
                </div>
                <div class="p-6">
                    @php
                        $latestRecord = $appointment->pet->medicalRecords->sortByDesc('record_date')->first();
                    @endphp

                    <div class="space-y-6">
                        <!-- Record Header -->
                        <div
                            class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Record from
                                    {{ $latestRecord->record_date->format('F j, Y') }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Recorded by {{ $latestRecord->veterinarian->user->name ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="mt-3 sm:mt-0">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $latestRecord->follow_up_required ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    {{ $latestRecord->follow_up_required ? 'Follow-up Required' : 'No Follow-up Needed' }}
                                    @if($latestRecord->follow_up_date)
                                        <span class="ml-1 text-gray-500 dark:text-gray-400">
                                            ({{ $latestRecord->follow_up_date->format('M j, Y') }})
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                @if($latestRecord->chief_complaint)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Chief Complaint
                                        </h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ $latestRecord->chief_complaint }}
                                        </p>
                                    </div>
                                @endif

                                @if($latestRecord->history)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">History</h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                            {{ $latestRecord->history }}</p>
                                    </div>
                                @endif

                                @if($latestRecord->physical_examination)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Physical
                                            Examination</h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                            {{ $latestRecord->physical_examination }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                @if($latestRecord->diagnosis)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Diagnosis</h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ $latestRecord->diagnosis }}</p>
                                    </div>
                                @endif

                                @if($latestRecord->treatment_plan)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Treatment Plan
                                        </h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                            {{ $latestRecord->treatment_plan }}</p>
                                    </div>
                                @endif

                                @if($latestRecord->medications)
                                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Medications</h4>
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                            {{ $latestRecord->medications }}</p>
                                    </div>
                                @endif

                                <!-- Vital Signs -->
                                <div
                                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                    <div
                                        class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Vital Signs</h4>
                                    </div>
                                    <div class="grid grid-cols-2 divide-x divide-gray-200 dark:divide-gray-700">
                                        <div class="p-4 text-center">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Weight</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $latestRecord->weight ? $latestRecord->weight . ' kg' : 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Temperature</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $latestRecord->temperature ? $latestRecord->temperature . '°C' : 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Heart Rate</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $latestRecord->heart_rate ? $latestRecord->heart_rate . ' bpm' : 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Respiratory Rate</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $latestRecord->respiratory_rate ? $latestRecord->respiratory_rate . ' rpm' : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-2">
                                <label for="notes"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                            </div>
                            <div class="mt-1">
                                <textarea wire:model.live="notes" rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white"
                                    placeholder="Add any additional notes here..."></textarea>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="button" wire:click="saveNotes"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                    Save Notes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No medical records</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new medical record.
                    </p>
                    <div class="mt-6">
                        <button type="button" wire:click="$toggle('showMedicalRecordForm')"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Medical Record
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Treatment History -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Treatment History
                </h2>
                <button type="button" wire:click="$toggle('showAllTreatments')"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-800/50 transition-colors duration-150">
                    View All
                </button>
            </div>
            <div class="p-6">
                @php
                    $treatments = $appointment->pet->medicalRecords->flatMap(function ($record) {
                        return $record->treatments->map(function ($treatment) use ($record) {
                            $treatment->record_date = $record->record_date;
                            return $treatment;
                        });
                    })->sortByDesc('administered_at');
                    $latestTreatment = $treatments->first();
                @endphp

                @if($treatments->count() > 0)
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    {{ $latestTreatment->name ?? 'Unknown Treatment' }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $latestTreatment->description ?? 'No description provided' }}</p>

                                <div class="mt-4 space-y-2">
                                    <div class="flex items-start">
                                        <span
                                            class="text-xs font-medium text-gray-500 dark:text-gray-400 w-24">Category</span>
                                        <span
                                            class="text-sm text-gray-900 dark:text-gray-100">{{ $latestTreatment->category ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span
                                            class="text-xs font-medium text-gray-500 dark:text-gray-400 w-24">Dosage</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $latestTreatment->quantity }} {{ $latestTreatment->unit }}
                                        </span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-24">Cost</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                            ${{ number_format($latestTreatment->cost, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Status</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $latestTreatment->completed ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                            {{ $latestTreatment->completed ? 'Completed' : 'In Progress' }}
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Administered On</p>
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            @if($latestTreatment->administered_at)
                                                {{ $latestTreatment->administered_at->format('M d, Y \a\t h:i A') }}
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">Not administered yet</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Administered By</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $latestTreatment->administered_by }}
                                        </p>
                                    </div>
                                </div>

                                @if($treatments->count() > 1)
                                    <div class="text-right">
                                        <button type="button" wire:click="$toggle('showAllTreatments')"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            + {{ $treatments->count() - 1 }} more
                                            treatment{{ $treatments->count() > 2 ? 's' : '' }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No treatments recorded</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Get started by adding a new treatment record.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$toggle('showTreatmentForm')"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Treatment
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Vaccine History -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 transition-all duration-200">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Vaccination History
                </h2>
                <button type="button" wire:click="$toggle('showAllVaccinations')"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-800/50 transition-colors duration-150">
                    View All
                </button>
            </div>
            <div class="p-6">
                @php
                    $vaccinations = $appointment->pet->vaccinations->sortByDesc('administered_at');
                    $latestVaccination = $vaccinations->first();
                @endphp

                @if($vaccinations->count() > 0)
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    {{ $latestVaccination->name ?? 'Unknown Vaccine' }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $latestVaccination->type ?? 'No type specified' }}
                                    @if($latestVaccination->manufacturer)
                                        • {{ $latestVaccination->manufacturer }}
                                    @endif
                                </p>

                                <div class="mt-4 space-y-2">
                                    <div class="flex items-start">
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-24">Lot
                                            Number</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 font-mono">
                                            {{ $latestVaccination->lot_number ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <div class="flex items-start">
                                        <span
                                            class="text-xs font-medium text-gray-500 dark:text-gray-400 w-24">Dosage</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $latestVaccination->dosage ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Status</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $latestVaccination->expiration_date->isFuture() ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                            {{ $latestVaccination->expiration_date->isFuture() ? 'Valid' : 'Expired' }}
                                        </span>
                                    </div>

                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Administered On</p>
                                            <p class="text-sm text-gray-900 dark:text-white">
                                                @if($latestVaccination->administered_at)
                                                    {{ $latestVaccination->administered_at->format('M d, Y') }}
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-500">Not administered yet</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Expiration Date</p>
                                            <p
                                                class="text-sm font-medium {{ $latestVaccination->expiration_date->isPast() ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-white' }}">
                                                {{ $latestVaccination->expiration_date->format('M d, Y') }}
                                                @if($latestVaccination->expiration_date->isFuture())
                                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                                        (in
                                                        {{ $latestVaccination->expiration_date->diffForHumans(['parts' => 2, 'short' => false]) }})
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Administered By</p>
                                            <p class="text-sm text-gray-900 dark:text-white">
                                                {{ $latestVaccination->administered_by }}
                                            </p>
                                        </div>
                                        @if($latestVaccination->notes)
                                            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Notes</p>
                                                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                                    {{ $latestVaccination->notes }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($vaccinations->count() > 1)
                                    <div class="text-right">
                                        <button type="button" wire:click="$toggle('showAllVaccinations')"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            + {{ $vaccinations->count() - 1 }} more
                                            vaccination{{ $vaccinations->count() > 2 ? 's' : '' }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vaccinations recorded</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Keep track of your pet's vaccination history.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$toggle('showVaccinationForm')"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Vaccination
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Medical Record Form Modal -->
    @if($showMedicalRecordForm)
        <x-modal wire:model.live="showMedicalRecordForm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Create Medical Record</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Add a new medical record for {{ $appointment->pet->name }}
                </p>
            </div>
            <form wire:submit.prevent="createMedicalRecord">
                <div class="px-6 py-4 space-y-4 max-h-[calc(100vh-14rem)] overflow-y-auto">
                    <!-- Chief Complaint -->
                    <div>
                        <x-label for="chief_complaint" value="Chief Complaint *" />
                        <x-input id="chief_complaint" class="block mt-1 w-full" type="text"
                            wire:model.live="chief_complaint" required />
                        @if($errors->has('chief_complaint')) <span class="text-red-500 text-xs">{{ $errors->first('chief_complaint') }}</span> @endif
                    </div>

                    <!-- History -->
                    <div>
                        <x-label for="history" value="History" />
                        <textarea id="history"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            rows="3" wire:model.live="history"></textarea>
                        @if($errors->has('history')) <span class="text-red-500 text-xs">{{ $errors->first('history') }}</span> @endif
                    </div>

                    <!-- Physical Examination -->
                    <div>
                        <x-label for="physical_examination" value="Physical Examination" />
                        <textarea id="physical_examination"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            rows="3" wire:model.live="physical_examination"></textarea>
                        @if($errors->has('physical_examination')) <span class="text-red-500 text-xs">{{ $errors->first('physical_examination') }}</span> @endif
                    </div>

                    <!-- Diagnosis -->
                    <div>
                        <x-label for="diagnosis" value="Diagnosis *" />
                        <x-input id="diagnosis" class="block mt-1 w-full" type="text" wire:model.live="diagnosis"
                            required />
                        @if($errors->has('diagnosis')) <span class="text-red-500 text-xs">{{ $errors->first('diagnosis') }}</span> @endif
                    </div>

                    <!-- Treatment Plan -->
                    <div>
                        <x-label for="treatment_plan" value="Treatment Plan" />
                        <textarea id="treatment_plan"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            rows="3" wire:model.live="treatment_plan"></textarea>
                        @if($errors->has('treatment_plan')) <span class="text-red-500 text-xs">{{ $errors->first('treatment_plan') }}</span> @endif
                    </div>

                    <!-- Medications -->
                    <div>
                        <x-label for="medications" value="Medications" />
                        <textarea id="medications"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            rows="2" wire:model.live="medications"></textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">List all prescribed medications, dosages,
                            and instructions</p>
                        @if($errors->has('medications')) <span class="text-red-500 text-xs">{{ $errors->first('medications') }}</span> @endif
                    </div>

                    <!-- Notes -->
                    <div>
                        <x-label for="notes" value="Additional Notes" />
                        <textarea id="notes"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            rows="2" wire:model.live="notes"></textarea>
                        @if($errors->has('notes')) <span class="text-red-500 text-xs">{{ $errors->first('notes') }}</span> @endif
                    </div>

                    <!-- Vitals Section -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Vital Signs</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Weight -->
                            <div>
                                <x-label for="weight" value="Weight (kg)" />
                                <x-input id="weight" class="block mt-1 w-full" type="number" step="0.1"
                                    wire:model.live="weight" />
                                @if($errors->has('weight')) <span class="text-red-500 text-xs">{{ $errors->first('weight') }}</span> @endif
                            </div>

                            <!-- Temperature -->
                            <div>
                                <x-label for="temperature" value="Temperature (°C)" />
                                <x-input id="temperature" class="block mt-1 w-full" type="number" step="0.1"
                                    wire:model.live="temperature" />
                                @if($errors->has('temperature')) <span class="text-red-500 text-xs">{{ $errors->first('temperature') }}</span> @endif
                            </div>

                            <!-- Heart Rate -->
                            <div>
                                <x-label for="heart_rate" value="Heart Rate (bpm)" />
                                <x-input id="heart_rate" class="block mt-1 w-full" type="number"
                                    wire:model.live="heart_rate" />
                                @if($errors->has('heart_rate')) <span class="text-red-500 text-xs">{{ $errors->first('heart_rate') }}</span> @endif
                            </div>

                            <!-- Respiratory Rate -->
                            <div>
                                <x-label for="respiratory_rate" value="Respiratory Rate (bpm)" />
                                <x-input id="respiratory_rate" class="block mt-1 w-full" type="number"
                                    wire:model.live="respiratory_rate" />
                                @if($errors->has('respiratory_rate')) <span class="text-red-500 text-xs">{{ $errors->first('respiratory_rate') }}</span> @endif
                            </div>
                        </div>
                    </div>

                    <!-- Follow-up Section -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                        <div class="flex items-center">
                            <input
                                id="follow_up_required"
                                type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                wire:model.live="follow_up_required">
                            <label for="follow_up_required"
                                class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Schedule Follow-up
                            </label>
                            @if($errors->has('follow_up_required'))
                                <span class="text-red-500 text-xs ml-2">{{ $errors->first('follow_up_required') }}</span>
                            @endif
                        </div>

                        @if($follow_up_required)
                            <div class="mt-4 space-y-4">
                                <!-- Date Picker -->
                                <div>
                                    <x-label for="selectedDate" value="Select Date *" />
                                    <x-input
                                        id="selectedDate"
                                        class="block mt-1 w-full"
                                        type="date"
                                        wire:model.live="selectedDate"
                                        min="{{ now()->format('Y-m-d') }}"
                                        required
                                    />
                                    @if($errors->has('selectedDate'))
                                        <span class="text-red-500 text-xs">{{ $errors->first('selectedDate') }}</span>
                                    @endif
                                </div>

                                <!-- Debug Info (temporary) -->
                                <div class="text-sm text-gray-500">
                                    Debug: showTimeSlots = {{ $showTimeSlots ? 'true' : 'false' }},
                                    availableSlots count = {{ count($availableSlots) }}
                                </div>

                                <!-- Time Slot Selection -->
                                @if($showTimeSlots && count($availableSlots) > 0)
                                    <div>
                                        <x-label value="Available Time Slots *" />
                                        <div class="mt-2 grid grid-cols-3 gap-2">
                                            @foreach($availableSlots as $slot)
                                                <button
                                                    type="button"
                                                    wire:click="$set('selectedTime', '{{ $slot['time'] }}')"
                                                    @class([
                                                        'px-4 py-2 text-sm font-medium rounded-md border',
                                                        'bg-indigo-100 text-indigo-700 border-indigo-300' => $selectedTime === $slot['time'],
                                                        'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' => $selectedTime !== $slot['time'],
                                                        'dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $selectedTime !== $slot['time'],
                                                    ])
                                                >
                                                    {{ $slot['formatted'] }}
                                                </button>
                                            @endforeach
                                        </div>
                                        @if($errors->has('selectedTime'))
                                            <span class="text-red-500 text-xs">{{ $errors->first('selectedTime') }}</span>
                                        @endif
                                    </div>
                                @elseif($selectedDate && $showTimeSlots)
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        No available time slots for the selected date.
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div
                    class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between">
                    <x-secondary-button type="button" wire:click="$set('showMedicalRecordForm', false)">
                        Cancel
                    </x-secondary-button>
                    <x-button type="submit" class="bg-blue-600 hover:bg-blue-700">
                        <svg wire:loading wire:target="createMedicalRecord"
                            class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Save Medical Record
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endif

    <!-- Treatment Form Modal -->
    @if($showTreatmentForm)
        <x-modal wire:model.live="showTreatmentForm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Treatment</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Add a new treatment for {{ $appointment->pet->name }}
                </p>
            </div>
            <form wire:submit.prevent="createTreatment">
                <div class="px-6 py-4 space-y-4 max-h-[calc(100vh-14rem)] overflow-y-auto">
                    <!-- Treatment Type -->
                    <div>
                        <x-label for="treatment_type_id" value="Treatment Type *" />
                        <select id="treatment_type_id"
                                wire:model.live="treatment_type_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            <option value="">Select a treatment type</option>
                            @foreach($treatmentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->category }})</option>
                            @endforeach
                        </select>
                        @if($errors->has('treatment_type_id')) <span class="text-red-500 text-xs">{{ $errors->first('treatment_type_id') }}</span> @endif
                    </div>

                    <!-- Quantity and Unit -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="quantity" value="Quantity *" />
                            <x-input id="quantity"
                                    type="number"
                                    step="0.01"
                                    min="0.1"
                                    class="block mt-1 w-full"
                                    wire:model.live="quantity"
                                    required />
                            @if($errors->has('quantity')) <span class="text-red-500 text-xs">{{ $errors->first('quantity') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="unit" value="Unit *" />
                            <x-input id="unit"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="unit"
                                    required />
                            @if($errors->has('unit')) <span class="text-red-500 text-xs">{{ $errors->first('unit') }}</span> @endif
                        </div>
                    </div>

                    <!-- Cost -->
                    <div>
                        <x-label for="cost" value="Cost ({{ config('app.currency', 'USD') }}) *" />
                        <x-input id="cost"
                                type="number"
                                step="0.01"
                                min="0"
                                class="block mt-1 w-full"
                                wire:model.live="cost"
                                required />
                        @if($errors->has('cost')) <span class="text-red-500 text-xs">{{ $errors->first('cost') }}</span> @endif
                    </div>

                    <!-- Administered Details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="administered_at" value="Administered At" />
                            <x-input id="administered_at"
                                    type="datetime-local"
                                    class="block mt-1 w-full"
                                    wire:model.live="administered_at" />
                            @if($errors->has('administered_at')) <span class="text-red-500 text-xs">{{ $errors->first('administered_at') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="administered_by" value="Administered By" />
                            <x-input id="administered_by"
                                    type="text"
                                    class="block mt-1 w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed"
                                    wire:model.live="administered_by"
                                    readonly />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This will be recorded as administered by you</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                   wire:model.live="completed">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Mark as completed</span>
                        </label>
                    </div>

                    <!-- Notes -->
                    <div>
                        <x-label for="notes" value="Notes" />
                        <textarea id="notes"
                                 rows="3"
                                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                 wire:model.live="notes"></textarea>
                        @if($errors->has('notes')) <span class="text-red-500 text-xs">{{ $errors->first('notes') }}</span> @endif
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 text-right">
                    <x-secondary-button type="button"
                                      class="mr-2"
                                      wire:click="$set('showTreatmentForm', false)"
                                      wire:loading.attr="disabled">
                        Cancel
                    </x-secondary-button>
                    <x-button type="submit"
                             wire:loading.attr="disabled">
                        <span wire:loading.remove>Add Treatment</span>
                        <span wire:loading>Adding...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endif

    <!-- Vaccine Form Modal -->
    @if($showVaccineForm)
        <x-modal wire:model.live="showVaccineForm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Vaccination</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Record a new vaccination for {{ $appointment->pet->name }}
                </p>
            </div>
            <form wire:submit.prevent="createVaccine">
                <div class="px-6 py-4 space-y-4 max-h-[calc(100vh-14rem)] overflow-y-auto">
                    <!-- Vaccine Type -->
                    <div>
                        <x-label for="vaccine_type_id" value="Vaccine Type *" />
                        <select id="vaccine_type_id"
                                wire:model.live="vaccine_type_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            <option value="">Select a vaccine type</option>
                            @foreach($vaccine_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->category ?? 'General' }})</option>
                            @endforeach
                        </select>
                        @if($errors->has('vaccine_type_id')) <span class="text-red-500 text-xs">{{ $errors->first('vaccine_type_id') }}</span> @endif
                    </div>

                    <!-- Manufacturer -->
                    <div>
                        <x-label for="manufacturer" value="Manufacturer *" />
                        <x-input id="manufacturer"
                                type="text"
                                class="block mt-1 w-full"
                                wire:model.live="manufacturer"
                                required />
                        @if($errors->has('manufacturer')) <span class="text-red-500 text-xs">{{ $errors->first('manufacturer') }}</span> @endif
                    </div>

                    <!-- Batch and Serial Numbers -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-label for="batch_number" value="Batch Number" />
                            <x-input id="batch_number"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="batch_number" />
                            @if($errors->has('batch_number')) <span class="text-red-500 text-xs">{{ $errors->first('batch_number') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="serial_number" value="Serial Number" />
                            <x-input id="serial_number"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="serial_number" />
                            @if($errors->has('serial_number')) <span class="text-red-500 text-xs">{{ $errors->first('serial_number') }}</span> @endif
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-label for="administration_date" value="Administered On *" />
                            <x-input id="administration_date"
                                    type="datetime-local"
                                    class="block mt-1 w-full"
                                    wire:model.live="administration_date"
                                    required />
                            @if($errors->has('administration_date')) <span class="text-red-500 text-xs">{{ $errors->first('administration_date') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="expiration_date" value="Expiration Date *" />
                            <x-input id="expiration_date"
                                    type="date"
                                    class="block mt-1 w-full"
                                    wire:model.live="expiration_date"
                                    required />
                            @if($errors->has('expiration_date')) <span class="text-red-500 text-xs">{{ $errors->first('expiration_date') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="next_due_date" value="Next Due Date *" />
                            <x-input id="next_due_date"
                                    type="date"
                                    class="block mt-1 w-full"
                                    wire:model.live="next_due_date"
                                    required />
                            @if($errors->has('next_due_date')) <span class="text-red-500 text-xs">{{ $errors->first('next_due_date') }}</span> @endif
                        </div>
                    </div>

                    <!-- Administered By -->
                    <div>
                        <x-label for="administered_by_display" value="Administered By *" />
                        <x-input id="administered_by_display"
                                type="text"
                                class="block mt-1 w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed"
                                value="{{ auth()->user()->name }}"
                                readonly />
                        <input type="hidden" name="vaccine_administered_by" wire:model="vaccine_administered_by" value="{{ auth()->id() }}">
                        @if($errors->has('vaccine_administered_by')) <span class="text-red-500 text-xs">{{ $errors->first('vaccine_administered_by') }}</span> @endif
                    </div>

                    <!-- Administration Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-label for="administration_site" value="Administration Site" />
                            <x-input id="administration_site"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="administration_site" />
                            @if($errors->has('administration_site')) <span class="text-red-500 text-xs">{{ $errors->first('administration_site') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="administration_route" value="Administration Route" />
                            <x-input id="administration_route"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="administration_route" />
                            @if($errors->has('administration_route')) <span class="text-red-500 text-xs">{{ $errors->first('administration_route') }}</span> @endif
                        </div>
                        <div class="flex items-end">
                            <label class="inline-flex items-center mt-1">
                                <input type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                       wire:model.live="is_booster">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Is Booster</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dose and Cost -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-label for="dose" value="Dose" />
                            <x-input id="dose"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="block mt-1 w-full"
                                    wire:model.live="dose" />
                            @if($errors->has('dose')) <span class="text-red-500 text-xs">{{ $errors->first('dose') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="dose_unit" value="Unit" />
                            <x-input id="dose_unit"
                                    type="text"
                                    class="block mt-1 w-full"
                                    wire:model.live="dose_unit" />
                            @if($errors->has('dose_unit')) <span class="text-red-500 text-xs">{{ $errors->first('dose_unit') }}</span> @endif
                        </div>
                        <div>
                            <x-label for="vaccine_cost" :value="'Cost (' . config('app.currency', 'USD') . ')'" />
                            <x-input id="vaccine_cost"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="block mt-1 w-full"
                                    wire:model.live="vaccine_cost" />
                            @if($errors->has('vaccine_cost')) <span class="text-red-500 text-xs">{{ $errors->first('vaccine_cost') }}</span> @endif
                        </div>
                    </div>

                    <!-- Certification Number -->
                    <div>
                        <x-label for="certification_number" value="Certification Number" />
                        <x-input id="certification_number"
                                type="text"
                                class="block mt-1 w-full"
                                wire:model.live="certification_number" />
                        @if($errors->has('certification_number')) <span class="text-red-500 text-xs">{{ $errors->first('certification_number') }}</span> @endif
                    </div>

                    <!-- Reaction -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                        <div class="flex items-center mb-4">
                            <input type="checkbox"
                                   id="reaction_observed"
                                   class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-offset-0 focus:ring-red-200 focus:ring-opacity-50"
                                   wire:model.live="reaction_observed">
                            <label for="reaction_observed" class="ml-2 block text-sm font-medium text-red-600 dark:text-red-400">
                                Adverse Reaction Observed
                            </label>
                        </div>

                        @if($reaction_observed)
                            <div class="mt-2">
                                <x-label for="reaction_details" value="Reaction Details *" />
                                <textarea id="reaction_details"
                                          rows="2"
                                          class="mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-500 focus:ring-red-500 dark:border-red-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                          wire:model.live="reaction_details"
                                          required></textarea>
                                @if($errors->has('reaction_details')) <span class="text-red-500 text-xs">{{ $errors->first('reaction_details') }}</span> @endif
                            </div>
                        @endif
                    </div>

                    <!-- Notes -->
                    <div>
                        <x-label for="vaccine_notes" value="Notes" />
                        <textarea id="vaccine_notes"
                                  rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                  wire:model.live="vaccine_notes"></textarea>
                        @if($errors->has('vaccine_notes')) <span class="text-red-500 text-xs">{{ $errors->first('vaccine_notes') }}</span> @endif
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 text-right">
                    <x-secondary-button type="button"
                                      class="mr-2"
                                      wire:click="$set('showVaccineForm', false)"
                                      wire:loading.attr="disabled">
                        Cancel
                    </x-secondary-button>
                    <x-button type="submit"
                             wire:loading.attr="disabled"
                             class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-500">
                        <span wire:loading.remove>Add Vaccination</span>
                        <span wire:loading>Adding...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endif

    <!-- Medication Form Modal -->
    @if($showMedicationForm)
        <x-modal wire:model.live="showMedicationForm">
            <form wire:submit.prevent="createMedication">
                <div class="space-y-4">
                    <div>
                        <x-label for="name" value="Medication Name" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model.live="name" />
                    </div>
                    <div>
                        <x-label for="dosage" value="Dosage" />
                        <x-input id="dosage" class="block mt-1 w-full" type="text" wire:model.live="dosage" />
                    </div>
                    <div>
                        <x-label for="frequency" value="Frequency" />
                        <x-input id="frequency" class="block mt-1 w-full" type="text" wire:model.live="frequency" />
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <x-button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white">
                        Add Medication
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endif

    <!-- View All Medical Records Modal -->
    @if($showAllMedicalRecords)
        <x-modal wire:model.live="showAllMedicalRecords">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Medical Records</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Viewing all medical records for {{ $appointment->pet->name }}
                </p>
            </div>

            <div class="overflow-y-auto max-h-[calc(100vh-14rem)]">
                @forelse($appointment->pet->medicalRecords->sortByDesc('record_date') as $medicalRecord)
                    <div
                        class="p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $medicalRecord->chief_complaint ?: 'Medical Record' }}
                                </h4>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    <time datetime="{{ $medicalRecord->record_date->toIso8601String() }}">
                                        {{ $medicalRecord->record_date->format('F j, Y \a\t g:i A') }}
                                    </time>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $medicalRecord->record_type ?: 'General' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($medicalRecord->history)
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">History
                                    </p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->history }}</p>
                                </div>
                            @endif

                            @if($medicalRecord->physical_examination)
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Physical Examination</p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->physical_examination }}</p>
                                </div>
                            @endif

                            @if($medicalRecord->diagnosis)
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Diagnosis</p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->diagnosis }}</p>
                                </div>
                            @endif

                            @if($medicalRecord->treatment_plan)
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Treatment Plan</p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->treatment_plan }}</p>
                                </div>
                            @endif

                            @if($medicalRecord->medications)
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Medications</p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->medications }}</p>
                                </div>
                            @endif

                            @if($medicalRecord->weight || $medicalRecord->temperature || $medicalRecord->heart_rate || $medicalRecord->respiratory_rate)
                                <div class="md:col-span-2">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Vital
                                        Signs</p>
                                    <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @if($medicalRecord->weight)
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Weight</p>
                                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $medicalRecord->weight }} kg
                                                </p>
                                            </div>
                                        @endif
                                        @if($medicalRecord->temperature)
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Temperature</p>
                                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $medicalRecord->temperature }}°C
                                                </p>
                                            </div>
                                        @endif
                                        @if($medicalRecord->heart_rate)
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Heart Rate</p>
                                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $medicalRecord->heart_rate }} bpm
                                                </p>
                                            </div>
                                        @endif
                                        @if($medicalRecord->respiratory_rate)
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Respiratory Rate</p>
                                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $medicalRecord->respiratory_rate }} rpm
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($medicalRecord->follow_up_required || $medicalRecord->follow_up_date)
                                <div class="md:col-span-2">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Follow-up</p>
                                    <div class="mt-2 flex items-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $medicalRecord->follow_up_required ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                            {{ $medicalRecord->follow_up_required ? 'Follow-up Required' : 'No Follow-up Required' }}
                                        </span>
                                        @if($medicalRecord->follow_up_date)
                                            <div class="ml-3 flex items-center">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="ml-1 text-sm text-gray-700 dark:text-gray-300">
                                                    {{ $medicalRecord->follow_up_date->format('Y-m-d') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    @if($medicalRecord->follow_up_notes)
                                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $medicalRecord->follow_up_notes }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            @if($medicalRecord->notes)
                                <div class="md:col-span-2 mt-2">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Additional Notes</p>
                                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        {{ $medicalRecord->notes }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Recorded by {{ $medicalRecord->veterinarianProfile->user->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    View Full Details
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No medical records found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            No medical records have been created for this pet yet.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$dispatch('open-modal', { name: 'create-medical-record' })"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add Medical Record
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <div
                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $appointment->pet->medicalRecords->count() }}
                    {{ Str::plural('record', $appointment->pet->medicalRecords->count()) }} found
                </div>
                <div class="flex space-x-3">
                    <button type="button" wire:click="$dispatch('open-modal', { name: 'create-medical-record' })"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add New
                    </button>
                    <button type="button" wire:click="$toggle('showAllMedicalRecords')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Close
                    </button>
                </div>
            </div>
        </x-modal>
    @endif

    <!-- View All Treatments Modal -->
    @if($showAllTreatments)
        <x-modal wire:model.live="showAllTreatments">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Treatments</h2>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($appointment->pet->medicalRecords->flatMap(function ($record) {
                        return $record->treatments->map(function ($t) use ($record) {
                            $t->record_date = $record->record_date;
                            return $t;
                        });
                    })->sortByDesc('record_date') as $treatment)
                                                            <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-150">
                                                                <div class="flex flex-col sm:flex-row justify-between gap-4">
                                                                    <div class="flex-1">
                                                                        <div class="flex items-center justify-between">
                                                                            <h3 class="text-base font-medium text-gray-900 dark:text-white">
                                                                                {{ $treatment->name ?? 'Unknown Treatment' }}</h3>
                                                                            <span
                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                                                                {{ $treatment->record_date->format('M d, Y') }}
                                                                            </span>
                                                                        </div>

                                                                        @if($treatment->description)
                                                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $treatment->description }}</p>
                                                                        @endif

                                                                        <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                                                                            <div>
                                                                                <p class="text-gray-500 dark:text-gray-400">Category</p>
                                                                                <p class="font-medium text-gray-900 dark:text-white">{{ $treatment->category ?? 'N/A' }}
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-gray-500 dark:text-gray-400">Quantity</p>
                                                                                <p class="font-medium text-gray-900 dark:text-white">
                                                                                    {{ $treatment->quantity }} {{ $treatment->unit }}
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-gray-500 dark:text-gray-400">Cost</p>
                                                                                <p class="font-medium text-gray-900 dark:text-white">
                                                                                    ${{ number_format($treatment->cost, 2) }}
                                                                                </p>
                                                                            </div>
                                                                            @if($treatment->administered_by)
                                                                                <div>
                                                                                    <p class="text-gray-500 dark:text-gray-400">Administered By</p>
                                                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $treatment->administered_by }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4 sm:mt-0 sm:ml-4">
                                                                        <div class="flex flex-col items-end">
                                                                            <span
                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $treatment->completed ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                                                                {{ $treatment->completed ? 'Completed' : 'Pending' }}
                                                                            </span>
                                                                            @if($treatment->administered_at)
                                                                                <div class="mt-2 text-right">
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Administered</p>
                                                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                                                        {{ $treatment->administered_at->format('M d, Y') }}
                                                                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                                            {{ $treatment->administered_at->format('h:i A') }}
                                                                                        </span>
                                                                                    </p>
                                                                                    @if($treatment->administered_by)
                                                                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                                                            by {{ $treatment->administered_by }}
                                                                                        </p>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @if($treatment->notes)
                                                                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Notes</p>
                                                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $treatment->notes }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No treatments found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            No treatments have been recorded for this pet yet.
                        </p>
                    </div>
                @endforelse
            </div>

            <div
                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-end">
                <button type="button" wire:click="$toggle('showAllTreatments')"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Close
                </button>
            </div>
        </x-modal>
    @endif

    <!-- View All Vaccinations Modal -->
    @if($showAllVaccinations)
        <x-modal wire:model.live="showAllVaccinations">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Vaccination History</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    View and manage all vaccinations for {{ $appointment->pet->name }}
                </p>
            </div>

            <div class="overflow-y-auto max-h-[calc(100vh-14rem)]">
                @forelse($appointment->pet->vaccinations->sortByDesc('administration_date') as $vaccine)
                    <div
                        class="p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $vaccine->vaccinationType?->name ?? 'Unknown Vaccine' }}
                                        </h4>
                                        <div class="mt-1 flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                                {{ $vaccine->vaccinationType?->category ?? 'Unknown Category' }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $vaccine->reaction_observed ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' }}">
                                                {{ $vaccine->reaction_observed ? 'Reaction Observed' : 'No Reaction' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">ADMINISTERED</p>
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            {{ $vaccine->administration_date->format('M d, Y') }}
                                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                                {{ $vaccine->administration_site }} • {{ $vaccine->administration_route }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">DOSE</p>
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            {{ $vaccine->dose }} {{ $vaccine->dose_unit }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">MANUFACTURER</p>
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            {{ $vaccine->manufacturer }}
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                Batch: {{ $vaccine->batch_number }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">NEXT DUE</p>
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            {{ $vaccine->next_due_date->format('M d, Y') }}
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                Expires: {{ $vaccine->expiration_date->format('M d, Y') }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                @if($vaccine->reaction_observed && $vaccine->reaction_details)
                                    <div class="mt-4 p-3 bg-red-50 dark:bg-red-900/20 rounded-md">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200">Reaction Details</p>
                                        <p class="mt-1 text-sm text-red-700 dark:text-red-300">{{ $vaccine->reaction_details }}</p>
                                    </div>
                                @endif

                                @if($vaccine->notes)
                                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</p>
                                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $vaccine->notes }}</p>
                                    </div>
                                @endif

                                @if($vaccine->certification_number)
                                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                                        Certification #{{ $vaccine->certification_number }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vaccinations found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            No vaccinations have been recorded for this pet yet.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$dispatch('open-modal', { name: 'create-vaccination' })"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add Vaccination
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <div
                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $appointment->vaccinations->count() }}
                    {{ Str::plural('vaccination', $appointment->vaccinations->count()) }} found
                </div>
                <div class="flex space-x-3">
                    <button type="button" wire:click="$dispatch('open-modal', { name: 'create-vaccination' })"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add New
                    </button>
                    <button type="button" wire:click="$toggle('showAllVaccinations')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Close
                    </button>
                </div>
            </div>
        </x-modal>
    @endif

    <!-- Toast Notification -->
    <div x-data="{
        show: @entangle('showToast'),
        message: @entangle('toastMessage'),
        type: @entangle('toastType'),
        init() {
            // Auto-hide after 5 seconds
            this.$watch('show', value => {
                if (value) {
                    setTimeout(() => {
                        this.show = false;
                    }, 5000);
                }
            });
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-4 right-4 z-50 max-w-sm w-full"
    @click.away="show = false">
        <div x-bind:class="{
            'bg-green-50 text-green-800 dark:bg-green-900/30 dark:text-green-400': type === 'success',
            'bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-400': type === 'error'
        }" class="rounded-lg p-4 shadow-lg border dark:border-transparent">
            <div class="flex items-start">
                <div x-bind:class="{
                    'text-green-400': type === 'success',
                    'text-red-400': type === 'error'
                }" class="flex-shrink-0">
                    <svg x-show="type === 'success'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="type === 'error'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p x-text="message" class="text-sm font-medium"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('toast-timeout', () => {
            // This is handled by Alpine.js
        });
    });
</script>
@endpush
</div>
