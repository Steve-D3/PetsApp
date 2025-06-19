<div class="px-4 pt-5 pb-4 sm:p-6 bg-gray-300 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                    {{ $this->title }}
                </h3>
                <button type="button" wire:click="close" wire:loading.attr="disabled" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @if($description = $this->description)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 mb-6">
                    {{ $description }}
                </p>
            @endif

            <form wire:submit.prevent="createAppointment" class="mt-6 space-y-4">
                <!-- Pet Selection (only shown when no pet is pre-selected) -->
                @if($showPetSelect)
                    <div>
                        <x-label for="pet_id" :value="__('Pet')" />
                        <select id="pet_id" wire:model="petId"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                            required>
                            <option value="">{{ __('Select a pet') }}</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}">
                                    {{ $pet->name }} ({{ $pet->owner->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('petId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Pet') }}</p>
                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                            @if($this->pet)
                                {{ $this->pet->name }} ({{ $this->pet->owner->name }})
                            @endif
                        </p>
                    </div>
                @endif

                <!-- Veterinarian Selection -->
                <div>
                    <x-label for="veterinarian_id" :value="__('Veterinarian')" />
                    <select id="veterinarian_id" wire:model="veterinarian_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        required>
                        <option value="">{{ __('Select a veterinarian') }}</option>
                        @foreach($availableVeterinarians as $vet)
                            <option value="{{ $vet->id }}">
                                {{ $vet->name }} @if(isset($vet->specialty))({{ $vet->specialty }})@endif
                            </option>
                        @endforeach
                    </select>
                    @error('veterinarian_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Picker -->
                <div>
                    <x-label for="date" :value="__('Appointment Date')" />
                    <input type="date" id="date" wire:model="date" min="{{ now()->format('Y-m-d') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        required>
                    @error('date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time Slot Selection -->
                <div>
                    <x-label for="time" :value="__('Time Slot')" />
                    <select id="time" wire:model="time"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        @if(empty($availableSlots)) disabled @endif required>
                        @if(empty($availableSlots))
                            <option value="">{{ __('Select a veterinarian and date first') }}</option>
                        @else
                            @foreach($availableSlots as $slot)
                                <option value="{{ $slot['time'] }}">{{ $slot['formatted'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reason -->
                <div>
                    <x-label for="reason" :value="__('Reason for Visit')" />
                    <input type="text" id="reason" wire:model="reason"
                        placeholder="e.g., Annual checkup, Vaccination, etc."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        required>
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notes" :value="__('Notes (Optional)')" />
                    <textarea id="notes" wire:model="notes" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        placeholder="Any additional information about the appointment"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" wire:click="close" wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Schedule Appointment') }}
                    </button>
                </div>
            </form>
        </div>
</div>
