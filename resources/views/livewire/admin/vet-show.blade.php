<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                            {{ $veterinarianProfile->user->name }}
                        </h1>
                        <span class="ml-3 px-3 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ $veterinarianProfile->specialty ?? 'Veterinarian' }}
                        </span>
                    </div>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            Member since {{ $veterinarianProfile->created_at->format('M Y') }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                            {{ $veterinarianProfile->appointments()->count() }} appointments
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                    <a href="mailto:{{ $veterinarianProfile->user->email }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        Email
                    </a>
                    <a href="tel:{{ $veterinarianProfile->phone_number }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Call
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Profile Information</h2>
                    <div class="mt-6">
                        <div class="flex items-center justify-center">
                            <div class="h-24 w-24 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-200 text-2xl font-bold">
                                {{ substr($veterinarianProfile->user->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $veterinarianProfile->user->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $veterinarianProfile->specialty ?? 'Veterinarian' }}</p>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <dl class="space-y-4">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    <a href="mailto:{{ $veterinarianProfile->user->email }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ $veterinarianProfile->user->email }}
                                    </a>
                                </dd>
                            </div>
                            @if($veterinarianProfile->phone_number)
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    <a href="tel:{{ $veterinarianProfile->phone_number }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ $veterinarianProfile->phone_number }}
                                    </a>
                                </dd>
                            </div>
                            @endif
                            @if($veterinarianProfile->bio)
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bio</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    {{ $veterinarianProfile->bio }}
                                </dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Clinic Info -->
            <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Clinic Information</h2>
                    <div class="mt-6">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white">{{ $veterinarianProfile->clinic->name }}</h3>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            <p>{{ $veterinarianProfile->clinic->address }}</p>
                            <p>{{ $veterinarianProfile->clinic->postal_code }} {{ $veterinarianProfile->clinic->city }}</p>
                            <p>{{ $veterinarianProfile->clinic->country }}</p>
                        </div>
                        @if($veterinarianProfile->clinic->website)
                        <div class="mt-4">
                            <a href="{{ $veterinarianProfile->clinic->website }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                {{ parse_url($veterinarianProfile->clinic->website, PHP_URL_HOST) }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>



        <!-- Right Column - Calendar -->
        <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Appointment Calendar</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('appointments.create', ['veterinarianProfile' => $veterinarianProfile->id]) }}"
                           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Appointment
                        </a>
                        <button type="button"
                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                            More
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Today's Appointments</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ $veterinarianProfile->appointments()->whereDate('start_time', today())->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Confirmed</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ $veterinarianProfile->appointments()->where('status', 'confirmed')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pending</p>
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ $veterinarianProfile->appointments()->where('status', 'pending')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="p-4">
                    <div class="relative" style="min-height: 600px;">
                        <!-- Loading indicator -->
                        <div id="calendar-loading" class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 z-10 opacity-0 pointer-events-none transition-opacity duration-200">
                            <div class="flex items-center justify-center h-full">
                                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                            </div>
                        </div>
                        <!-- Calendar container -->
                        <div id="calendar" class="h-full"></div>
                    </div>

                    <!-- Legend -->
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-wrap items-center justify-center gap-4 text-sm">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                <span>Pending</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                                <span>Confirmed</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                <span>Cancelled</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-gray-500 mr-2"></span>
                                <span>Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
             <div class="hidden debug-data">
                <pre>{{ $appointmentsJson }}</pre>
            </div>
            <div class="mt-6 bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Upcoming Appointments</h2>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($veterinarianProfile->appointments()->where('start_time', '>=', now())->orderBy('start_time')->take(5)->get() as $appointment)
                        <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <span class="text-blue-600 dark:text-blue-200 font-medium">
                                        {{ substr($appointment->pet->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $appointment->pet->name }}
                                        <span class="ml-2 px-2 py-0.5 text-xs font-medium rounded-full {{
                                            $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                                            ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200')
                                        }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $appointment->start_time->format('D, M j, Y \a\t g:i A') }}
                                    </div>
                                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $appointment->reason }}
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        View
                                    </a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No upcoming appointments
                        </li>
                        @endforelse
                    </ul>
                    @if($veterinarianProfile->appointments()->where('start_time', '>=', now())->count() > 5)
                    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 text-center">
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                            View all appointments
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="calendar-data"
         data-appointments='{{ $appointmentsJson }}'
         data-vet-id="{{ $veterinarianProfile->user_id }}"
         class="hidden">
    </div>
</div>

@push('styles')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tX/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <style>
        .fc {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .fc .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .fc .fc-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #374151;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        .fc .fc-button-primary:not(:disabled):hover {
            background-color: #e5e7eb;
            border-color: #d1d5db;
        }
        .fc-event {
            font-size: 0.75rem;
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            cursor: pointer;
            border: none;
        }
        .fc-daygrid-day-number {
            color: #4b5563;
            font-weight: 500;
        }
        .fc-day-today {
            background-color: #eff6ff !important;
        }
        .fc-day-today .fc-daygrid-day-number {
            color: #1d4ed8;
            font-weight: 700;
        }
        .fc-day-past .fc-daygrid-day-number {
            color: #9ca3af;
        }
        .fc-daygrid-event-harness {
            margin-bottom: 2px;
        }
        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(59, 130, 246, 0.1);
        }
        .fc-daygrid-day-top {
            padding: 4px 8px;
        }
        .fc-daygrid-day-events {
            min-height: 2.5rem;
        }
        /* Dark mode styles */
        .dark .fc {
            --fc-border-color: #374151;
            --fc-page-bg-color: #1f2937;
            --fc-neutral-bg-color: #1f2937;
            --fc-list-event-hover-bg-color: #374151;
            --fc-now-indicator-color: #3b82f6;
        }
        .dark .fc .fc-button {
            background-color: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }
        .dark .fc .fc-button:not(:disabled):hover {
            background-color: #4b5563;
            border-color: #6b7280;
        }
        .dark .fc .fc-button-primary:not(:disabled).fc-button-active,
        .dark .fc .fc-button-primary:not(:disabled):active {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        .dark .fc-daygrid-day-number {
            color: #e5e7eb;
        }
        .dark .fc-day-today {
            background-color: rgba(37, 99, 235, 0.2) !important;
        }
        .dark .fc-day-today .fc-daygrid-day-number {
            color: #60a5fa;
        }
        .dark .fc-day-past .fc-daygrid-day-number {
            color: #6b7280;
        }
        .dark .fc-col-header-cell {
            background-color: #1f2937;
        }
        .dark .fc-col-header-cell .fc-col-header-cell-cushion {
            color: #e5e7eb;
        }
        /* Fix for loading indicator */
        #calendar-loading {
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.5);
        }
        .dark #calendar-loading {
            background-color: rgba(17, 24, 39, 0.5);
        }
    </style>
@endpush

@push('scripts')
    <!-- SweetAlert2 for beautiful alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Moment.js for date handling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- FullCalendar Core Package -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <!-- FullCalendar Plugins -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the calendar
        initCalendar();

        // Handle dark mode changes
        const darkModeToggle = document.querySelector('*[x-data]');
        if (darkModeToggle) {
            const observer = new MutationObserver(() => {
                if (typeof calendar !== 'undefined') {
                    calendar.render();
                }
            });
            observer.observe(darkModeToggle, { attributes: true, attributeFilter: ['class'] });
        }
    });

    // Global calendar instance
    let calendar;

    function initCalendar() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        // Show loading indicator
        const loadingEl = document.getElementById('calendar-loading');
        if (loadingEl) {
            loadingEl.classList.remove('hidden');
            loadingEl.style.display = 'flex';
        }

        // Initialize the calendar with enhanced options
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 'auto',
            aspectRatio: 1.8,
            nowIndicator: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: 3,
            firstDay: 1, // Monday
            locale: '{{ app()->getLocale() }}',
            timeZone: '{{ config('app.timezone') }}',
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            events: {
                url: '/api/appointments',
                method: 'GET',
                extraParams: {
                    _token: '{{ csrf_token() }}',
                    veterinarian_id: '{{ $veterinarianProfile->user_id }}',
                    include: 'pet,pet.owner,veterinarian'
                },
                failure: function(error) {
                    console.error('Calendar event load error:', error);
                    const errorMessage = error.message || 'Failed to load appointments. Please try again later.';

                    // Show error toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                },
                loading: function(isLoading) {
                    const loadingEl = document.getElementById('calendar-loading');
                    if (loadingEl) {
                        loadingEl.style.display = isLoading ? 'flex' : 'none';
                    }
                }
            },
            eventDataTransform: function(eventData) {
                // Format the event for FullCalendar
                const event = {
                    id: eventData.id,
                    title: eventData.title || 'Appointment',
                    start: eventData.start_time || eventData.start,
                    end: eventData.end_time || eventData.end,
                    allDay: eventData.all_day || false,
                    extendedProps: {
                        status: eventData.status || 'scheduled',
                        pet: eventData.pet || {},
                        description: eventData.description || '',
                        reason: eventData.reason || '',
                        veterinarian: eventData.veterinarian || {}
                    },
                    className: `fc-event-${eventData.status || 'scheduled'}`,
                    backgroundColor: getStatusColor(eventData.status),
                    borderColor: getStatusColor(eventData.status, true),
                    textColor: '#ffffff'
                };

                // If we have pet data, include it in the title for better display
                if (eventData.pet && eventData.pet.name) {
                    event.title = `${event.title} - ${eventData.pet.name}`;
                }

                return event;
            },
            eventClick: function(info) {
                const event = info.event;
                const pet = event.extendedProps.pet;
                const eventEl = info.el;

                // Add pulse effect to clicked event
                eventEl.classList.add('animate-pulse');
                setTimeout(() => eventEl.classList.remove('animate-pulse'), 1000);

                // Create and show the modal
                Swal.fire({
                    title: event.title,
                    html: `
                        <div class="text-left">
                            ${pet ? `<p class="mb-2"><strong>Pet:</strong> ${pet.name}</p>` : ''}
                            <p class="mb-2"><strong>When:</strong> ${formatDateTimeRange(event.start, event.end, event.allDay)}</p>
                            ${event.extendedProps.reason ? `<p class="mb-2"><strong>Reason:</strong> ${event.extendedProps.reason}</p>` : ''}
                            ${event.extendedProps.description ? `<p class="mb-2"><strong>Notes:</strong> ${event.extendedProps.description}</p>` : ''}
                            <p class="mt-3"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusBadgeClass(event.extendedProps.status)}">
                                ${event.extendedProps.status.charAt(0).toUpperCase() + event.extendedProps.status.slice(1)}
                            </span></p>
                        </div>
                    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'View Details',
                    cancelButtonText: 'Close',
                    showDenyButton: true,
                    denyButtonText: 'Cancel Appointment',
                    customClass: {
                        confirmButton: 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500',
                        cancelButton: 'inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500',
                        denyButton: 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/appointments/${event.id}`;
                    } else if (result.isDenied) {
                        // Handle cancel appointment
                        cancelAppointment(event.id);
                    }
                });

                info.jsEvent.preventDefault();
            },
            dateClick: function(info) {
                // Handle date click to create a new appointment
                window.location.href = `{{ route('appointments.create', ['veterinarianProfile' => $veterinarianProfile->id]) }}?date=${info.dateStr}`;
            },
            loading: function(isLoading) {
                const loadingEl = document.getElementById('calendar-loading');
                if (loadingEl) {
                    loadingEl.style.display = isLoading ? 'flex' : 'none';
                }
            },
            eventDidMount: function(info) {
                const event = info.event;
                const eventEl = info.el;

                // Add status-based classes
                eventEl.classList.add('cursor-pointer', 'transition-all', 'duration-200', 'hover:shadow-md');

                // Add tooltip with more details
                if (window.tippy) {
                    const pet = event.extendedProps.pet || {};
                    const timeText = info.timeText ? `${info.timeText} • ` : '';
                    const petText = pet.name ? `\nPet: ${pet.name}` : '';
                    const statusText = `\nStatus: ${event.extendedProps.status.charAt(0).toUpperCase() + event.extendedProps.status.slice(1)}`;

                    tippy(info.el, {
                        content: `${timeText}${event.title}${petText}${statusText}`,
                        theme: 'light',
                        placement: 'top',
                        animation: 'scale',
                        arrow: true,
                        delay: [100, 0],
                        duration: [200, 0],
                        interactive: true,
                        allowHTML: true
                    });
                }
            }
        });

        // Render the calendar
        calendar.render();

        // Hide loading indicator after render
        if (loadingEl) loadingEl.classList.add('hidden');
    }

    function formatDateTimeRange(start, end, allDay = false) {
        const startDate = moment(start);
        const endDate = moment(end);

        if (allDay) {
            if (startDate.isSame(endDate, 'day') || !endDate.isValid()) {
                return startDate.format('MMM D, YYYY (All Day)');
            } else {
                return `${startDate.format('MMM D')} - ${endDate.subtract(1, 'day').format('MMM D, YYYY')}`;
            }
        }

        if (startDate.isSame(endDate, 'day')) {
            return `${startDate.format('MMM D, YYYY')} • ${startDate.format('h:mm A')} - ${endDate.format('h:mm A')}`;
        } else {
            return `${startDate.format('MMM D, h:mm A')} - ${endDate.format('MMM D, h:mm A YYYY')}`;
        }
    }

    function getStatusColor(status, isBorder = false) {
        const colors = {
            'confirmed': isBorder ? '#059669' : '#10B981',
            'pending': isBorder ? '#D97706' : '#F59E0B',
            'cancelled': isBorder ? '#DC2626' : '#EF4444',
            'completed': isBorder ? '#4B5563' : '#6B7280'
        };
        return colors[status] || (isBorder ? '#3B82F6' : '#60A5FA');
    }

    function getStatusBadgeClass(status) {
        const classes = {
            'confirmed': 'bg-green-100 text-green-800',
            'pending': 'bg-yellow-100 text-yellow-800',
            'cancelled': 'bg-red-100 text-red-800',
            'completed': 'bg-gray-100 text-gray-800'
        };
        return classes[status] || 'bg-blue-100 text-blue-800';
    }

    function cancelAppointment(appointmentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, keep it',
            reverseButtons: true,
            customClass: {
                confirmButton: 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500',
                cancelButton: 'inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-3',
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Send request to cancel appointment
                fetch(`/api/appointments/${appointmentId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh the calendar
                        if (calendar) {
                            calendar.refetchEvents();
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelled!',
                            text: 'The appointment has been cancelled.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        throw new Error(data.message || 'Failed to cancel appointment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Failed to cancel appointment',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            }
        });
    }
</script>
@endpush
