<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="p-8">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">My Appointments</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage and track all your veterinary appointments</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('vet.appointments.calendar', ['veterinarian_profile_id' => $vetId]) }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Calendar View
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="mb-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-900/50 p-6 rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider flex items-center">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Appointments
                        </h3>
                        @if($status !== 'upcoming' || $dateFilter || $search)
                            <button wire:click="$set('status', 'upcoming'); $set('dateFilter', null); $set('search', '')" 
                                    class="text-xs font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset filters
                            </button>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Status Filter -->
                        <div class="space-y-1.5">
                            <label for="status" class="block text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</label>
                            <div class="relative">
                                <select id="status" wire:model.live="status" 
                                    class="appearance-none w-full pl-3 pr-10 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-xl bg-white/70 dark:bg-gray-700/50 text-gray-800 dark:text-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 cursor-pointer"
                                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZmlsbD1cIiA3ODhhZmZcIiBkPSJNNyAxMGw1IDUgNS01eiIvPjwvc3ZnPg==')">
                                    <option value="upcoming">Upcoming Appointments</option>
                                    <option value="all">All Appointments</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date Filter -->
                        <div class="space-y-1.5">
                            <label for="date" class="block text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Date Range</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" id="date" wire:model.live="dateFilter" 
                                    class="block w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-xl bg-white/70 dark:bg-gray-700/50 text-gray-800 dark:text-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                    placeholder="Select date">
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="space-y-1.5">
                            <label for="search" class="block text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input id="search" type="text" wire:model.live.debounce.300ms="search" 
                                    class="block w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-xl bg-white/70 dark:bg-gray-700/50 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                                    placeholder="Search pets or owners...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointments Table -->
                <div class="overflow-x-auto">
                    @if($appointments->count() > 0)
                        <div class="align-middle inline-block min-w-full overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <span>Date & Time</span>
                                                <button wire:click="sortBy('start_time')" class="ml-1 flex-shrink-0">
                                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pet & Owner</th>
                                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Notes</th>
                                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800/50 divide-y divide-gray-100 dark:divide-gray-700/50">
                                    @foreach($appointments as $appointment)
                                        <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-9 w-9 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center mr-3">
                                                        <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $appointment->start_time->format('M d, Y') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $appointment->start_time->format('h:i A') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-xl overflow-hidden border-2 border-white dark:border-gray-700 shadow-sm">
                                                        <img class="h-full w-full object-cover" src="{{ $appointment->pet->profile_photo_url }}" alt="{{ $appointment->pet->name }}" onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent('{{ $appointment->pet->name }}')+'&background=7c3aed&color=fff&size=128'" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                            {{ $appointment->pet->name }}
                                                        </div>
                                                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                            <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                            {{ $appointment->pet->owner->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs truncate group relative" title="{{ $appointment->notes }}">
                                                    @if($appointment->notes)
                                                        {{ $appointment->notes }}
                                                        <div class="absolute z-10 hidden group-hover:block w-64 p-2 mt-1 text-xs text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600">
                                                            {{ $appointment->notes }}
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500 italic">No notes</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusConfig = [
                                                        'scheduled' => [
                                                            'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
                                                            'text' => 'text-yellow-800 dark:text-yellow-200',
                                                            'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                                                        ],
                                                        'confirmed' => [
                                                            'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                                                            'text' => 'text-blue-800 dark:text-blue-200',
                                                            'icon' => 'M5 13l4 4L19 7',
                                                        ],
                                                        'completed' => [
                                                            'bg' => 'bg-green-100 dark:bg-green-900/30',
                                                            'text' => 'text-green-800 dark:text-green-200',
                                                            'icon' => 'M5 13l4 4L19 7',
                                                        ],
                                                        'cancelled' => [
                                                            'bg' => 'bg-red-100 dark:bg-red-900/30',
                                                            'text' => 'text-red-800 dark:text-red-200',
                                                            'icon' => 'M6 18L18 6M6 6l12 12',
                                                        ],
                                                        'no_show' => [
                                                            'bg' => 'bg-gray-100 dark:bg-gray-700/50',
                                                            'text' => 'text-gray-800 dark:text-gray-200',
                                                            'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                                                        ],
                                                    ];
                                                    
                                                    $status = $statusConfig[$appointment->status] ?? [
                                                        'bg' => 'bg-gray-100 dark:bg-gray-700/50',
                                                        'text' => 'text-gray-800 dark:text-gray-200',
                                                        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    ];
                                                @endphp
                                                <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $status['bg'] }} {{ $status['text'] }}">
                                                    <svg class="h-3 w-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $status['icon'] }}" />
                                                    </svg>
                                                    {{ str_replace('_', ' ', ucfirst($appointment->status)) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('admin.appointments.show', $appointment) }}" 
                                                       class="inline-flex items-center p-1.5 rounded-lg text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-colors duration-150"
                                                       title="View details">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    @if(in_array($appointment->status, ['scheduled', 'confirmed']))
                                                        <button wire:click="changeStatus('{{ $appointment->id }}', 'completed')" 
                                                                class="inline-flex items-center p-1.5 rounded-lg text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors duration-150"
                                                                title="Mark as completed">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                        <button wire:click="changeStatus('{{ $appointment->id }}', 'cancelled')" 
                                                                class="inline-flex items-center p-1.5 rounded-lg text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-150"
                                                                title="Cancel appointment">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-6 py-4">
                                {{ $appointments->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No appointments found</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ $status === 'upcoming' ? 'You have no upcoming appointments.' : 'No appointments match your current filters.' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
