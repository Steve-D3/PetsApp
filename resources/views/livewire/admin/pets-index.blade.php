<div class="flex flex-col py-8 px-6 text-white justify-center items-center">
    <h1 class="text-2xl font-bold mb-6 px-6">Pets</h1>

    <div class="flex overflow-hidden px-6 justify-center align-middle content-center">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow ">
            <thead class="bg-gray-100 dark:bg-gray-700 rounded-lg">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase"></th>
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
                @foreach ($pets as $pet)
                    <tr>
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
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $pet->weight ?? '—' }} Kg</td>
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $pet->microchip_number ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm flex justify-between">
                            <div class="space-x-4">
                                <div>
                                    <a href="#" class="text-blue-500 hover:underline">Edit</a>
                                </div>
                                <div>
                                    <a href="#" class="text-red-500 hover:underline">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
