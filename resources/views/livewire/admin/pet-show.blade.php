<div class="py-8 px-6 text-white dark:bg-gray-900 min-h-screen">
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

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

            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Name</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->name }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Species</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->species }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Breed</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->breed }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Age</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->age }} years</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Weight</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->weight }} kg</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Gender</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->gender }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Food Preferences</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->food_preferences }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Sterilized</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->sterilized ? 'Yes' : 'No' }}</span>
                    </div>
                </div>
            </div>

            <!-- Owner Info -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Owner Details</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Name</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->owner->name }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Email</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pet->owner->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Medical Record -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Medical Record</h2>
                <a href="{{ route('medical-records.index', $pet) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    View Medical Records
                </a>
            </div>

        </div>

        <!-- Appointments -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Appointments</h3>
                <button wire:click="$set('showAddModal', true)" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Appointment
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Vet</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Notes</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($pet->appointments as $appointment)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($appointment->status === 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                                            @elseif($appointment->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                            @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                            @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300 @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $appointment->veterinarian->user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $appointment->notes ?: '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="editAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $appointment->id }})"
                                            onclick="return confirm('Are you sure you want to delete this appointment?')"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No appointments</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new appointment.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
                    <x-input id="startTimeToEdit" type="datetime-local" class="mt-1 block w-full" wire:model="startTimeToEdit" required />
                    <x-input-error for="startTimeToEdit" class="mt-1" />
                </div>

                <!-- Status -->
                <div>
                    <x-label for="statusToEdit" value="{{ __('Status') }}" />
                    <select id="statusToEdit" wire:model="statusToEdit" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
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
                    <select id="veterinarianIdToEdit" wire:model="veterinarianIdToEdit" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
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
                    <select id="veterinarianIdToAdd" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" wire:model="veterinarianIdToAdd" required>
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
                    <x-input id="startTimeToAdd" type="datetime-local" class="mt-1 block w-full" wire:model="startTimeToAdd" required />
                    <x-input-error for="startTimeToAdd" class="mt-1" />
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notesToAdd" value="{{ __('Notes') }}" />
                    <textarea id="notesToAdd" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" wire:model="notesToAdd" rows="3"></textarea>
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
