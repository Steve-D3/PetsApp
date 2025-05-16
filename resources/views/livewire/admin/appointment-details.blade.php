<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">
                            Appointment Details - {{ $appointment->pet->name }}
                        </h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Owner: {{ $appointment->pet->owner->name }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <x-button wire:click="$toggle('showMedicalRecordForm')" class="bg-blue-600 hover:bg-blue-700 text-white">
                            Add Medical Record
                        </x-button>
                        <x-button wire:click="$toggle('showTreatmentForm')" class="bg-green-600 hover:bg-green-700 text-white">
                            Add Treatment
                        </x-button>
                        <x-button wire:click="$toggle('showVaccineForm')" class="bg-purple-600 hover:bg-purple-700 text-white">
                            Add Vaccine
                        </x-button>
                        <x-button wire:click="createMedication" class="bg-yellow-600 hover:bg-yellow-700 text-white">
                            Add Medication
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Info -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Appointment Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date & Time</p>
                        <p class="text-sm text-gray-900">
                            {{ $appointment->start_time->format('M d, Y H:i') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $appointment->status === 'completed' ? 'green' : ($appointment->status === 'cancelled' ? 'red' : 'blue') }}-100 text-{{ $appointment->status === 'completed' ? 'green' : ($appointment->status === 'cancelled' ? 'red' : 'blue') }}-800">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Veterinarian</p>
                        <p class="text-sm text-gray-900">{{ $appointment->veterinarian->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Clinic</p>
                        <p class="text-sm text-gray-900">{{ $appointment->veterinarian->clinic?->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical Record -->
        @if($appointment->pet->medicalRecords->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Latest Medical Record</h2>
                        <x-button wire:click="$toggle('showAllMedicalRecords')" class="bg-blue-600 hover:bg-blue-700 text-white">
                            View All Medical Records
                        </x-button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Record Date</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->record_date->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Chief Complaint</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->chief_complaint }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">History</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->history }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Physical Examination</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->physical_examination }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Diagnosis</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->diagnosis }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Treatment Plan</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->treatment_plan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Medications</p>
                            <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->medications }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Notes</p>
                            <textarea wire:model.live="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="3"></textarea>
                            <div class="mt-2">
                                <x-button wire:click="saveNotes" class="bg-blue-600 hover:bg-blue-700 text-white">
                                    Save Notes
                                </x-button>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Vital Signs</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Weight</p>
                                    <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->weight }} kg</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Temperature</p>
                                    <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->temperature }}°C</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Heart Rate</p>
                                    <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->heart_rate }} bpm</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Respiratory Rate</p>
                                    <p class="text-sm text-gray-900">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->respiratory_rate }} rpm</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Follow-up</p>
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->follow_up_required ? 'green' : 'red' }}-100 text-{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->follow_up_required ? 'green' : 'red' }}-800">
                                    {{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->follow_up_required ? 'Required' : 'Not Required' }}
                                </span>
                                @if($appointment->pet->medicalRecords->sortByDesc('record_date')->first()->follow_up_date)
                                    <p class="ml-2 text-sm text-gray-500">{{ $appointment->pet->medicalRecords->sortByDesc('record_date')->first()->follow_up_date->format('M d, Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <p class="text-sm text-gray-500">No medical records created for this appointment yet</p>
                </div>
            </div>
        @endif

        <!-- Treatment History -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Latest Treatment</h2>
                    <x-button wire:click="$toggle('showAllTreatments')" class="bg-blue-600 hover:bg-blue-700 text-white">
                        View All Treatments
                    </x-button>
                </div>
                @if($appointment->pet->medicalRecords->flatMap(function($record) { return $record->treatments; })->count() > 0)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        @php
                            $latestTreatment = $appointment->pet->medicalRecords->flatMap(function($record) { return $record->treatments; })->sortByDesc('administered_at')->first();
                        @endphp
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $latestTreatment->name ?? 'Unknown Treatment' }}</p>
                                <p class="text-sm text-gray-500">Description: {{ $latestTreatment->description ?? 'No description' }}</p>
                                <p class="text-sm text-gray-500">Category: {{ $latestTreatment->category ?? 'Unknown Category' }}</p>
                                <p class="text-sm text-gray-500">Cost: ${{ number_format($latestTreatment->cost, 2) }}</p>
                                <p class="text-sm text-gray-500">Quantity: {{ $latestTreatment->quantity }} {{ $latestTreatment->unit }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Administered: {{ $latestTreatment->administered_at->format('M d, Y H:i') }}</p>
                                <p class="text-sm text-gray-500">Administered by: {{ $latestTreatment->administered_by }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $latestTreatment->completed ? 'green' : 'red' }}-100 text-{{ $latestTreatment->completed ? 'green' : 'red' }}-800">
                                    {{ $latestTreatment->completed ? 'Completed' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500">No treatments recorded yet</p>
                @endif
            </div>
        </div>

        <!-- Vaccine History -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Latest Vaccination</h2>
                    <x-button wire:click="$toggle('showAllVaccinations')" class="bg-blue-600 hover:bg-blue-700 text-white">
                        View All Vaccinations
                    </x-button>
                </div>
                @if($appointment->vaccinations->count() > 0)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        @php
                            $latestVaccine = $appointment->vaccinations->sortByDesc('administration_date')->first();
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Vaccine Type</p>
                                <p class="text-sm font-medium text-gray-900">{{ $latestVaccine->vaccinationType?->name ?? 'Unknown Vaccine' }}</p>
                                <p class="text-sm text-gray-500">Category: {{ $latestVaccine->vaccinationType?->category ?? 'Unknown Category' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Administration</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->administration_date->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-500">Site: {{ $latestVaccine->administration_site }}</p>
                                <p class="text-sm text-gray-500">Route: {{ $latestVaccine->administration_route }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dose</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->dose }} {{ $latestVaccine->dose_unit }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Manufacturer & Batch</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->manufacturer }}</p>
                                <p class="text-sm text-gray-500">Batch: {{ $latestVaccine->batch_number }}</p>
                                <p class="text-sm text-gray-500">Expires: {{ $latestVaccine->expiration_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Next Due</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->next_due_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $latestVaccine->reaction_observed ? 'red' : 'green' }}-100 text-{{ $latestVaccine->reaction_observed ? 'red' : 'green' }}-800">
                                        {{ $latestVaccine->reaction_observed ? 'Reaction Observed' : 'No Reaction' }}
                                    </span>
                                    @if($latestVaccine->reaction_observed)
                                        <p class="ml-2 text-sm text-gray-500">{{ $latestVaccine->reaction_details }}</p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Certification</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->certification_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Notes</p>
                                <p class="text-sm text-gray-900">{{ $latestVaccine->notes }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500">No vaccinations recorded yet</p>
                @endif
            </div>
        </div>

        <!-- Medical Record Form Modal -->
        @if($showMedicalRecordForm)
            <x-modal wire:model.live="showMedicalRecordForm">
                <form wire:submit.prevent="createMedicalRecord">
                    <div class="space-y-4">
                        <div>
                            <x-label for="diagnosis" value="Diagnosis" />
                            <x-input id="diagnosis" class="block mt-1 w-full" type="text" wire:model.live="diagnosis" />
                        </div>
                        <div>
                            <x-label for="notes" value="Notes" />
                            <textarea id="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="3" wire:model.live="notes"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <x-button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white">
                            Create Medical Record
                        </x-button>
                    </div>
                </form>
            </x-modal>
        @endif

        <!-- Treatment Form Modal -->
        @if($showTreatmentForm)
            <x-modal wire:model.live="showTreatmentForm">
                <form wire:submit.prevent="createTreatment">
                    <div class="space-y-4">
                        <div>
                            <x-label for="treatment_type_id" value="Treatment Type" />
                            <select id="treatment_type_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" wire:model.live="treatment_type_id">
                                <option value="">Select Treatment Type</option>
                                @foreach($treatment_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="notes" value="Notes" />
                            <textarea id="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="3" wire:model.live="notes"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <x-button type="submit" class="bg-green-600 hover:bg-green-700 text-white">
                            Add Treatment
                        </x-button>
                    </div>
                </form>
            </x-modal>
        @endif

        <!-- Vaccine Form Modal -->
        @if($showVaccineForm)
            <x-modal wire:model.live="showVaccineForm">
                <form wire:submit.prevent="createVaccine">
                    <div class="space-y-4">
                        <div>
                            <x-label for="vaccine_type_id" value="Vaccine Type" />
                            <select id="vaccine_type_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" wire:model.live="vaccine_type_id">
                                <option value="">Select Vaccine Type</option>
                                @foreach($vaccine_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="manufacturer" value="Manufacturer" />
                            <x-input id="manufacturer" class="block mt-1 w-full" type="text" wire:model.live="manufacturer" />
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <x-button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white">
                            Add Vaccine
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
                <div class="space-y-6 m-8">
                    @forelse($appointment->pet->medicalRecords as $medicalRecord)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Record Date</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->record_date->format('M d, Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Chief Complaint</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->chief_complaint }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">History</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->history }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Physical Examination</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->physical_examination }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Diagnosis</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->diagnosis }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Treatment Plan</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->treatment_plan }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Medications</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->medications }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Notes</p>
                                    <p class="text-sm text-gray-900">{{ $medicalRecord->notes }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vital Signs</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Weight</p>
                                            <p class="text-sm text-gray-900">{{ $medicalRecord->weight }} kg</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Temperature</p>
                                            <p class="text-sm text-gray-900">{{ $medicalRecord->temperature }}°C</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Heart Rate</p>
                                            <p class="text-sm text-gray-900">{{ $medicalRecord->heart_rate }} bpm</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Respiratory Rate</p>
                                            <p class="text-sm text-gray-900">{{ $medicalRecord->respiratory_rate }} rpm</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Follow-up</p>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $medicalRecord->follow_up_required ? 'green' : 'red' }}-100 text-{{ $medicalRecord->follow_up_required ? 'green' : 'red' }}-800">
                                            {{ $medicalRecord->follow_up_required ? 'Required' : 'Not Required' }}
                                        </span>
                                        @if($medicalRecord->follow_up_date)
                                            <p class="ml-2 text-sm text-gray-500">{{ $medicalRecord->follow_up_date->format('M d, Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No medical records found</p>
                    @endforelse
                </div>
            </x-modal>
        @endif

        <!-- View All Treatments Modal -->
        @if($showAllTreatments)
            <x-modal wire:model.live="showAllTreatments">
                <div class="space-y-6 m-8">
                    @forelse($appointment->pet->medicalRecords->flatMap(function($record) { return $record->treatments; })->sortByDesc('administered_at') as $treatment)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                <p class="text-sm font-medium text-gray-900">{{ $treatment->name ?? 'Unknown Treatment' }}</p>
                                <p class="text-sm text-gray-500">Description: {{ $treatment->description ?? 'No description' }}</p>
                                <p class="text-sm text-gray-500">Category: {{ $treatment->category ?? 'Unknown Category' }}</p>
                                <p class="text-sm text-gray-500">Cost: ${{ number_format($treatment->cost, 2) }}</p>
                                <p class="text-sm text-gray-500">Quantity: {{ $treatment->quantity }} {{ $treatment->unit }}</p>
                            </div>
                                <div>
                                    <p class="text-sm text-gray-500">Administered: {{ $treatment->administered_at->format('M d, Y H:i') }}</p>
                                    <p class="text-sm text-gray-500">Administered by: {{ $treatment->administered_by }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $treatment->completed ? 'green' : 'red' }}-100 text-{{ $treatment->completed ? 'green' : 'red' }}-800">
                                        {{ $treatment->completed ? 'Completed' : 'Pending' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No treatments found</p>
                    @endforelse
                </div>
            </x-modal>
        @endif

        <!-- View All Vaccinations Modal -->
        @if($showAllVaccinations)
            <x-modal wire:model.live="showAllVaccinations">
                <div class="space-y-6 m-8">
                    @forelse($appointment->vaccinations->sortByDesc('administration_date') as $vaccine)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vaccine Type</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->vaccinationType?->name ?? 'Unknown Vaccine' }}</p>
                                    <p class="text-sm text-gray-500">Category: {{ $vaccine->vaccinationType?->category ?? 'Unknown Category' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Administration</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->administration_date->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-500">Site: {{ $vaccine->administration_site }}</p>
                                    <p class="text-sm text-gray-500">Route: {{ $vaccine->administration_route }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dose</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->dose }} {{ $vaccine->dose_unit }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Manufacturer & Batch</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->manufacturer }}</p>
                                    <p class="text-sm text-gray-500">Batch: {{ $vaccine->batch_number }}</p>
                                    <p class="text-sm text-gray-500">Expires: {{ $vaccine->expiration_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Next Due</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->next_due_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $vaccine->reaction_observed ? 'red' : 'green' }}-100 text-{{ $vaccine->reaction_observed ? 'red' : 'green' }}-800">
                                            {{ $vaccine->reaction_observed ? 'Reaction Observed' : 'No Reaction' }}
                                        </span>
                                        @if($vaccine->reaction_observed)
                                            <p class="ml-2 text-sm text-gray-500">{{ $vaccine->reaction_details }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Certification</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->certification_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Notes</p>
                                    <p class="text-sm text-gray-900">{{ $vaccine->notes }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No vaccinations found</p>
                    @endforelse
                </div>
            </x-modal>
        @endif
    </div>
</div>
