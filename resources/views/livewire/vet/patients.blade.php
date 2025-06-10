<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/80 dark:bg-gray-800/50 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700/50">
            <div class="p-6">
                <!-- Header with Title and Action Button -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-indigo-500 dark:text-indigo-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                            My Patients
                        </h2>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="#"
                           class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New Patient
                        </a>
                    </div>
                </div>

                <!-- Filters Card -->
                <div class="mb-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700/50 dark:to-gray-800/50 p-5 rounded-xl border border-indigo-50/50 dark:border-gray-700/50 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Filter Patients</h3>
                        </div>
                        @if($search || $speciesFilter)
                            <button type="button"
                                    wire:click="$set('search', ''); $set('speciesFilter', '');"
                                    class="inline-flex items-center text-xs text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                <svg class="h-3.5 w-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Reset filters
                            </button>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Search Input -->
                        <div class="md:col-span-2">
                            <label for="search" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wider">Search by name or microchip</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input
                                    id="search"
                                    type="text"
                                    class="block w-full pl-10 pr-4 py-2.5 border-0 bg-white/70 dark:bg-gray-700/50 text-sm rounded-xl placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200"
                                    placeholder="Search patients..."
                                    wire:model.live.debounce.300ms="search">
                            </div>
                        </div>

                        <!-- Species Filter -->
                        <div>
                            <label for="species" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wider">Filter by species</label>
                            <div class="relative">
                                <select
                                    id="species"
                                    class="appearance-none block w-full pl-3 pr-10 py-2.5 border-0 bg-white/70 dark:bg-gray-700/50 text-sm rounded-xl focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 cursor-pointer"
                                    wire:model.live="speciesFilter">
                                    <option value="">All Species</option>
                                    @foreach($species as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patients Table -->
                <div class="overflow-x-auto">
                    @if($pets->count() > 0)
                        <div class="align-middle inline-block rounded-xl min-w-full overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-xl">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                                    <tr class="text-left">
                                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider group cursor-pointer hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200" wire:click="sortBy('name')">
                                            <div class="flex items-center space-x-1">
                                                <span>Pet</span>
                                                @if($sortField === 'name')
                                                    <x-icon.chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'transform rotate-180' : '' }}" />
                                                @else
                                                    <x-icon.chevron-up class="w-3 h-3 opacity-0 group-hover:opacity-40 transition-opacity" />
                                                @endif
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Owner
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Species & Breed
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider group cursor-pointer hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200" wire:click="sortBy('last_visit')">
                                            <div class="flex items-center space-x-1">
                                                <span>Last Visit</span>
                                                @if($sortField === 'last_visit')
                                                    <x-icon.chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'transform rotate-180' : '' }}" />
                                                @else
                                                    <x-icon.chevron-up class="w-3 h-3 opacity-0 group-hover:opacity-40 transition-opacity" />
                                                @endif
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800/80 divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    @foreach($pets as $pet)
                                        <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                            <!-- Pet Info -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 relative">
                                                        <img class="h-10 w-10 rounded-full border-2 border-white dark:border-gray-700 shadow-sm"
                                                             src="{{ $pet->profile_photo_url }}"
                                                             alt="{{ $pet->name }}"
                                                             onerror="this.onerror=null; this.src='{{ asset('images/default-pet-avatar.png') }}'"
                                                        >
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                            {{ $pet->name }}
                                                        </div>
                                                        <div class="mt-1 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                            @if($pet->microchip_number)
                                                                <x-icon.chip class="w-3 h-3 mr-1" />
                                                                <span>#{{ $pet->microchip_number }}</span>
                                                            @else
                                                                <x-icon.chip class="w-3 h-3 mr-1 text-gray-300 dark:text-gray-600" />
                                                                <span class="text-gray-400 dark:text-gray-500">No microchip</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Owner Info -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center mr-3">
                                                        <x-icon.user class="h-4 w-4 text-indigo-600 dark:text-indigo-400" />
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $pet->owner->name ?? 'N/A' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[180px]" title="{{ $pet->owner->email ?? '' }}">
                                                            {{ $pet->owner->email ?? '' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Species & Breed -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    @php
                                                        $speciesColors = [
                                                            'dog' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                            'cat' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                            'bird' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                            'rabbit' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                            'reptile' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                            'other' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                        ][$pet->species] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                                    @endphp
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $speciesColors }}">
                                                        {{ ucfirst($pet->species) }}
                                                    </span>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-300 font-medium">
                                                    {{ $pet->breed ?: 'Mixed breed' }}
                                                </div>
                                            </td>

                                            <!-- Last Visit -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($pet->last_visit)
                                                    <div class="flex items-center">
                                                        <x-icon.calendar class="h-4 w-4 text-gray-400 dark:text-gray-500 mr-1.5 flex-shrink-0" />
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ \Carbon\Carbon::parse($pet->last_visit)->format('M d, Y') }}
                                                            </div>
                                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                                <x-icon.clock class="h-3 w-3 mr-1" />
                                                                <span>{{ $pet->appointment_count }} {{ Str::plural('visit', $pet->appointment_count) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                        <x-icon.clock class="h-4 w-4 text-gray-300 dark:text-gray-600 mr-1.5 flex-shrink-0" />
                                                        <span>No visits yet</span>
                                                    </div>
                                                @endif
                                            </td>

                                            <!-- Actions -->
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('vet.pets.show', $pet) }}"
                                                       class="p-1.5 rounded-full text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 transition-colors duration-150"
                                                       title="View details">
                                                        <x-icon.eye class="h-4 w-4" />
                                                        <span class="sr-only">View</span>
                                                    </a>
                                                    <a href="{{ route('vet.pets.edit', $pet) }}"
                                                       class="p-1.5 rounded-full text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 transition-colors duration-150"
                                                       title="Edit pet">
                                                        <x-icon.pencil class="h-4 w-4" />
                                                        <span class="sr-only">Edit</span>
                                                    </a>
                                                    <button type="button"
                                                            wire:click="$emit('openModal', 'vet.pet-appointment-modal', {{ json_encode(['petId' => $pet->id]) }})"
                                                            class="p-1.5 rounded-full text-gray-400 hover:text-green-600 hover:bg-green-50 dark:hover:bg-gray-700 transition-colors duration-150"
                                                            title="New appointment">
                                                        <x-icon.plus-circle class="h-4 w-4" />
                                                        <span class="sr-only">New appointment</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="px-6 py-4 border-t border-gray-200/50 dark:border-gray-700/50">
                                <div class="flex flex-col sm:flex-row items-center justify-between">
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-4 sm:mb-0">
                                        Showing <span class="font-medium">{{ $pets->firstItem() }}</span> to
                                        <span class="font-medium">{{ $pets->lastItem() }}</span> of
                                        <span class="font-medium">{{ $pets->total() }}</span> patients
                                    </div>
                                    {{ $pets->onEachSide(1)->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                            <div class="text-center py-16 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/30 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 dark:bg-indigo-900/30 mb-4">
                                    <x-icon.paw class="h-8 w-8 text-indigo-600 dark:text-indigo-400" />
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $search || $speciesFilter ? 'No matching patients found' : 'No patients yet' }}
                                </h3>
                                <p class="mt-2 max-w-md mx-auto text-sm text-gray-500 dark:text-gray-400">
                                    {{ $search || $speciesFilter ? 'Try adjusting your search or filter to find what you\'re looking for.' : 'Start by adding your first patient to the system.' }}
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('vet.pets.create') }}"
                                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150">
                                        <x-icon.plus class="-ml-1 mr-2 h-5 w-5" />
                                        Add New Patient
                                    </a>
                                </div>
                                @if($search || $speciesFilter)
                                    <div class="mt-4">
                                        <button type="button"
                                                wire:click="resetFilters"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-150">
                                            <span class="flex items-center justify-center">
                                                <x-icon.refresh class="h-4 w-4 mr-1" />
                                                Reset filters
                                            </span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
