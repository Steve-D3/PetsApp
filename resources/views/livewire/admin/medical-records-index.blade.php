<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                            Medical Records - {{ $pet->name }}
                        </h1>
                        <div
                            class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-2 border-gray-100 dark:border-gray-700">
                            <span class="font-medium text-gray-500 dark:text-gray-400">Owner:</span>
                            <span class="text-gray-900 dark:text-white">{{ $pet->owner->name }}</span>
                            <span class="text-gray-500 dark:text-gray-400">({{ $pet->owner->email }})</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-button wire:click="$toggle('showFilters')"
                            class="bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            {{ $showFilters ? 'Hide' : 'Show' }} Filters
                        </x-button>
                        @if ($showFilters)
                            <x-button wire:click="resetFilters"
                                class="bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Reset Filters
                            </x-button>
                        @endif
                        @can('create', \App\Models\MedicalRecord::class)
                            <a href="{{ route('medical-records.create', $pet) }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Record
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        @if ($showFilters)
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6 transition-all duration-300 ease-in-out border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Filter Records</h3>
                        <button type="button" wire:click="$toggle('showFilters')"
                            class="text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-300">
                            <span class="sr-only">Close filters</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-center space-x-6">
                        <!-- Search Input -->
                        <div class="space-y-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Search Records
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input id="search" type="text"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600 transition duration-150 ease-in-out"
                                    wire:model.live.debounce.300ms="search" placeholder="Search records..." />
                            </div>
                        </div>

                        <!-- Diagnosis Filter -->
                        <div class="space-y-2">
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Diagnosis
                            </label>
                            <div class="relative">
                                <select id="diagnosis"
                                    class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                    wire:model.live="filters.diagnosis">
                                    <option value="">All Diagnoses</option>
                                    @foreach($diagnoses as $diagnosis)
                                        <option value="{{ $diagnosis }}" class="dark:bg-gray-700">{{ $diagnosis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    From Date
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="start_date"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                        wire:model.live="filters.start_date" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    To Date
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="end_date"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                        wire:model.live="filters.end_date" />
                                </div>
                            </div>
                        </div>

                        <!-- Follow Up Required -->
                        <div class="flex items-end">
                            <div class="flex items-center h-5">
                                <input id="follow_up_required" type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-2 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 transition duration-150 ease-in-out"
                                    wire:model.live="filters.follow_up_required" />
                                <label for="follow_up_required"
                                    class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Follow Up Required
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Records Table -->
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150"
                                    wire:click="sortBy('record_date')">
                                    <div class="flex items-center">
                                        <span>Date</span>
                                        @if ($sortField === 'date')
                                            @if ($sortDirection === 'asc')
                                                <svg class="ml-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            @else
                                                <svg class="ml-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <svg class="ml-1.5 h-4 w-4 text-transparent" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Diagnosis
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Treatments
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Follow Up
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($records as $record)
                                <tr
                                    class="bg-white dark:bg-gray-800 even:bg-gray-50 dark:even:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($record->record_date)->diffForHumans() }}
                                        </div>
                                    </td>

                                    <!-- Diagnosis Column -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $record->veterinarian->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-sm text-gray-900 dark:text-gray-200 font-medium mt-1">
                                                {{ $record->diagnosis }}
                                            </div>
                                            @if($record->notes)
                                                <div class="text-sm text-gray-600 dark:text-gray-300 mt-1 line-clamp-2">
                                                    {{ $record->notes }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Treatments Column -->
                                    <td class="px-6 py-4">
                                        @if($record->treatments->count() > 0)
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($record->treatments->take(2) as $treatment)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        {{ $treatment->name }}
                                                        @if($treatment->pivot && $treatment->pivot->details)
                                                            <span
                                                                class="ml-1 text-blue-600 dark:text-blue-300">({{ $treatment->pivot->details }})</span>
                                                        @endif
                                                    </span>
                                                @endforeach
                                                @if($record->treatments->count() > 2)
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                        +{{ $record->treatments->count() - 2 }} more
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">No treatments</span>
                                        @endif
                                    </td>

                                    <!-- Follow Up Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($record->follow_up_date)
                                            <div class="flex items-center">
                                                <span class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-yellow-400 mr-2"></span>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ \Carbon\Carbon::parse($record->follow_up_date)->format('M d, Y') }}
                                                    </div>
                                                    @if($record->follow_up_notes)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1"
                                                            title="{{ $record->follow_up_notes }}">
                                                            {{ $record->follow_up_notes }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                Not required
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions Column -->
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium border-r border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('medical-records.show', ['pet' => $pet->id, 'record' => $record->id]) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-150 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </path>
                                                </svg>
                                                <span>View</span>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" aria-hidden="true">
                                                <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No medical
                                                records found</h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                Get started by creating a new medical record.
                                            </p>
                                            <div class="mt-6">
                                                @can('create', \App\Models\MedicalRecord::class)
                                                    <a href="{{ route('medical-records.create', $pet) }}"
                                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                        New Record
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($records->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-600 dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row items-center justify-between">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Showing <span class="font-medium">{{ $records->firstItem() }}</span> to <span
                                class="font-medium">{{ $records->lastItem() }}</span> of <span
                                class="font-medium">{{ $records->total() }}</span> results
                            @if($filters['search'] || $filters['diagnosis'] || $filters['start_date'] || $filters['end_date'] || $filters['follow_up_required'])
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                    Filtered
                                </span>
                            @endif
                        </div> results
                    </div>

                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-2">
                        <!-- Previous Page Link -->
                        @if ($records->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-3 py-1.5 rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Previous</span>
                            </span>
                        @else
                            <button wire:click="previousPage"
                                class="relative inline-flex items-center px-3 py-1.5 rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Previous</span>
                            </button>
                        @endif

                        <!-- Page Numbers -->
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                            <div class="flex rounded-md shadow-sm">
                                @foreach ($records->links()->elements[0] as $page => $url)
                                    @if ($page == $records->currentPage())
                                        <span
                                            class="relative z-10 inline-flex items-center px-4 py-1.5 border border-indigo-500 bg-indigo-50 dark:bg-indigo-900 text-sm font-medium text-indigo-600 dark:text-indigo-200">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})"
                                            class="relative inline-flex items-center px-4 py-1.5 border border-gray-300 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Next Page Link -->
                        @if ($records->hasMorePages())
                            <button wire:click="nextPage"
                                class="relative inline-flex items-center px-3 py-1.5 rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                <span class="mr-1">Next</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <span
                                class="relative inline-flex items-center px-3 py-1.5 rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                <span class="mr-1">Next</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@endpush
