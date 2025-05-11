<div class="flex flex-col py-8 px-6 text-white justify-center items-center">
    <h1 class="text-2xl font-bold mb-6 px-6">Pets on the database</h1>

    {{-- Filters and Add Button --}}
    <div class=" max-w-7xl mx-auto flex flex-col sm:flex-row sm:gap-4 mb-4 w-full px-6">
        <select wire:model="filterSpecies" wire:change="$refresh" class="bg-white text-black px-8 py-2 rounded-lg mb-2 sm:mb-0 sm:w-1/4">
            <option value="">All Species</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Bird">Bird</option>
            <option value="Reptile">Reptile</option>
            <option value="Rabbit">Rabbit</option>
        </select>

        <select wire:model="filterSterilized" wire:change="$refresh" class="bg-white text-black px-8 py-2 rounded-lg mb-2 sm:mb-0 sm:w-1/4">
            <option value="">Sterilized?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <select wire:model="filterMicrochip" wire:change="$refresh" class="bg-white text-black px-8 py-2 rounded-lg mb-2 sm:mb-0 sm:w-1/4">
            <option value="">Microchip?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <a href="{{ route('admin.pets.create') }}"
           class="ml-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow sm:w-auto sm:ml-4">
            Add Pet
        </a>
    </div>


    {{-- Table --}}
    <div class="overflow-x-auto px-6 w-full max-w-7xl">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Name
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                        Species</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Breed
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                        Sterilized</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Age
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Owner
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                        Weight</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                        Microchip Nr</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($pets as $pet)
                    <tr wire:key="pet-{{ $pet->id }}">
                        <td class="px-4 py-3">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                alt="Pet" class="w-10 h-10 object-cover rounded-full" width="50"
                                height="50">
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->species }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->breed ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $pet->sterilized ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->birth_date ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->owner->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->weight ?? '—' }} Kg
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $pet->microchip_number ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="space-x-4 flex justify-between">
                                <a href="{{ route('admin.pets.show', $pet->id) }}" class="text-blue-500 hover:underline">Details</a>
                                <a href="{{ route('admin.pets.edit', $pet->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <a href="delete({{ $pet->id }})" wire:click.prevent="delete({{ $pet->id }})"
                                    wire:confirm="Are you sure you want to delete this pet?"
                                    class="text-red-500 hover:underline">Delete</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-500">No pets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
