<div class="fixed z-10 inset-0 overflow-y-auto" wire:ignore>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Medical Record Details
                    </h3>
                    <div class="mt-2">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- Basic Information -->
                            <div class="bg-white shadow rounded-lg p-4">
                                <h4 class="text-lg font-medium mb-4">Basic Information</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Record Date:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Pet:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->pet->name }} ({{ $record->pet->species }})
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Veterinarian:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->vet->user->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Medical Information -->
                            <div class="bg-white shadow rounded-lg p-4">
                                <h4 class="text-lg font-medium mb-4">Medical Information</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Chief Complaint:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                             {{ $record->chief_complaint }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Diagnosis:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->diagnosis }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Treatment Plan:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->treatment_plan }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Medications:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->medications }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Follow Up -->
                            <div class="bg-white shadow rounded-lg p-4">
                                <h4 class="text-lg font-medium mb-4">Follow Up</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Follow Up Required:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $record->follow_up_required ? 'Yes' : 'No' }}
                                        </span>
                                    </div>
                                    @if ($record->follow_up_required)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Follow Up Date:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $record->follow_up_date ? \Carbon\Carbon::parse($record->follow_up_date)->format('M d, Y') : 'Not specified' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Treatments -->
                            @if ($treatments->count() > 0)
                                <div class="bg-white shadow rounded-lg p-4">
                                    <h4 class="text-lg font-medium mb-4">Treatments</h4>
                                    <div class="space-y-3">
                                        @foreach ($treatments as $treatment)
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="text-sm font-medium text-gray-900">
                                                        {{ $treatment->name }}
                                                    </span>
                                                    <span class="text-sm text-gray-600">
                                                        ({{ $treatment->quantity }} {{ $treatment->unit }})
                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-600">
                                                    {{ $treatment->treatmentType?->category ?? 'N/A' }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Vaccinations -->
                            @if ($vaccinations->count() > 0)
                                <div class="bg-white shadow rounded-lg p-4">
                                    <h4 class="text-lg font-medium mb-4">Vaccinations</h4>
                                    <div class="space-y-3">
                                        @foreach ($vaccinations as $vaccination)
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="text-sm font-medium text-gray-900">
                                                        {{ $vaccination->vaccinationType->name }}
                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-600">
                                                    {{ $vaccination->vaccinationType->category }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <a href="{{ route('medical-records.index', $record->pet) }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </a>
            </div>
        </div>
    </div>
</div>
