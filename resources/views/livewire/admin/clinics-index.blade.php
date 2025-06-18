<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Veterinary Clinics</h2>
                    <div class="mt-4 md:mt-0">
                        <button wire:click="$set('showAddModal', true)"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Clinic
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                            <input type="text" id="search" wire:model.live.debounce.300ms="search"
                                placeholder="Search by name, email or phone..."
                                class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="country"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                            <select id="country" wire:model.live="country"
                                class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Countries</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="city"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                            <select id="city" wire:model.live="city"
                                class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                @if(!$country) disabled @endif>
                                <option value="">All Cities</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button wire:click="resetFilters"
                                class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-white rounded-md transition duration-150 ease-in-out">
                                Reset Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Clinics Table -->
                <div class="overflow-x-auto">
                    @if(count($selectedClinics) > 0)
                        <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/30 rounded-md">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-blue-800 dark:text-blue-200">{{ count($selectedClinics) }}
                                    clinic(s) selected</span>
                                <button wire:click="deleteSelected"
                                    wire:confirm="Are you sure you want to delete the selected clinics?"
                                    class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                    @endif

                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-10">
                                        <input type="checkbox" wire:model.live="selectAll"
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        wire:click="sortBy('name')">
                                        <div class="flex items-center">
                                            Name
                                            @if($sortField === 'name')
                                                <span class="ml-1">
                                                    @if($sortDirection === 'asc')
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Location
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        wire:click="sortBy('country')">
                                        <div class="flex items-center">
                                            Country
                                            @if($sortField === 'country')
                                                <span class="ml-1">
                                                    @if($sortDirection === 'asc')
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($clinics as $clinic)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" value="{{ $clinic->id }}"
                                                wire:model.live="selectedClinics"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $clinic->name }}</div>
                                            @if($clinic->website)
                                                <div class="text-sm text-blue-600 dark:text-blue-400">
                                                    <a href="{{ $clinic->website }}" target="_blank" class="hover:underline">
                                                        {{ parse_url($clinic->website, PHP_URL_HOST) }}
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clinic->phone }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $clinic->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $clinic->city }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $clinic->postal_code }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $clinic->country }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.clinics.show', $clinic) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <button wire:click="editClinic({{ $clinic->id }})"
                                                    class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button wire:click="confirmClinicDeletion({{ $clinic->id }})"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                    title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No clinics found. Try adjusting your search or filter criteria.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $clinics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Clinic Modal -->
    <x-dialog-modal wire:model.live="showAddModal">
        <x-slot name="title">
            Add New Clinic
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <x-label for="addName" value="{{ __('Clinic Name') }}" />
                    <x-input id="addName" type="text" class="mt-1 block w-full" wire:model="addName" required
                        autofocus />
                    <x-input-error for="addName" class="mt-1" />
                </div>

                <!-- Address -->
                <div>
                    <x-label for="addAddress" value="{{ __('Address') }}" />
                    <x-input id="addAddress" type="text" class="mt-1 block w-full" wire:model="addAddress" required />
                    <x-input-error for="addAddress" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- City -->
                    <div>
                        <x-label for="addCityInput" value="{{ __('City') }}" />
                        <x-input id="addCityInput" type="text" class="mt-1 block w-full" wire:model="addCityInput"
                            required />
                        <x-input-error for="addCityInput" class="mt-1" />
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <x-label for="addPostalCode" value="{{ __('Postal Code') }}" />
                        <x-input id="addPostalCode" type="text" class="mt-1 block w-full" wire:model="addPostalCode"
                            required />
                        <x-input-error for="addPostalCode" class="mt-1" />
                    </div>
                </div>

                <!-- Country -->
                <div>
                    <x-label for="addCountryInput" value="{{ __('Country') }}" />
                    <select id="addCountryInput" wire:model="addCountryInput"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        @foreach($countries as $country)
                            <option value="{{ $country }}" @if($country === $addCountryInput) selected @endif>{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="addCountryInput" class="mt-1" />
                </div>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Phone -->
                    <div>
                        <x-label for="addPhone" value="{{ __('Phone') }}" />
                        <x-input id="addPhone" type="tel" class="mt-1 block w-full" wire:model="addPhone" />
                        <x-input-error for="addPhone" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="addEmail" value="{{ __('Email') }}" />
                        <x-input id="addEmail" type="email" class="mt-1 block w-full" wire:model="addEmail" />
                        <x-input-error for="addEmail" class="mt-1" />
                    </div>
                </div>

                <!-- Website -->
                <div>
                    <x-label for="addWebsite" value="{{ __('Website') }}" />
                    <x-input id="addWebsite" type="url" class="mt-1 block w-full" wire:model="addWebsite"
                        placeholder="https://" />
                    <x-input-error for="addWebsite" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showAddModal', false)" class="mr-2">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="createClinic" wire:loading.attr="disabled">
                {{ __('Create Clinic') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Clinic Modal -->
    <x-dialog-modal wire:model.live="showEditModal">
        <x-slot name="title">
            Edit Clinic
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <x-label for="editName" value="{{ __('Clinic Name') }}" />
                    <x-input id="editName" type="text" class="mt-1 block w-full" wire:model="editName" required
                        autofocus />
                    <x-input-error for="editName" class="mt-1" />
                </div>

                <!-- Address -->
                <div>
                    <x-label for="editAddress" value="{{ __('Address') }}" />
                    <x-input id="editAddress" type="text" class="mt-1 block w-full" wire:model="editAddress" required />
                    <x-input-error for="editAddress" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- City -->
                    <div>
                        <x-label for="editCityInput" value="{{ __('City') }}" />
                        <x-input id="editCityInput" type="text" class="mt-1 block w-full" wire:model="editCityInput"
                            required />
                        <x-input-error for="editCityInput" class="mt-1" />
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <x-label for="editPostalCode" value="{{ __('Postal Code') }}" />
                        <x-input id="editPostalCode" type="text" class="mt-1 block w-full" wire:model="editPostalCode"
                            required />
                        <x-input-error for="editPostalCode" class="mt-1" />
                    </div>
                </div>

                <!-- Country -->
                <div>
                    <x-label for="editCountryInput" value="{{ __('Country') }}" />
                    <select id="editCountryInput" wire:model="editCountryInput"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        @foreach($countries as $country)
                            <option value="{{ $country }}" @if($country === $editCountryInput) selected @endif>{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="editCountryInput" class="mt-1" />
                </div>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Phone -->
                    <div>
                        <x-label for="editPhone" value="{{ __('Phone') }}" />
                        <x-input id="editPhone" type="tel" class="mt-1 block w-full" wire:model="editPhone" />
                        <x-input-error for="editPhone" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="editEmail" value="{{ __('Email') }}" />
                        <x-input id="editEmail" type="email" class="mt-1 block w-full" wire:model="editEmail" />
                        <x-input-error for="editEmail" class="mt-1" />
                    </div>
                </div>

                <!-- Website -->
                <div>
                    <x-label for="editWebsite" value="{{ __('Website') }}" />
                    <x-input id="editWebsite" type="url" class="mt-1 block w-full" wire:model="editWebsite"
                        placeholder="https://" />
                    <x-input-error for="editWebsite" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModal', false)" class="mr-2">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="updateClinic" wire:loading.attr="disabled">
                {{ __('Update Clinic') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingClinicDeletion">
        <x-slot name="title">
            {{ __('Delete Clinic') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this clinic? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingClinicDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteClinic" wire:loading.attr="disabled">
                {{ __('Delete Clinic') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
