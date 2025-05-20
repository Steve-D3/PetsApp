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
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $selectedDate->format('F Y') }}
                                </h2>
                                <button wire:click="openCreateModal"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    New Appointment
                                </button>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
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
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden h-full">
                        <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Upcoming Appointments
                            </h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                For {{ $selectedDate->format('F Y') }}
                            </p>
                        </div>
                        <div class="overflow-y-auto max-h-[600px]">
                            @if(count($appointments) > 0)
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($appointments as $appointment)
                                        <a href="{{ route('admin.appointments.show', $appointment['id']) }}"
                                            class="block hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                            <div class="p-4">
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
                                            </div>
                                        </a>
                                    @endforeach
                                </ul>
                            @else
                                <div class="p-6 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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

        <!-- Create Appointment Modal -->
        <div x-data="{}" x-show="$wire.showCreateModal" style="display: none;"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div x-show="$wire.showCreateModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="$wire.closeCreateModal()"
                    aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div x-show="$wire.showCreateModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative inline-block bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                New Appointment
                            </h3>
                            <div class="mt-2">
                                <form wire:submit.prevent="createAppointment">
                                    <div class="space-y-4">
                                        <!-- Pet Selection -->
                                        <div>
                                            <label for="pet_id"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Pet
                                            </label>
                                            <select id="pet_id" wire:model="newAppointment.pet_id"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option value="">Select a pet</option>
                                                @foreach($pets as $pet)
                                                    <option value="{{ $pet->id }}">{{ $pet->name }}
                                                        ({{ $pet->owner->name }})</option>
                                                @endforeach
                                            </select>
                                            @error('newAppointment.pet_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Start Time -->
                                        <div>
                                            <label for="start_time"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Start Time
                                            </label>
                                            <input type="datetime-local" id="start_time"
                                                wire:model="newAppointment.start_time"
                                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            @error('newAppointment.start_time')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Notes -->
                                        <div>
                                            <label for="notes"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Notes
                                            </label>
                                            <textarea id="notes" wire:model="newAppointment.notes" rows="3"
                                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                            @error('newAppointment.notes')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                        <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">
                                            Create Appointment
                                        </button>
                                        <button type="button" wire:click="closeCreateModal()"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: @json($appointments),
                        eventClick: function (info) {
                            info.jsEvent.preventDefault();
                            info.jsEvent.stopPropagation();

                            const event = info.event;
                            const props = event.extendedProps;
                            const eventDetails = `
                                        <div class="text-left">
                                            <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">${event.title}</h3>
                                            <div class="space-y-2">
                                                <p class="flex items-center">
                                                    <span class="w-24 text-gray-600 dark:text-gray-300">Status:</span>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        ${props.status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : ''}
                                                        ${props.status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : ''}
                                                        ${!['completed', 'cancelled'].includes(props.status) ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : ''}
                                                        capitalize">
                                                        ${props.status || 'scheduled'}
                                                    </span>
                                                </p>
                                                <p class="flex items-center">
                                                    <span class="w-24 text-gray-600 dark:text-gray-300">Date:</span>
                                                    <span class="text-gray-900 dark:text-white">${event.start ? event.start.toLocaleString() : 'N/A'}</span>
                                                </p>
                                                ${props.pet_name ? `
                                                <p class="flex items-center">
                                                    <span class="w-24 text-gray-600 dark:text-gray-300">Pet:</span>
                                                    <span class="text-gray-900 dark:text-white">${props.pet_name}</span>
                                                </p>` : ''}
                                                ${props.owner_name ? `
                                                <p class="flex items-center">
                                                    <span class="w-24 text-gray-600 dark:text-gray-300">Owner:</span>
                                                    <span class="text-gray-900 dark:text-white">${props.owner_name}</span>
                                                </p>` : ''}
                                                ${props.notes ? `
                                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                    <h4 class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Notes:</h4>
                                                    <p class="text-gray-900 dark:text-white">${props.notes}</p>
                                                </div>` : ''}
                                            </div>
                                        </div>
                                    `;

                            Swal.fire({
                                html: eventDetails,
                                showCancelButton: true,
                                confirmButtonText: 'View Details',
                                cancelButtonText: 'Close',
                                showDenyButton: true,
                                denyButtonText: 'Cancel Appointment',
                                confirmButtonColor: '#3b82f6',
                                cancelButtonColor: '#6b7280',
                                denyButtonColor: '#ef4444',
                                width: '500px',
                                padding: '1.5rem',
                                customClass: {
                                    popup: 'dark:bg-gray-800 dark:text-white',
                                    title: 'dark:text-white',
                                    htmlContainer: 'dark:text-gray-300',
                                    confirmButton: 'px-4 py-2 text-sm font-medium',
                                    cancelButton: 'px-4 py-2 text-sm font-medium',
                                    denyButton: 'px-4 py-2 text-sm font-medium',
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = `/admin/appointments/${event.id}`;
                                } else if (result.isDenied) {
                                    // Handle cancel appointment
                                    @this.cancelAppointment(event.id);
                                }
                            });

                            return false;
                        },
                        eventDidMount: function (info) {
                            info.el.style.cursor = 'pointer';
                            // Add tooltip with appointment details
                            if (info.event.extendedProps.pet_name) {
                                // Use tippy.js for better tooltips if available
                                if (window.tippy) {
                                    tippy(info.el, {
                                        content: `
                                                    <div class="text-sm">
                                                        <div class="font-medium">${info.event.extendedProps.pet_name}</div>
                                                        <div>${info.event.extendedProps.owner_name}</div>
                                                        <div>${info.event.extendedProps.start_time}</div>
                                                        <div>Status: ${info.event.extendedProps.status}</div>
                                                    </div>
                                                `,
                                        allowHTML: true,
                                        theme: 'light-border',
                                        interactive: true,
                                        appendTo: document.body
                                    });
                                } else {
                                    // Fallback to native title
                                    info.el.setAttribute('title',
                                        `${info.event.extendedProps.pet_name} - ${info.event.extendedProps.owner_name}\n` +
                                        `${info.event.extendedProps.start_time}\n` +
                                        `Status: ${info.event.extendedProps.status}`
                                    );
                                }
                            }
                        },
                        themeSystem: 'bootstrap5',
                        darkTheme: @json(auth()->user()->dark_mode ?? false)
                    });

                    calendar.render();

                    // Listen for Livewire events
                    Livewire.on('calendarUpdated', function () {
                        calendar.refetchEvents();
                    });
                });
            </script>
        @endpush
    </div>
</div>
