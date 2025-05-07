<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-2xl font-bold text-white mb-6">Add New Pet</h2>

    <form wire:submit.prevent="save" class="max-w-5xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-xl transition-shadow duration-300">
        <div>
            <label class="block font-medium text-white">Name</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium text-white">Owner</label>
            <input type="text" wire:model="owner" class="w-full border rounded p-2">
            @error('owner') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium text-white">Species</label>
            <select wire:model="species" class="w-full border rounded p-2">
                <option value="">Select</option>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
            </select>
            @error('species') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Add more fields as needed --}}
        <div>
            <label class="block font-medium text-white">Breed</label>
            <input type="text" wire:model="breed" class="w-full border rounded p-2">
            @error('breed') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium text-white">Sterilized</label>
            <select wire:model="sterilized" class="w-full border rounded p-2">
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('sterilized') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded my-4">Save</button>
    </form>
</div>
