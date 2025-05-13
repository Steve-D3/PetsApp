<div class="py-8 px-6 text-white xl:px-24 lg:max-w-6xl mx-auto">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Edit Veterinarian
                </h2>
            </div>
        </div>

        <div class="mt-8">
            <form wire:submit.prevent="update" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                @if (session()->has('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" wire:model.defer="form.name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" wire:model.defer="form.email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="license_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Number</label>
                        <input type="text" wire:model.defer="form.license_number" id="license_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.license_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="specialty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Specialty</label>
                        <input type="text" wire:model.defer="form.specialty" id="specialty" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.specialty') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                        <input type="text" wire:model.defer="form.phone_number" id="phone_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('form.phone_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="vet_clinic_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Clinic</label>
                        <select wire:model.defer="form.vet_clinic_id" id="vet_clinic_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            <option value="">-- Select Clinic --</option>
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}" @if($clinic->id == $form->vet_clinic_id) selected @endif>
                                    {{ $clinic->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.vet_clinic_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="biography" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biography</label>
                        <textarea wire:model.defer="form.biography" id="biography" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
                        @error('form.biography') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Off Days</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-7 gap-2">
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <div class="flex items-center">
                                    <input type="checkbox" id="day-{{ $day }}" wire:model.defer="form.off_days" value="{{ $day }}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                    <label for="day-{{ $day }}" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                        {{ $day }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('form.off_days') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('vets.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Veterinarian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
