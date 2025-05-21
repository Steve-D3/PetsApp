<div class="max-w-4xl mx-auto lg:my-20 p-6 bg-white dark:bg-gray-800 text-black dark:text-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Pet</h2>


    @if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => { show = false;
            window.location.href = '{{ route('admin.pets.index') }}'; }, 2000)" x-show="show"
        class="bg-green-100 text-green-800 p-3 rounded mb-4 transition-opacity duration-500">
        {{ session('success') }}
    </div>
    @endif



    <form wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block mb-1 font-semibold">Pet Name</label>
                <input id="name" wire:model="form.name" type="text"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
            </div>
            <div>
                <label for="pet_species" class="block mb-1 font-semibold">Species</label>
                <input id="pet_species" wire:model="form.species" type="text"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
            </div>
            <div>
                <label for="pet_breed" class="block mb-1 font-semibold">Breed</label>
                <input id="pet_breed" type="text"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.breed" />
            </div>
            <div>
                <label for="pet_microchip_number" class="block mb-1 font-semibold">Microchip Number</label>
                <input id="pet_microchip_number" type="text"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.microchip_number" />
            </div>
            <div>
                <label for="pet_sterilized" class="block mb-1 font-semibold">Sterilized</label>
                <select id="pet_sterilized"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.sterilized">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label for="pet_gender" class="block mb-1 font-semibold">Gender</label>
                <select id="pet_gender" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.gender">
                    <option value="" {{ $form->gender == '' ? 'selected' : '' }}>--</option>
                    <option value="Male" {{ $form->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $form->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div>
                <label for="pet_weight" class="block mb-1 font-semibold">Weight (kg)</label>
                <input id="pet_weight" type="number" step="0.01"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.weight" />
            </div>
            <div>
                <label for="pet_birth_date" class="block mb-1 font-semibold">Birth Date</label>
                <input id="pet_birth_date" type="date"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.birth_date" />
            </div>
            <div>
                <label for="pet_allergies" class="block mb-1 font-semibold">Allergies</label>
                <textarea id="pet_allergies"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.allergies"></textarea>
            </div>
            <div>
                <label for="pet_food_preferences" class="block mb-1 font-semibold">Food Preferences</label>
                <textarea id="pet_food_preferences"
                    class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"
                    wire:model="form.food_preferences"></textarea>
            </div>
        </div>

        <div class="lg:col-span-2 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Update Pet
            </button>
        </div>
    </form>
</div>
