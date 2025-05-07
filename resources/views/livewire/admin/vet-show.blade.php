<div class="py-8 px-6 text-white gap-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Veterinarian Details</h1>

    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 place-items-center md:place-items-start">
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Personal Info</h2>
                <p><span class="font-semibold">Name:</span>{{ $vet->user?->name ?? 'Unknown' }}</p>
                <p><span class="font-semibold">Email:</span> {{ $vet->user?->email ?? 'Unknown' }}</p>
                <p><span class="font-semibold">Phone:</span> {{ $vet->phone_number ?? 'Unknown' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Professional Info</h2>
                <p><span class="font-semibold">License Number:</span> {{ $vet->license_number ?? 'Unknown' }}</p>
                <p><span class="font-semibold">Specialty:</span> {{ $vet->specialty ?? 'Unknown' }}</p>
                <p><span class="font-semibold"></span> {{ $vet->clinic?->name ?? 'Unknown' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Availability</h2>
                <p><span class="font-semibold">Off Days:</span> {{ $vet->off_days ?? 'Unknown' }}</p>
                <p><span class="font-semibold">Consultation Fee:</span> TEST</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Clinic</h2>
                <p><span class="font-semibold">Off Days:</span> {{ $vet->off_days ?? 'Unknown' }}</p>
                <p><span class="font-semibold">Consultation Fee:</span> TEST</p>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow py-8 mt-6">

    </div>
</div>
