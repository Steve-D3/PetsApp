<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                        Welcome, {{ auth()->user()->name }}
                    </h1>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Member since {{ auth()->user()->created_at->format('M Y') }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path
                                    d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                            @if(isset($clinicStats))
                                {{ $clinicStats['total_appointments'] }} appointments
                            @else
                                0 appointments
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Enhanced Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Appointments Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Appointments</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Today</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['today'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">This Week</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['this_week'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Pending</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">{{ $appointmentStats['pending'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Patient Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Patients</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">New This Month</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-green-600 dark:text-green-400">{{ $patientStats['new_this_month'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Returning</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-purple-600 dark:text-purple-400">{{ $patientStats['returning'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Total Patients</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $patientStats['total'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Tasks & Reminders -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tasks & Reminders</h3>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ count($pendingTasks) }} Pending
                    </span>
                </div>
                <div class="space-y-4">
                    @forelse($pendingTasks as $task)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <div
                                    class="h-5 w-5 rounded-full flex items-center justify-center {{ $task['priority'] === 'high' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600' }}">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $task['title'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Due: {{ $task['due']->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No pending tasks</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800">
                        View All Tasks
                    </button>
                </div>
            </div>

            <!-- Vaccination Alerts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Vaccination Alerts</h3>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        {{ $vaccineStats['due_soon'] }} Due Soon
                    </span>
                </div>
                @if($vaccineStats['due_soon'] > 0)
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Vaccinations Due Soon
                                </h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p>{{ $vaccineStats['due_soon'] }} pets have vaccinations due in the next 30 days.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-yellow-600 h-2.5 rounded-full"
                                            style="width: {{ min(($vaccineStats['due_soon'] / max($patientStats['total'], 1)) * 100, 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vaccinations due soon</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">All pets are up to date with their
                            vaccinations.</p>
                    </div>
                @endif
                <div class="mt-4">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-900 dark:text-green-200 dark:hover:bg-green-800">
                        View Vaccination Schedule
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Medical Records -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg mb-8">
            <div
                class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Recent Medical Records</h2>
                <div class="flex space-x-2">
                    <button @click="$wire.toggleFilters()"
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        {{ $showFilters ? 'Hide' : 'Show' }} Filters
                    </button>
                </div>
            </div>

            <!-- Filter Panel -->
            @if($showFilters)
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-4 border-b border-gray-200 dark:border-gray-600">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="petFilter"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by
                                Pet</label>
                            <select wire:model.live="petFilter" id="petFilter"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">All Pets</option>
                                @foreach($availablePets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="dateFrom"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Date</label>
                            <input type="date" wire:model.live="dateFrom" id="dateFrom"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                        <div>
                            <label for="dateTo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To
                                Date</label>
                            <input type="date" wire:model.live="dateTo" id="dateTo"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                        <div class="flex items-end space-x-2">
                            <button wire:click="applyFilters"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Apply Filters
                            </button>
                            <button wire:click="resetFilters"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:hover:bg-gray-500">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Records List -->
            <div class="overflow-hidden">
                @if($recentMedicalRecords->count() > 0)
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($recentMedicalRecords as $record)
                            <li class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <a href="{{ route('medical-records.show', ['pet' => $record->pet_id, 'record' => $record->id]) }}"
                                    class="block px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-blue-600 dark:text-blue-400 truncate">
                                                    {{ $record->pet->name }}
                                                    <span class="text-gray-500 dark:text-gray-400 font-normal">•
                                                        {{ $record->pet->species }}</span>
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $record->title }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $record->record_date->format('M d, Y') }}
                                            </div>
                                            <div class="mt-1 text-xs text-gray-400">
                                                {{ $record->record_date->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No medical records found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            @if($petFilter || $dateFrom || $dateTo)
                                Try adjusting your filters or
                            @endif
                            <a href="#"
                                class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                create a new record
                            </a>
                        </p>
                    </div>
                @endif
            </div>

            @if($recentMedicalRecords->count() > 0)
                <div
                    class="px-4 py-4 sm:px-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-right">
                    <a href="{{ route('medical-records.show', ['pet' => $record->pet_id, 'record' => $record->id]) }}"
                        class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        View all records <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg mb-8">
            <div
                class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Upcoming Appointments</h2>
                <a href="{{ route('vet.appointments.calendar', ['veterinarian_profile_id' => $vetProfileId]) }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                    View Calendar <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
            <div class="overflow-hidden">
                @if($upcomingAppointments->count() > 0)
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($upcomingAppointments as $appointment)
                            <li class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                    class="block px-4 py-4 sm:px-6">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="flex items-center space-x-2">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        {{ $appointment->pet->name }}
                                                        <span class="text-gray-500 dark:text-gray-400 font-normal">•
                                                            {{ $appointment->pet->species }}</span>
                                                    </p>
                                                    @if($appointment->status === 'confirmed')
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                            Confirmed
                                                        </span>
                                                    @elseif($appointment->status === 'pending')
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                                            Pending
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-4">
                                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        {{ $appointment->pet->owner->name }}
                                                    </div>
                                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $appointment->pet->owner->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:mt-0 sm:ml-4 sm:flex-shrink-0">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $appointment->start_time->format('M j, Y') }}
                                            </div>
                                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $appointment->start_time->format('g:i A') }}
                                                @if($appointment->end_time)
                                                    <span class="mx-1">-</span>
                                                    {{ $appointment->end_time->format('g:i A') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No upcoming appointments</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Get started by
                            <a href="#"
                                class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">scheduling
                                a new appointment
                            </a>.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
