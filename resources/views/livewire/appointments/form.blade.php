<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">
        {{ $selectedDate ? 'New Appointment for ' . $selectedDate : 'New Appointment' }}
    </h3>
    
    <form wire:submit.prevent="save" class="space-y-4">
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet</label>
            <select wire:model="form.pet_id" id="pet_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                <option value="">Select a pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                @endforeach
            </select>
            @if($errors->has('form.pet_id'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->first('form.pet_id') }}</p>
            @endif
        </div>
        @php
            $vetId = is_object($veterinarianProfile) ? $veterinarianProfile->id : $veterinarianProfile;
            $vet = $vets->firstWhere('id', $vetId);
        @endphp

        @if(!$vetId)
            <div>
                <label for="veterinarian_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Veterinarian</label>
                <select wire:model="form.veterinarian_id" id="veterinarian_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    <option value="">Select a veterinarian</option>
                    @foreach($vets as $vetOption)
                        <option value="{{ $vetOption->user_id }}">
                            {{ $vetOption->user->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('form.veterinarian_id'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('form.veterinarian_id') }}</p>
                @endif
            </div>
        @elseif($vet)
            <input type="hidden" wire:model="form.veterinarian_id" value="{{ $vet->user_id }}">
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Veterinarian</p>
                <p class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $vet->user->name }}</p>
            </div>
        @endif

        <div>
            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date & Time</label>
            <input type="datetime-local" wire:model="form.start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
            @if($errors->has('form.start_time'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->first('form.start_time') }}</p>
            @endif
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
            <textarea wire:model="form.notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600"></textarea>
            @if($errors->has('form.notes'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->first('form.notes') }}</p>
            @endif
        </div>

        <div class="flex justify-end space-x-2 pt-4">
            <button type="button" @click="$dispatch('close-modal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700">
                Save Appointment
            </button>
        </div>
    </form>

    @push('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
</div>
