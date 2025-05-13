<div class="py-8 px-6 text-white xl:px-24 lg:max-w-4xl mx-auto">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Edit Appointment
                </h2>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span>For: {{ $form->pet_name }}</span>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span>With: {{ $form->vet_name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <form wire:submit.prevent="update" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                @if (session()->has('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet</label>
                        <select wire:model.defer="form.pet_id" id="pet_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            <option value="">Select a pet</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" @if($pet->id == $form->pet_id) selected @endif>
                                    {{ $pet->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.pet_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="veterinarian_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Veterinarian</label>
                        <select wire:model.defer="form.veterinarian_id" id="veterinarian_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            <option value="">Select a veterinarian</option>
                            @foreach($vets as $vet)
                                <option value="{{ $vet->user_id }}" @if($vet->user_id == $form->veterinarian_id) selected @endif>
                                    {{ $vet->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.veterinarian_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date & Time</label>
                        <input type="datetime-local" wire:model.defer="form.start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select wire:model.defer="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            <option value="pending" @if($form->status === 'pending') selected @endif>Pending</option>
                            <option value="confirmed" @if($form->status === 'confirmed') selected @endif>Confirmed</option>
                            <option value="completed" @if($form->status === 'completed') selected @endif>Completed</option>
                            <option value="cancelled" @if($form->status === 'cancelled') selected @endif>Cancelled</option>
                        </select>
                        @error('form.status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                        <textarea wire:model.defer="form.notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
                        @error('form.notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('admin.pets.show', $appointment->pet_id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
