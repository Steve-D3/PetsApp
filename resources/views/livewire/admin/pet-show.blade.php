<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto mb-6">
        @if (session()->has('message'))
            <div class="rounded-md bg-green-50 dark:bg-green-900 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('message') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="rounded-md bg-red-50 dark:bg-red-900 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white">
                    {{ $pet->name }}'s Profile
                </h1>
                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Last updated: {{ $pet->updated_at->diffForHumans() }}
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Created: {{ $pet->created_at->format('M j, Y') }}
                    </div>
                </div>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                <a href="{{ route('admin.pets.edit', $pet) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Pet
                </a>

            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <!-- Pet Information Card -->
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                        Pet Information
                    </h2>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Pet Photo -->
                        <div class="lg:col-span-1">
                            <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img src="{{ $pet->photo_url ? asset('storage/' . $pet->photo_url) : 'https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80' }}"
                                    alt="{{ $pet->name }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="mt-4 flex flex-col space-y-2">
                                <a href="{{ route('medical-records.index', $pet) }}"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    View Medical Records
                                </a>
                            </div>
                        </div>

                        <!-- Pet Details -->
                        <div class="lg:col-span-2">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pet->name }}</h3>
                                    <p class="mt-1 text-sm text-indigo-600 dark:text-indigo-400">{{ $pet->species }} •
                                        {{ $pet->breed }}
                                    </p>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Age</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pet->age }} years</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            {{ ucfirst($pet->gender) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Weight</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pet->weight }} kg</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Sterilized</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $pet->sterilized ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                            {{ $pet->sterilized ? 'Yes' : 'No' }}
                                        </span>
                                    </dd>
                                </div>
                                @if($pet->food_preferences)
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Food Preferences
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                                            {{ $pet->food_preferences }}
                                        </dd>
                                    </div>
                                @endif

                                <!-- Owner Info -->
                                <div class="sm:col-span-2 pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Owner</h4>
                                    <div class="mt-2 flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                            <span
                                                class="text-indigo-600 dark:text-indigo-300 font-medium">{{ substr($pet->owner->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $pet->owner->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $pet->owner->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments Section -->
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Appointments</h2>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                Scheduled visits and medical appointments for {{ $pet->name }}
                            </p>
                        </div>
                        <button wire:click="$set('showAddModal', true)"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            New Appointment
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    @if($pet->appointments->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date & Time</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Veterinarian</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Notes</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($pet->appointments as $appointment)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/30">
                                                        <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y') }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} -
                                                            {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                        'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                        'completed' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                        'no_show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                        'pending' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                                    ];
                                                    $statusColor = $statusColors[strtolower($appointment->status)] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                                        <span
                                                            class="text-indigo-600 dark:text-indigo-300 font-medium">{{ substr($appointment->veterinarian->user->name, 0, 1) }}</span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $appointment->veterinarian->user->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $appointment->veterinarian->specialization }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-gray-200 max-w-xs truncate">
                                                    {{ $appointment->notes ?? 'No notes' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button wire:click="editAppointment({{ $appointment->id }})"
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                        title="Edit appointment">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                    </button>
                                                    <button wire:click="confirmAppointmentDeletion({{ $appointment->id }})"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        title="Delete appointment">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div class="bg-white dark:bg-gray-800 px-4 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No appointments</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Get started by scheduling a new appointment for {{ $pet->name }}.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$set('showAddModal', true)"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                New Appointment
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Edit Appointment Modal -->
    <x-dialog-modal wire:model.live="showEditModal">
        <x-slot name="title">
            {{ __('Edit Appointment') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Start Time -->
                <div>
                    <x-label for="startTimeToEdit" value="{{ __('Start Time') }}" />
                    <x-input id="startTimeToEdit" type="datetime-local" class="mt-1 block w-full"
                        wire:model="startTimeToEdit" required />
                    <x-input-error for="startTimeToEdit" class="mt-1" />
                </div>

                <!-- Status -->
                <div>
                    <x-label for="statusToEdit" value="{{ __('Status') }}" />
                    <select id="statusToEdit" wire:model="statusToEdit"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <x-input-error for="statusToEdit" class="mt-1" />
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notesToEdit" value="{{ __('Notes') }}" />
                    <x-input id="notesToEdit" type="text" class="mt-1 block w-full" wire:model="notesToEdit" />
                    <x-input-error for="notesToEdit" class="mt-1" />
                </div>

                <!-- Veterinarian -->
                <div>
                    <x-label for="veterinarianIdToEdit" value="{{ __('Veterinarian') }}" />
                    <select id="veterinarianIdToEdit" wire:model="veterinarianIdToEdit"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}">
                                {{ $vet->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="veterinarianIdToEdit" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="updateAppointment" wire:loading.attr="disabled">
                {{ __('Update Appointment') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Add Appointment Modal -->
    <x-dialog-modal wire:model.live="showAddModal">
        <x-slot name="title">
            {{ __('Add New Appointment') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Veterinarian -->
                <div>
                    <x-label for="veterinarianIdToAdd" value="{{ __('Veterinarian') }}" />
                    <select id="veterinarianIdToAdd"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                        wire:model="veterinarianIdToAdd" required>
                        <option value="">Select a veterinarian</option>
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}">{{ $vet->name }} {{ $vet->id }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="veterinarianIdToAdd" class="mt-1" />
                </div>

                <!-- Start Time -->
                <div>
                    <x-label for="startTimeToAdd" value="{{ __('Start Time') }}" />
                    <x-input id="startTimeToAdd" type="datetime-local" class="mt-1 block w-full"
                        wire:model="startTimeToAdd" required />
                    <x-input-error for="startTimeToAdd" class="mt-1" />
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notesToAdd" value="{{ __('Notes') }}" />
                    <textarea id="notesToAdd"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                        wire:model="notesToAdd" rows="3"></textarea>
                    <x-input-error for="notesToAdd" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showAddModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="addAppointment" wire:loading.attr="disabled">
                {{ __('Add Appointment') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
