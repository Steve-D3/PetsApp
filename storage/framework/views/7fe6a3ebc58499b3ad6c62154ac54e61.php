<div>
    <!-- Header -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm rounded-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 rounded-lg bg-indigo-100 dark:bg-indigo-900/50">
                            <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h1
                                class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400 sm:text-3xl">
                                Welcome back, <?php echo e(auth()->user()->name); ?>

                            </h1>
                            <div class="mt-1 flex flex-wrap items-center space-x-4 text-sm">
                                <span class="inline-flex items-center text-gray-500 dark:text-gray-400">
                                    <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Member since <?php echo e(auth()->user()->created_at->format('M Y')); ?>

                                </span>
                                <span class="inline-flex items-center text-gray-500 dark:text-gray-400">
                                    <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo e(now()->format('l, F j, Y')); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    <div
                        class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/50 dark:bg-gray-800/50 shadow-sm">
                        <div class="p-2 rounded-full bg-indigo-100 dark:bg-indigo-900/50 mr-3">
                            <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Appointments</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                <!--[if BLOCK]><![endif]--><?php if(isset($clinicStats)): ?>
                                    <?php echo e($clinicStats['total_appointments']); ?>

                                <?php else: ?>
                                    0
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mt-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Today's Appointments -->
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 mr-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Today's Appointments</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e($appointmentStats['today']); ?>

                        </p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">This Week</span>
                        <span
                            class="font-medium text-gray-900 dark:text-white"><?php echo e($appointmentStats['this_week']); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm mt-2">
                        <span class="text-gray-500 dark:text-gray-400">Pending</span>
                        <span
                            class="font-medium text-yellow-600 dark:text-yellow-400"><?php echo e($appointmentStats['pending']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Patient Statistics -->
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div
                        class="p-3 rounded-lg bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 mr-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Patients</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            <?php echo e($patientStats['total'] ?? 0); ?>

                        </p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">New This Month</span>
                        <span
                            class="font-medium text-gray-900 dark:text-white"><?php echo e($patientStats['new_this_month'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm mt-2">
                        <span class="text-gray-500 dark:text-gray-400">Returning</span>
                        <span
                            class="font-medium text-green-600 dark:text-green-400"><?php echo e($patientStats['returning'] ?? 0); ?></span>
                    </div>
                </div>
            </div>

            <!-- Pending Tasks -->
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div
                        class="p-3 rounded-lg bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 mr-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Tasks</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            <?php echo e(is_array($pendingTasks) ? count($pendingTasks) : ($pendingTasks ?? 0)); ?>

                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <?php
                            $taskCount = is_array($pendingTasks) ? count($pendingTasks) : ($pendingTasks ?? 0);
                            $progress = min(($taskCount / max(($taskCount + 5), 1)) * 100, 100);
                        ?>
                        <div class="bg-amber-500 h-2.5 rounded-full" style="width: <?php echo e($progress); ?>%"></div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        <?php echo e($taskCount); ?> task<?php echo e($taskCount != 1 ? 's' : ''); ?> pending completion
                    </p>
                </div>
            </div>

            <!-- Patient Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Patients</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">New This Month</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-green-600 dark:text-green-400"><?php echo e($patientStats['new_this_month']); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Returning</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-purple-600 dark:text-purple-400"><?php echo e($patientStats['returning']); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Total Patients</span>
                        </div>
                        <span
                            class="text-lg font-semibold text-indigo-600 dark:text-indigo-400"><?php echo e($patientStats['total']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks & Reminders Card -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div
                            class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 mr-3">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tasks & Reminders</h3>
                    </div>
                    <button type="button"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <span class="sr-only">Add new task</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        <?php echo e(count($pendingTasks)); ?> Pending
                    </span>
                </div>
                <div class="space-y-4">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pendingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <div
                                    class="h-5 w-5 rounded-full flex items-center justify-center <?php echo e($task['priority'] === 'high' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600'); ?>">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($task['title']); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Due: <?php echo e($task['due']->diffForHumans()); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No pending tasks</p>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="mt-4">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800">
                        View All Tasks
                    </button>
                </div>
            </div>

            <!-- Vaccination Alerts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Vaccination Alerts</h3>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        <?php echo e($vaccineStats['due_soon']); ?> Due Soon
                    </span>
                </div>
                <!--[if BLOCK]><![endif]--><?php if($vaccineStats['due_soon'] > 0): ?>
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 002 0V9a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Vaccinations Due Soon
                                </h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p><?php echo e($vaccineStats['due_soon']); ?> pets have vaccinations due in the next 30 days.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-yellow-600 h-2.5 rounded-full"
                                            style="width: <?php echo e(min(($vaccineStats['due_soon'] / max($patientStats['total'], 1)) * 100, 100)); ?>%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vaccinations due soon</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">All pets are up to date with their
                            vaccinations.</p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="mt-4">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        View Vaccination Schedule
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Medical Records -->
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 overflow-hidden mb-8 transition-all duration-300 hover:shadow-md">
            <div
                class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Medical Records</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Recently updated patient medical records and
                        health information</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button @click="$wire.toggleFilters()"
                        class="inline-flex items-center px-3.5 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 bg-white/50 dark:bg-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-600/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filters
                    </button>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\MedicalRecord::class)): ?>
                        <a href="<?php echo e(route('medical-records.create')); ?>"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="mr-2 -ml-0.5 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Record
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Filter Panel -->
            <!--[if BLOCK]><![endif]--><?php if($showFilters): ?>
                <div
                    class="bg-gray-200 dark:bg-gray-700/50 px-6 py-4 border-b border-gray-100 dark:border-gray-600 backdrop-blur-sm">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="petFilter"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                Filter by Pet
                            </label>
                            <select wire:model.live="petFilter" id="petFilter"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <option value="">All Pets</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availablePets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pet->id); ?>"><?php echo e($pet->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div>
                            <label for="dateFrom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                From Date
                            </label>
                            <input type="date" wire:model.live="dateFrom" id="dateFrom"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        <div>
                            <label for="dateTo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                To Date
                            </label>
                            <input type="date" wire:model.live="dateTo" id="dateTo"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        <div class="flex items-end space-x-2">
                            <button wire:click="applyFilters"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Apply Filters
                            </button>
                            <button wire:click="resetFilters"
                                class="inline-flex items-center px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 bg-white/50 dark:bg-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-600/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!-- Records List -->
            <div class="overflow-hidden">
                <!--[if BLOCK]><![endif]--><?php if($recentMedicalRecords->count() > 0): ?>
                    <ul class="divide-y divide-gray-100 dark:divide-gray-700/50">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $recentMedicalRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="group hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                                <a href="<?php echo e(route('medical-records.show', ['pet' => $record->pet_id, 'record' => $record->id])); ?>"
                                    class="block px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4 min-w-0">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-xl bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-800/70 transition-colors">
                                                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center space-x-2">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        <?php echo e($record->title); ?>

                                                    </p>
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                        <?php echo e(ucfirst($record->record_type)); ?>

                                                    </span>
                                                </div>
                                                <div class="flex items-center mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="truncate"><?php echo e($record->pet->name); ?></span>
                                                    <span class="mx-1">•</span>
                                                    <span class="capitalize"><?php echo e($record->pet->species); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-shrink-0 flex flex-col items-end">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                <?php echo e($record->record_date->format('M d, Y')); ?>

                                            </span>
                                            <span class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                                <?php echo e($record->record_date->diffForHumans()); ?>

                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                <?php else: ?>
                    <div class="text-center py-12 px-6">
                        <div
                            class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800/50 mb-3">
                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">No medical records found</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                            <!--[if BLOCK]><![endif]--><?php if($petFilter || $dateFrom || $dateTo): ?>
                                Try adjusting your filters or clear them to see all records.
                            <?php else: ?>
                                No medical records have been added yet.
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </p>
                        <!--[if BLOCK]><![endif]--><?php if(auth()->user()->can('create', \App\Models\MedicalRecord::class)): ?>
                            <div class="mt-6">
                                <a href="<?php echo e(route('medical-records.create')); ?>"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add New Record
                                </a>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>


        </div>

        <!-- Upcoming Appointments -->
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 overflow-hidden mb-8 transition-all duration-300 hover:shadow-md">
            <div
                class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Upcoming Appointments</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Your scheduled appointments for the next few
                        days</p>
                </div>
                <a href="<?php echo e(route('vet.appointments.calendar', ['veterinarian_profile_id' => $vetProfileId] ?? '')); ?>"
                    class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200 group">
                    View Calendar
                    <svg class="ml-1.5 h-4 w-4 transform transition-transform group-hover:translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-hidden">
                <!--[if BLOCK]><![endif]--><?php if($upcomingAppointments->count() > 0): ?>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $upcomingAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <a href="<?php echo e(route('admin.appointments.show', $appointment->id)); ?>"
                                    class="block px-4 py-4 sm:px-6">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="flex items-center space-x-2">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        <?php echo e($appointment->pet->name); ?>

                                                        <span class="text-gray-500 dark:text-gray-400 font-normal">•
                                                            <?php echo e($appointment->pet->species); ?></span>
                                                    </p>
                                                    <!--[if BLOCK]><![endif]--><?php if($appointment->status === 'confirmed'): ?>
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                            Confirmed
                                                        </span>
                                                    <?php elseif($appointment->status === 'pending'): ?>
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                                            Pending
                                                        </span>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-4">
                                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <?php echo e($appointment->pet->owner->name); ?>

                                                    </div>
                                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                        <?php echo e($appointment->pet->owner->email); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:mt-0 sm:ml-4 sm:flex-shrink-0">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                <?php echo e($appointment->start_time->format('M j, Y')); ?>

                                            </div>
                                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($appointment->start_time->format('g:i A')); ?>

                                                <!--[if BLOCK]><![endif]--><?php if($appointment->end_time): ?>
                                                    <span class="mx-1">-</span>
                                                    <?php echo e($appointment->end_time->format('g:i A')); ?>

                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                <?php else: ?>
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No upcoming appointments</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Get started by
                            <a href="#"
                                class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">scheduling
                                a new appointment
                            </a>.
                        </p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/vet-dashboard.blade.php ENDPATH**/ ?>