<div
    class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6 transition-colors duration-200">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Appointment Calendar</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View and manage your appointments</p>
                </div>
                <button wire:click="openCreateModal"
                    class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5 transform">
                    <x-icon.plus class="-ml-1 mr-2 h-5 w-5" />
                    New Appointment
                </button>
            </div>
        </div>

        @if($loading)
            <div
                class="flex flex-col items-center justify-center h-96 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl border border-gray-100 dark:border-gray-700/50 p-8 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500 mb-4"></div>
                <p class="text-gray-600 dark:text-gray-300">Loading appointments...</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
                <!-- Calendar Section -->
                <div class="lg:col-span-2 transform transition-all duration-300 hover:scale-[1.005]">
                    <div
                        class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100/60 dark:border-gray-700/60 overflow-hidden transition-all duration-300 hover:shadow-2xl">
                        <div
                            class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800/80 border-b border-gray-100/50 dark:border-gray-700/50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                        {{ $selectedDate->format('F Y') }}
                                    </h2>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">
                                        Manage your appointments
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 transition-all duration-300">
                            <div id="calendar"
                                class="h-[600px] [&_.fc]:bg-transparent [&_.fc-header-toolbar]:mb-4 [&_.fc-toolbar-title]:text-xl [&_.fc-toolbar-title]:font-bold [&_.fc-toolbar-title]:text-gray-800 [&_.fc-toolbar-title]:dark:text-white [&_.fc-button]:bg-white [&_.fc-button]:border [&_.fc-button]:border-gray-200 [&_.fc-button]:text-black [&_.fc-button]:shadow-sm [&_.fc-button]:rounded [&_.fc-button]:px-4 [&_.fc-button]:py-1.5 [&_.fc-button]:text-sm [&_.fc-button]:font-medium [&_.fc-button]:transition-all [&_.fc-button]:duration-200 [&_.fc-button:hover]:bg-gray-50 [&_.fc-button:hover]:text-blue-600  [&_.fc-button:hover]:shadow-md [&_.fc-button-active]:bg-red [&_.fc-button-active]:border-indigo-200 [&_.fc-button-active]:text-indigo-700 [&_.fc-button-active]:shadow-md [&_.fc-button:not(:disabled)]:hover:bg-gray-50 [&_.fc-button:not(:disabled)]:active:bg-gray-100 [&_.fc-button:not(:disabled)]:active:border-gray-200 [&_.fc-button:not(:disabled)]:focus:ring-2 [&_.fc-button:not(:disabled)]:focus:ring-indigo-500 [&_.fc-button:not(:disabled)]:focus:ring-offset-2 [&_.fc-button:not(:disabled)]:focus:outline-none [&_.fc-button:disabled]:opacity-50 [&_.fc-button:disabled]:cursor-not-allowed [&_.fc-button:disabled]:shadow-none [&_.fc-button:disabled]:bg-gray-50 [&_.fc-button:disabled]:text-gray-400 [&_.fc-button:disabled]:border-gray-200 [&_.fc-daygrid-day-number]:text-gray-700 [&_.fc-daygrid-day-number]:dark:text-gray-300 [&_.fc-col-header-cell-cushion]:text-gray-600 [&_.fc-col-header-cell-cushion]:dark:text-gray-300 [&_.fc-day-today]:bg-indigo-50/70 [&_.fc-day-today]:dark:bg-indigo-900/20 [&_.fc-day-today]:text-indigo-700 [&_.fc-day-today]:dark:text-indigo-400 [&_.fc-daygrid-day-top]:p-2 [&_.fc-daygrid-day-top]:text-right [&_.fc-daygrid-day-top]:font-medium [&_.fc-daygrid-day-top]:text-gray-700 [&_.fc-daygrid-day-top]:dark:text-gray-300 [&_.fc-day-today_.fc-daygrid-day-top]:text-indigo-700 [&_.fc-day-today_.fc-daygrid-day-top]:dark:text-indigo-400 [&_.fc-day-today_.fc-daygrid-day-number]:font-bold [&_.fc-daygrid-event]:cursor-pointer [&_.fc-daygrid-event]:rounded-lg [&_.fc-daygrid-event]:border [&_.fc-daygrid-event]:border-opacity-20 [&_.fc-daygrid-event]:shadow-sm [&_.fc-daygrid-event]:px-2 [&_.fc-daygrid-event]:py-1 [&_.fc-daygrid-event]:text-xs [&_.fc-daygrid-event]:font-medium [&_.fc-daygrid-event-dot]:hidden [&_.fc-event-main]:flex [&_.fc-event-main]:items-center [&_.fc-event-main]:gap-1 [&_.fc-event-time]:font-medium [&_.fc-event-title]:truncate [&_.fc-daygrid-dot-event]:bg-transparent [&_.fc-daygrid-dot-event]:hover:bg-transparent [&_.fc-daygrid-dot-event]:focus:bg-transparent [&_.fc-daygrid-dot-event]:active:bg-transparent [&_.fc-daygrid-dot-event]:focus:ring-0 [&_.fc-daygrid-dot-event]:focus:ring-offset-0 [&_.fc-daygrid-dot-event]:focus:outline-none [&_.fc-daygrid-dot-event]:focus:shadow-none [&_.fc-daygrid-dot-event_.fc-event-time]:font-semibold [&_.fc-daygrid-event-harness]:transition-all [&_.fc-daygrid-event-harness]:duration-200 [&_.fc-daygrid-event-harness]:hover:scale-[1.02] [&_.fc-daygrid-event-harness]:hover:z-10">
                            </div>
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
                <div class="lg:col-span-1 transform transition-all duration-300 hover:scale-[1.005]">
                    <div
                        class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100/60 dark:border-gray-700/60 overflow-hidden h-full flex flex-col transition-all duration-300 hover:shadow-2xl">
                        <div
                            class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800/80 border-b border-gray-100/50 dark:border-gray-700/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                        Upcoming Appointments
                                    </h2>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">
                                        For {{ $selectedDate->format('F Y') }}
                                    </p>
                                </div>
                                <button wire:click="$refresh"
                                    class="p-1.5 rounded-full text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 hover:rotate-180 hover:scale-110"
                                    title="Refresh">
                                </button>
                            </div>
                        </div>
                        <div
                            class="overflow-hidden flex-1 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent">
                            @if(count($appointments) > 0)
                                <ul class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    @foreach($appointments as $appointment)
                                        <a href="{{ route('admin.appointments.show', $appointment['id']) }}"
                                            class="block hover:bg-gray-50/90 dark:hover:bg-gray-700/60 transition-all duration-200 transform hover:scale-[1.01] hover:shadow-sm">
                                            <div class="p-4">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex-shrink-0 mt-0.5">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/30 flex items-center justify-center shadow-sm">
                                                            <x-icon.paw class="h-5 w-5 text-indigo-600 dark:text-indigo-400" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between gap-2">
                                                            <h3
                                                                class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                                {{ $appointment['pet_name'] }}
                                                            </h3>
                                                            @php
                                                                $statusClasses = [
                                                                    'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                                    'confirmed' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300',
                                                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                                    'no_show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                                ];
                                                                $statusClass = $statusClasses[$appointment['status']] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                                            @endphp
                                                            <span
                                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} flex-shrink-0">
                                                                {{ ucfirst(str_replace('_', ' ', $appointment['status'])) }}
                                                            </span>
                                                        </div>
                                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                                            <x-icon.calendar class="w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5" />
                                                            {{ $appointment['start_time'] }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                                                            <x-icon.user class="w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5" />
                                                            {{ $appointment['owner_name'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </ul>
                            @else
                                <div class="p-8 text-center animate-pulse">
                                    <div
                                        class="mx-auto h-16 w-16 rounded-full bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/20 flex items-center justify-center mb-4 shadow-inner">
                                        <x-icon.calendar class="h-8 w-8 text-indigo-600 dark:text-indigo-400" />
                                    </div>
                                    <h3 class="text-base font-medium text-gray-900 dark:text-white">No appointments</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        No appointments scheduled for this month.
                                    </p>
                                    <div class="mt-6">
                                        <button wire:click="openCreateModal"
                                            class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5 transform">
                                            <x-icon.plus class="-ml-1 mr-2 h-5 w-5" />
                                            New Appointment
                                        </button>
                                    </div>
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
                    Livewire.on('monthChanged', function (dateStr) {
                        calendar.gotoDate(dateStr);
                        calendar.refetchEvents();
                    });

                    // Listen for window resize to properly handle calendar redraw
                    window.addEventListener('resize', function () {
                        calendar.updateSize();
                    });

                    // Initialize the calendar
                    calendar.render();
                });
            </script>
        @endpush
    </div>

    @push('styles')
        <style>
            /* Modern Calendar Styling */
            #calendar {
                --fc-border-color: rgba(203, 213, 225, 0.3);
                --fc-page-bg-color: transparent;
                --fc-neutral-bg-color: rgba(241, 245, 249, 0.5);
                --fc-today-bg-color: rgba(199, 210, 254, 0.15);
                --fc-highlight-color: rgba(199, 210, 254, 0.3);
                --fc-event-bg-color: #4f46e5;
                --fc-event-border-color: #4338ca;
                --fc-event-text-color: #ffffff;
                --fc-button-bg-color: #ffffff;
                --fc-button-border-color: #e2e8f0;
                --fc-button-text-color: #1e293b;
                --fc-button-hover-bg-color: #f8fafc;
                --fc-button-hover-text-color: #4338ca;
                --fc-button-active-bg-color: #eef2ff;
                --fc-button-active-border-color: #c7d2fe;
                --fc-button-active-text-color: #4338ca;
            }

            .dark #calendar {
                --fc-border-color: rgba(71, 85, 105, 0.5);
                --fc-neutral-bg-color: rgba(30, 41, 59, 0.5);
                --fc-today-bg-color: rgba(99, 102, 241, 0.15);
                --fc-highlight-color: rgba(99, 102, 241, 0.3);
                --fc-event-bg-color: #6366f1;
                --fc-event-border-color: #4f46e5;
                --fc-event-text-color: #e0e7ff;
                --fc-button-bg-color: #1e293b;
                --fc-button-border-color: #334155;
                --fc-button-text-color: #e2e8f0;
                --fc-button-hover-bg-color: #1e293b;
                --fc-button-hover-text-color: #a5b4fc;
                --fc-button-active-bg-color: #1e1b4b;
                --fc-button-active-border-color: #4f46e5;
                --fc-button-active-text-color: #c7d2fe;
            }

            /* Calendar Container */
            #calendar .fc {
                @apply rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm p-4 shadow-sm ring-1 ring-black/5 dark:ring-white/10;
                transition: all 0.3s ease;
            }

            .dark #calendar .fc {
                @apply shadow-lg shadow-indigo-900/10;
            }

            /* Header */
            #calendar .fc-header-toolbar {
                @apply mb-6 flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between;
            }

            #calendar .fc-toolbar-title {
                @apply text-xl font-bold text-slate-800 dark:text-slate-100 transition-colors;
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
            }

            /* Navigation Buttons */
            #calendar .fc-toolbar-chunk {
                @apply flex items-center space-x-2;
            }

            #calendar .fc-button {
                @apply relative overflow-hidden transition-all duration-200 ease-in-out;
                background-color: var(--fc-button-bg-color);
                border: 1px solid var(--fc-button-border-color);
                color: var(--fc-button-text-color);
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                font-weight: 500;
                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            }

            #calendar .fc-button:hover {
                background-color: var(--fc-button-hover-bg-color);
                color: var(--fc-button-hover-text-color);
                transform: translateY(-1px);
                box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            }

            #calendar .fc-button:active,
            #calendar .fc-button.fc-button-active {
                background-color: var(--fc-button-active-bg-color);
                border-color: var(--fc-button-active-border-color);
                color: var(--fc-button-active-text-color);
                transform: translateY(0);
                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            }

            #calendar .fc-button:focus {
                @apply outline-none ring-2 ring-indigo-500/50 ring-offset-1;
            }

            /* Day Headers */
            #calendar .fc-col-header {
                @apply border-b border-slate-200/50 dark:border-slate-700/50 pb-2 mb-2;
            }

            #calendar .fc-col-header-cell {
                @apply py-3 text-center;
            }

            #calendar .fc-col-header-cell-cushion {
                @apply text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 transition-colors;
                padding: 0.5rem;
            }

            /* Day Cells */
            #calendar .fc-daygrid-day {
                @apply transition-colors duration-200 p-1;
            }

            #calendar .fc-daygrid-day-number {
                @apply w-7 h-7 flex items-center justify-center rounded-full text-sm font-medium text-slate-700 dark:text-slate-300 transition-colors;
                margin: 0.25rem;
            }

            #calendar .fc-day-today .fc-daygrid-day-number {
                @apply bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300 font-bold;
            }

            #calendar .fc-day-other .fc-daygrid-day-number {
                @apply text-slate-400 dark:text-slate-600;
            }

            #calendar .fc-daygrid-day:hover .fc-daygrid-day-number {
                @apply bg-slate-100 dark:bg-slate-700/50;
            }

            #calendar .fc-day-today:hover .fc-daygrid-day-number {
                @apply bg-indigo-200 dark:bg-indigo-800/70;
            }

            /* Events */
            #calendar .fc-daygrid-event {
                @apply rounded-lg border-0 shadow-sm transition-all duration-200 ease-in-out overflow-hidden;
                background-color: var(--fc-event-bg-color);
                border: 1px solid var(--fc-event-border-color);
                color: var(--fc-event-text-color);
                margin: 0.125rem 0.25rem;
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
                font-weight: 500;
            }

            #calendar .fc-daygrid-event:hover {
                @apply shadow-md -translate-y-0.5;
                z-index: 10;
            }

            #calendar .fc-event-main {
                @apply flex items-center gap-2 overflow-hidden;
            }

            #calendar .fc-event-time {
                @apply font-semibold opacity-90;
            }

            #calendar .fc-event-title {
                @apply truncate opacity-90;
            }

            /* Event Status Colors */
            #calendar .fc-event[data-status="scheduled"] {
                @apply bg-blue-500 border-blue-600 dark:bg-blue-600/90 dark:border-blue-700;
            }

            #calendar .fc-event[data-status="confirmed"] {
                @apply bg-emerald-500 border-emerald-600 dark:bg-emerald-600/90 dark:border-emerald-700;
            }

            #calendar .fc-event[data-status="completed"] {
                @apply bg-green-500 border-green-600 dark:bg-green-600/90 dark:border-green-700;
            }

            #calendar .fc-event[data-status="cancelled"] {
                @apply bg-rose-500 border-rose-600 dark:bg-rose-600/90 dark:border-rose-700;
            }

            #calendar .fc-event[data-status="no_show"] {
                @apply bg-amber-500 border-amber-600 dark:bg-amber-600/90 dark:border-amber-700;
            }

            /* Scrollbar Styling */
            #calendar ::-webkit-scrollbar {
                @apply w-2 h-2;
            }

            #calendar ::-webkit-scrollbar-track {
                @apply bg-transparent rounded-full;
            }

            #calendar ::-webkit-scrollbar-thumb {
                @apply bg-slate-300 dark:bg-slate-600 rounded-full hover:bg-slate-400 dark:hover:bg-slate-500;
            }

            /* Loading State */
            #calendar.fc-loading {
                @apply opacity-50 pointer-events-none;
            }

            #calendar.fc-loading::after {
                content: '';
                @apply absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer;
                z-index: 10;
            }

            @keyframes shimmer {
                0% {
                    transform: translateX(-100%);
                }

                100% {
                    transform: translateX(100%);
                }
            }

            /* Custom Animations */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.7;
                    transform: scale(0.98);
                }
            }
        </style>
    @endpush
</div>
