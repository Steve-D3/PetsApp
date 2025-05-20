<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Appointment Calendar</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">View and manage your appointments</p>
        </div>

        @if($loading)
            <div class="flex items-center justify-center h-64">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $selectedDate->format('F Y') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4">
                            <div id="calendar" class="h-[600px]"></div>
                        </div>
                    </div>
                </div>


        <!-- Appointment Details Modal -->
        @if($showDetails && $selectedAppointment)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-xl w-full mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            Appointment Details
                        </h3>
                        <button wire:click="closeDetails" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Pet Name:</h4>
                            <p class="text-gray-600 dark:text-gray-300">{{ $selectedAppointment['pet_name'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Owner Name:</h4>
                            <p class="text-gray-600 dark:text-gray-300">{{ $selectedAppointment['owner_name'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Time:</h4>
                            <p class="text-gray-600 dark:text-gray-300">{{ $selectedAppointment['start_time'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Status:</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($selectedAppointment['status'] === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @elseif($selectedAppointment['status'] === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                @endif">
                                {{ ucfirst($selectedAppointment['status']) }}
                            </span>
                        </div>
                        @if($selectedAppointment['notes'])
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Notes:</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ $selectedAppointment['notes'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

                <!-- Appointments List -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden h-full">
                        <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Upcoming Appointments
                            </h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">For {{ $selectedDate->format('F Y') }}</p>
                        </div>
                        <div class="overflow-y-auto" style="max-height: 600px;">
                            @if(count($appointments) > 0)
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($appointments as $appointment)
                                        <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer"
                                            wire:click="selectAppointment({{ $appointment['id'] }})">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        {{ $appointment['pet_name'] }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $appointment['start_time'] }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                        {{ $appointment['owner_name'] }}
                                                    </p>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                        @if($appointment['status'] === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                                        @elseif($appointment['status'] === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                                        @endif">
                                                        {{ ucfirst($appointment['status']) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="p-6 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No appointments</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        No appointments scheduled for this month.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: @json($appointments),
                    eventClick: function(info) {
                        @this.selectAppointment(info.event.extendedProps.id);
                    },
                    eventDidMount: function(info) {
                        info.el.style.cursor = 'pointer';
                    },
                    themeSystem: 'bootstrap5',
                    darkTheme: @json(auth()->user()->dark_mode ?? false)
                });

                calendar.render();

                // Listen for Livewire events
                Livewire.on('calendarUpdated', function() {
                    calendar.refetchEvents();
                });
            });
        </script>
        @endpush
    </div>
</div>
