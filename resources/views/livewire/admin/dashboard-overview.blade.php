<div class="py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Total Appointments</h2>
            {{-- <p class="text-2xl font-bold">{{ $totalAppointments }}</p> --}}
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Total Vets</h2>
            {{-- <p class="text-2xl font-bold">{{ $totalVets }}</p> --}}
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Total Clients</h2>
            {{-- <p class="text-2xl font-bold">{{ $totalClients }}</p> --}}
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Total Pets</h2>
            {{-- <p class="text-2xl font-bold">{{ $totalPets }}</p> --}}
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Recent Appointments</h2>
            {{-- <livewire:admin.recent-appointments /> --}}
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Recent Clients</h2>
            {{-- <livewire:admin.recent-clients /> --}}
        </div>
    </div>
</div>
