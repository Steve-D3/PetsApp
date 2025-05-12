<form wire:submit.prevent="save" class="space-y-6 bg-white dark:bg-gray-800 p-6 lg:my-14 rounded-xl shadow max-w-3xl mx-auto text-gray-900 dark:text-white">
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <label for="name" class="block font-medium">Full Name</label>
        <input type="text" wire:model.defer="form.name" id="name" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        @error('form.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="email" class="block font-medium">Email</label>
        <input type="email" wire:model.defer="form.email" id="email" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="license_number" class="block font-medium">License Number</label>
        <input type="text" wire:model.defer="form.license_number" id="license_number" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        @error('form.license_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="specialty" class="block font-medium">Specialty</label>
        <input type="text" wire:model.defer="form.specialty" id="specialty" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
    </div>

    <div>
        <label for="biography" class="block font-medium">Biography</label>
        <textarea wire:model.defer="form.biography" id="biography" rows="3" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600"></textarea>
    </div>

    <div>
        <label for="phone_number" class="block font-medium">Phone Number</label>
        <input type="text" wire:model.defer="form.phone_number" id="phone_number" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
    </div>

    <div>
        <label for="vet_clinic_id" class="block font-medium">Vet Clinic</label>
        <select wire:model.defer="form.vet_clinic_id" id="vet_clinic_id" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
            <option value="">-- Select Clinic --</option>
            @foreach ($clinics as $clinic)
                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
            @endforeach
        </select>
        @error('form.vet_clinic_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium mb-1">Off Days</label>
        <div class="flex flex-wrap gap-2">
            @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model.defer="form.off_days" value="{{ $day }}" class="mr-1">
                    {{ $day }}
                </label>
            @endforeach
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Vet</button>
    </div>
</form>
