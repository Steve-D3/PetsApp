<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    wire:ignore>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity"
            aria-hidden="true" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Medical Record Details
                        </h3>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Basic Information -->
                            <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                                    <h4 class="text-base font-medium text-gray-900 dark:text-white">Basic Information
                                    </h4>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <dl class="space-y-4">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Record Date
                                            </dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y') }}
                                            </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Pet</dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->pet->name }} ({{ $record->pet->species }})
                                            </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                                Veterinarian</dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->vet->user->name }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <!-- Medical Information -->
                            <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                                    <h4 class="text-base font-medium text-gray-900 dark:text-white">Medical Information
                                    </h4>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <dl class="space-y-4">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Chief
                                                Complaint</dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->chief_complaint ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Diagnosis
                                            </dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->diagnosis ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Treatment
                                                Plan</dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->treatment_plan ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Medications
                                            </dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                {{ $record->medications ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <!-- Follow Up -->
                            <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                                    <h4 class="text-base font-medium text-gray-900 dark:text-white">Follow Up</h4>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <dl class="space-y-4">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Follow Up
                                                Required</dt>
                                            <dd
                                                class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                @if($record->follow_up_required)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                                        No
                                                    </span>
                                                @endif
                                            </dd>
                                        </div>
                                        @if ($record->follow_up_required)
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Follow Up
                                                    Date</dt>
                                                <dd
                                                    class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $record->follow_up_date ? \Carbon\Carbon::parse($record->follow_up_date)->format('M d, Y') : 'Not specified' }}
                                                </dd>
                                            </div>
                                        @endif
                                    </dl>
                                </div>
                            </div>

                            @if ($treatments->count() > 0)
                                <!-- Treatments -->
                                <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                                        <h4 class="text-base font-medium text-gray-900 dark:text-white">Treatments</h4>
                                    </div>
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="space-y-4">
                                            @foreach ($treatments as $treatment)
                                                <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-md">
                                                    <div class="flex justify-between items-start">
                                                        <div class="flex-1">
                                                            <h5 class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $treatment->name }}
                                                            </h5>
                                                            @if($treatment->quantity && $treatment->unit)
                                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ $treatment->quantity }} {{ $treatment->unit }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        @if($treatment->treatmentType?->category)
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                                {{ $treatment->treatmentType->category }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($vaccinations->count() > 0)
                                <!-- Vaccinations -->
                                <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                                        <h4 class="text-base font-medium text-gray-900 dark:text-white">Vaccinations</h4>
                                    </div>
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="space-y-4">
                                            @foreach ($vaccinations as $vaccination)
                                                <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-md">
                                                    <div class="flex justify-between items-start">
                                                        <div class="flex-1">
                                                            <h5 class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $vaccination->vaccinationType->name }}
                                                            </h5>
                                                        </div>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                            {{ $vaccination->vaccinationType->category }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <a href="{{ route('medical-records.index', $record->pet) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                    Close
                </a>
            </div>
        </div>
    </div>
</div>
