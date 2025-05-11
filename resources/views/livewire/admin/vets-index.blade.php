<div class="py-8 px-6 text-white xl:px-24 lg:max-w-7xl mx-auto">
    <div>
        <h1 class="text-2xl font-bold mb-6 px-6">Veterinarians</h1>

        <div>
            <a href="{{  route('admin.vets.create') }}"
                class="ml-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow sm:w-auto sm:ml-4">
                Add
            </a>
        </div>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 py-6">
        @foreach ($vets as $vet)
            <a href="{{ route('admin.vets.show', $vet->id) }}">
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-xl transition-shadow duration-300 h-full">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                        {{ $vet->user?->name ?? 'Unknown Vet' }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">License: {{ $vet->license_number ?? '—' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Specialty: {{ $vet->specialty ?? '—' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Clinic: {{ $vet->clinic?->name ?? '—' }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
