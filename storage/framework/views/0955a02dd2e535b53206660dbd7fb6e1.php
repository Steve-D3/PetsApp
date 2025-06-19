<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                            <?php echo e($veterinarianProfile->user->name); ?>

                        </h1>
                        <span
                            class="ml-3 px-3 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            <?php echo e($veterinarianProfile->specialty ?? 'Veterinarian'); ?>

                        </span>
                    </div>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Member since <?php echo e($veterinarianProfile->created_at->format('M Y')); ?>

                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path
                                    d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                            <?php echo e($veterinarianProfile->appointments()->count()); ?> appointments
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                    <a href="mailto:<?php echo e($veterinarianProfile->user->email); ?>"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        Email
                    </a>
                    <a href="tel:<?php echo e($veterinarianProfile->phone_number); ?>"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
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
                                <div
                                    class="h-24 w-24 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-200 text-2xl font-bold">
                                    <?php echo e(substr($veterinarianProfile->user->name, 0, 1)); ?>

                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    <?php echo e($veterinarianProfile->user->name); ?></h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo e($veterinarianProfile->specialty ?? 'Veterinarian'); ?></p>
                            </div>
                        </div>
                        <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <dl class="space-y-4">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        <a href="mailto:<?php echo e($veterinarianProfile->user->email); ?>"
                                            class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                            <?php echo e($veterinarianProfile->user->email); ?>

                                        </a>
                                    </dd>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($veterinarianProfile->phone_number): ?>
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                            <a href="tel:<?php echo e($veterinarianProfile->phone_number); ?>"
                                                class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                                <?php echo e($veterinarianProfile->phone_number); ?>

                                            </a>
                                        </dd>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <!--[if BLOCK]><![endif]--><?php if($veterinarianProfile->bio): ?>
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bio</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                            <?php echo e($veterinarianProfile->bio); ?>

                                        </dd>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Clinic Info -->
                <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                    <div class="px-4 py-5 sm:p-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Clinic Information</h2>
                        <div class="mt-6">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white">
                                <?php echo e($veterinarianProfile->clinic->name); ?></h3>
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                <p><?php echo e($veterinarianProfile->clinic->address); ?></p>
                                <p><?php echo e($veterinarianProfile->clinic->postal_code); ?>

                                    <?php echo e($veterinarianProfile->clinic->city); ?></p>
                                <p><?php echo e($veterinarianProfile->clinic->country); ?></p>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if($veterinarianProfile->clinic->website): ?>
                                <div class="mt-4">
                                    <a href="<?php echo e($veterinarianProfile->clinic->website); ?>" target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                        <?php echo e(parse_url($veterinarianProfile->clinic->website, PHP_URL_HOST)); ?>

                                    </a>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column - Calendar -->
            <div class="lg:col-span-2">
                <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                    <div
                        class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Appointment Calendar</h2>
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('appointments.create', ['veterinarianProfile' => $veterinarianProfile->id])); ?>"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                New Appointment
                            </a>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Today's
                                            Appointments</p>
                                        <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($veterinarianProfile->appointments()->whereDate('start_time', today())->count()); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                            Confirmed</p>
                                        <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($veterinarianProfile->appointments()->where('status', 'confirmed')->count()); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pending
                                        </p>
                                        <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($veterinarianProfile->appointments()->where('status', 'pending')->count()); ?>

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
                            <div id="calendar-loading"
                                class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 z-10 opacity-0 pointer-events-none transition-opacity duration-200">
                                <div class="flex items-center justify-center h-full">
                                    <div
                                        class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500">
                                    </div>
                                </div>
                            </div>
                            <!-- Calendar container -->
                            <div id="calendar" class="h-full"></div>
                        </div>

                        <!-- Legend -->
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 text-white">
                            <div class="flex flex-wrap items-center justify-center gap-4 text-sm">
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></span>
                                    <span>Pending</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                    <span>Confirmed</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                    <span>Cancelled</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                                    <span>Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="mt-6 bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Upcoming Appointments</h2>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $veterinarianProfile->appointments()->where('start_time', '>=', now())->orderBy('start_time')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                                <span class="text-blue-600 dark:text-blue-200 font-medium">
                                                                    <?php echo e(substr($appointment->pet->name, 0, 1)); ?>

                                                                </span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                    <?php echo e($appointment->pet->name); ?>

                                                                    <span class="ml-2 px-2 py-0.5 text-xs font-medium rounded-full <?php echo e(match ($appointment->status) {
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    default => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'
                                }); ?>">
                                                                        <?php echo e(ucfirst($appointment->status)); ?>

                                                                    </span>
                                                                </div>
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    <?php echo e($appointment->start_time->format('D, M j, Y \a\t g:i A')); ?>

                                                                </div>
                                                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                                    <?php echo e($appointment->reason); ?>

                                                                </div>
                                                            </div>
                                                            <div class="ml-auto">
                                                                <a href="<?php echo e(route('admin.appointments.show', $appointment)); ?>"
                                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                                                    View
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No upcoming appointments
                                </li>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                        <!--[if BLOCK]><![endif]--><?php if($veterinarianProfile->appointments()->where('start_time', '>=', now())->count() > 5): ?>
                            <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 text-center">
                                <a href="#"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                    View all appointments
                                </a>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        </div>

        <div id="calendar-data" data-appointments='<?php echo e($appointmentsJson); ?>'
            data-vet-id="<?php echo e($veterinarianProfile->user_id); ?>" class="hidden">
        </div>


        <?php $__env->startPush('styles'); ?>
                <!-- FullCalendar CSS -->
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

                <!-- Leaflet CSS -->
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tX/miZyoHS5obTRR9BMY=" crossorigin="" />

                <!-- <style>
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
            </style> -->


        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('scripts'); ?>

            <!-- SweetAlert2 for beautiful alerts -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Moment.js for date handling -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>

            <!-- FullCalendar Core -->
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/index.global.min.js"></script>

            <!-- Tippy.js for tooltips -->
            <script src="https://unpkg.com/@popperjs/core@2"></script>
            <script src="https://unpkg.com/tippy.js@6"></script>

            <script>
                let calendar = null;

                function initCalendar() {
                    const calendarEl = document.getElementById('calendar');
                    const calendarDataEl = document.getElementById('calendar-data');

                    if (!calendarEl || !calendarDataEl) return;

                    const appointments = JSON.parse(calendarDataEl.dataset.appointments);
                    const vetId = calendarDataEl.dataset.vetId;

                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: appointments,
                        nowIndicator: true,
                        timeZone: 'local',
                        firstDay: 1,
                        dayMaxEvents: 3,
                        eventDisplay: 'block',
                        eventTimeFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: false,
                            hour12: false
                        },
                        eventDidMount: function (info) {
                            const event = info.event;
                            const eventEl = info.el;

                            // Add status-based classes
                            eventEl.classList.add('cursor-pointer', 'transition-all', 'duration-200', 'hover:shadow-md');

                            // Add tooltip with more details
                            if (window.tippy) {
                                tippy(eventEl, {
                                    content: `
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-[400px] px-12">
                                        <div class="space-y-3 space-x-3 gap-4">
                                            <div class="flex items-center gap-3">
                                                <span class="text-gray-400">🐾</span>
                                                <span class="font-medium">${event.extendedProps.pet || 'N/A'}</span>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <span class="text-gray-400">👤</span>
                                                <span class="font-medium">${event.extendedProps.owner_name || 'N/A'}</span>
                                            </div>
                                            ${event.extendedProps.notes ? `
                                                <div class="flex items-center gap-3">
                                                    <span class="text-gray-400">📝</span>
                                                    <span class="text-sm text-gray-600 dark:text-gray-300">${event.extendedProps.notes}</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="text-gray-400">📅</span>
                                                    <span class="text-sm text-gray-600 dark:text-gray-300">${event.extendedProps.status}</span>
                                                </div>
                                            ` : ''}
                                        </div>
                                    </div>`,
                                    placement: 'top',
                                    arrow: true,
                                    theme: 'light',
                                    interactive: true,
                                    allowHTML: true
                                });
                            }
                        },
                        eventClick: function (info) {
                            const event = info.event;
                            const props = event.extendedProps;
                            const eventDetails = `
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">${event.title}</h3>
                                <p><strong>Status:</strong> <span class="capitalize">${event.extendedProps.status || 'scheduled'}</span></p>
                                <p><strong>Date:</strong> ${event.start?.toLocaleString()}</p>
                                ${props.pet_name ? `<p><strong>Pet:</strong> ${props.pet_name}</p>` : ''}
                                ${props.owner_name ? `<p><strong>Owner:</strong> ${props.owner_name}</p>` : ''}
                                ${props.notes ? `<p class="mt-2"><strong>Notes:</strong> ${props.notes}</p>` : ''}
                            </div>
                        `;

                            Swal.fire({
                                html: eventDetails,
                                showCancelButton: true,
                                confirmButtonText: 'Edit',
                                cancelButtonText: 'Close',
                                showDenyButton: true,
                                denyButtonText: 'Cancel Appointment',
                                confirmButtonColor: '#3b82f6',
                                cancelButtonColor: '#6b7280',
                                denyButtonColor: '#ef4444',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = `/appointments/${event.id}`;
                                } else if (result.isDenied) {
                                    cancelAppointment(event.id);
                                }
                            });

                            info.jsEvent.preventDefault();
                        },
                        dateClick: function (info) {
                            // Only allow future dates
                            const clickedDate = new Date(info.date);
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);

                            if (clickedDate >= today) {
                                window.location.href = `<?php echo e(route('appointments.create', ['veterinarianProfile' => $veterinarianProfile->id])); ?>?date=${info.dateStr}`;
                                window.Livewire.emit('openAppointmentForm', info.dateStr);

                                console.log(info.dateStr);
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Invalid Date',
                                    text: 'Please select a current or future date.',
                                    confirmButtonColor: '#3b82f6',
                                });
                            }
                        },
                        loading: function (isLoading) {
                            const loadingEl = document.getElementById('calendar-loading');
                            if (loadingEl) {
                                loadingEl.style.opacity = isLoading ? '1' : '0';
                                loadingEl.style.pointerEvents = isLoading ? 'auto' : 'none';
                            }
                        }
                    });

                    // Render the calendar
                    calendar.render();
                }

                function getStatusClasses(status) {
                    switch (status?.toLowerCase()) {
                        case 'confirmed':
                            return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                        case 'cancelled':
                            return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                        case 'completed':
                            return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                        default:
                            return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
                    }
                }

                function cancelAppointment(appointmentId) {
                    Swal.fire({
                        title: 'Cancel Appointment',
                        text: 'Are you sure you want to cancel this appointment?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3b82f6',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, cancel it',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/api/appointments/${appointmentId}/cancel`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            }).then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Cancelled!',
                                        'The appointment has been cancelled.',
                                        'success'
                                    );
                                    // Refresh the calendar
                                    window.Livewire.emit('refreshCalendar');
                                } else {
                                    throw new Error(data.message || 'Failed to cancel appointment');
                                }
                            }).catch(error => {
                                Swal.fire(
                                    'Error',
                                    error.message,
                                    'error'
                                );
                            });
                        }
                    });
                }

                // Initialize the calendar when Livewire is ready
                if (window.Livewire) {
                    initCalendar();
                }

                // Also listen for Livewire's load event
                window.addEventListener('livewire:load', () => {
                    initCalendar();
                });

                // Fallback to DOMContentLoaded as a last resort
                document.addEventListener('DOMContentLoaded', () => {
                    if (window.Livewire) {
                        initCalendar();
                    }
                });
            </script>
        <?php $__env->stopPush(); ?>

    </div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/vet-show.blade.php ENDPATH**/ ?>