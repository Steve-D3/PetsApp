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
                    <div class="flex items-center space-x-2">
                        <button type="button"
                            wire:click="$toggle('showAddTaskForm')"
                            class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200"
                            title="Add new task">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e(count($pendingTasks) > 0 ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'); ?>">
                            <?php echo e(count($pendingTasks)); ?> <?php echo e(Str::plural('Task', count($pendingTasks))); ?>

                        </span>
                    </div>
                </div>

                <!-- Add Task Form -->
                <!--[if BLOCK]><![endif]--><?php if($showAddTaskForm): ?>
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Add New Task</h4>
                        <form wire:submit.prevent="addTask">
                            <div class="space-y-3">
                                <div>
                                    <label for="taskTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                    <input type="text" id="taskTitle" wire:model="newTask.title"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Task title" required>
                                </div>
                                <div>
                                    <label for="taskDue" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Due Date</label>
                                    <input type="datetime-local" id="taskDue" wire:model="newTask.due"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required>
                                </div>
                                <div>
                                    <label for="taskPriority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priority</label>
                                    <select id="taskPriority" wire:model="newTask.priority"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="taskDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                                    <textarea id="taskDescription" wire:model="newTask.description" rows="2"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Task details"></textarea>
                                </div>
                                <div class="flex justify-end space-x-3 pt-2">
                                    <button type="button"
                                        wire:click="$set('showAddTaskForm', false)"
                                        class="px-3 py-1.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-3 py-1.5 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div class="space-y-4 max-h-96 overflow-y-auto pr-2 -mr-2">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pendingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="group flex items-start p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                            <button type="button"
                                wire:click="toggleTaskCompletion(<?php echo e($task->id); ?>)"
                                class="flex-shrink-0 mt-0.5 flex items-center justify-center h-5 w-5 rounded-full border-2 <?php echo e($task->completed ? 'bg-green-100 border-green-500 text-green-600 dark:bg-green-900/50 dark:border-green-500 dark:text-green-400' : 'border-gray-300 dark:border-gray-500'); ?>"
                                title="<?php echo e($task->completed ? 'Mark as incomplete' : 'Mark as complete'); ?>">
                                <!--[if BLOCK]><![endif]--><?php if($task->completed): ?>
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </button>
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <p class="text-sm font-medium <?php echo e($task->completed ? 'text-gray-500 dark:text-gray-400 line-through' : 'text-gray-900 dark:text-white'); ?>">
                                        <?php echo e($task->title); ?>

                                    </p>
                                    <div class="flex items-center space-x-2">
                                        <!--[if BLOCK]><![endif]--><?php if($task->priority === 'high'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                                High
                                            </span>
                                        <?php elseif($task->priority === 'medium'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                                Medium
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                                Low
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <button type="button"
                                            wire:click="deleteTask(<?php echo e($task->id); ?>)"
                                            class="text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 transition-colors duration-200"
                                            title="Delete task">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($task->description): ?>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                        <?php echo e($task->description); ?>

                                    </p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <div class="mt-1.5 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="<?php echo e($task->due->isToday() ? 'font-medium text-amber-600 dark:text-amber-400' : ''); ?>">
                                        <?php echo e($task->due->isToday() ? 'Today' : $task->due->format('M j, Y')); ?> • <?php echo e($task->due->format('g:i A')); ?>

                                    </span>
                                    <!--[if BLOCK]><![endif]--><?php if(!$task->due->isFuture()): ?>
                                        <span class="ml-2 px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                            <?php echo e($task->due->isToday() ? 'Due today' : ($task->due->isPast() ? 'Overdue' : '')); ?>

                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-6">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No tasks</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new task.</p>
                            <div class="mt-4">
                                <button type="button"
                                    wire:click="$set('showAddTaskForm', true)"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    New Task
                                </button>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!--[if BLOCK]><![endif]--><?php if(count($pendingTasks) > 0): ?>
                    <div class="mt-4 flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4">
                        <button type="button"
                            wire:click="$set('showAllTasksModal', true)"
                            class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200">
                            View all tasks
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            <?php echo e(count(array_filter($pendingTasks, fn($t) => $t->completed))); ?> of <?php echo e(count($pendingTasks)); ?> completed
                        </span>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Vaccination Alerts -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 dark:border-gray-700/50 p-6 hover:shadow-md transition-shadow duration-300 h-full flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 mr-3">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Vaccination Alerts</h3>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($vaccineStats['due_soon'] > 0): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200">
                            <?php echo e($vaccineStats['due_soon']); ?> <?php echo e(Str::plural('Due', $vaccineStats['due_soon'])); ?>

                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="flex-1">
                    <!--[if BLOCK]><![endif]--><?php if($vaccineStats['due_soon'] > 0): ?>
                        <div class="space-y-4">
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 border border-yellow-100 dark:border-yellow-900/30">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-4a1 1 0 00-1 1v3a1 1 0 002 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                            <?php echo e($vaccineStats['due_soon']); ?> <?php echo e(Str::plural('Vaccination', $vaccineStats['due_soon'])); ?> Due
                                        </h3>
                                        <p class="mt-1 text-xs text-yellow-700/90 dark:text-yellow-300/90">
                                            Due or overdue for <?php echo e(count($vaccineStats['due_vaccinations'])); ?> <?php echo e(Str::plural('pet', count($vaccineStats['due_vaccinations']))); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flow-root max-h-64 overflow-y-auto pr-2 -mr-2">
                                <ul role="list" class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $vaccineStats['due_vaccinations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $petVaccinations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="py-3 first:pt-0 last:pb-0">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mt-1">
                                                    <span class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-indigo-100/70 dark:bg-indigo-900/30">
                                                        <span class="text-sm font-medium text-indigo-600 dark:text-indigo-300">
                                                            <?php echo e(substr($petVaccinations['pet_name'], 0, 1)); ?>

                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="ml-3 flex-1 min-w-0">
                                                    <div class="flex justify-between items-start">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                            <?php echo e($petVaccinations['pet_name']); ?>

                                                        </p>
                                                        <a href="<?php echo e(route('admin.pets.show', $petVaccinations['pet_id'])); ?>"
                                                           class="ml-2 flex-shrink-0 text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-150">
                                                            View
                                                        </a>
                                                    </div>
                                                    <div class="mt-1 space-y-1.5">
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $petVaccinations['vaccinations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="flex flex-wrap items-center gap-1.5">
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium whitespace-nowrap <?php echo e($vax['is_overdue'] ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200'); ?>">
                                                                    <?php echo e($vax['name']); ?>

                                                                </span>
                                                                <span class="text-xs <?php echo e($vax['is_overdue'] ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400'); ?> whitespace-nowrap">
                                                                    <?php echo e($vax['is_overdue'] ? 'Overdue' : 'Due'); ?> <?php echo e($vax['due_date']); ?>

                                                                    <!--[if BLOCK]><![endif]--><?php if(!$vax['is_overdue']): ?>
                                                                        <span class="text-gray-500 dark:text-gray-400">(in <?php echo e($vax['days_until_due']); ?>d)</span>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                                </span>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="h-full flex flex-col items-center justify-center py-6 px-4 text-center">
                            <div class="p-3 rounded-full bg-green-100/80 dark:bg-green-900/30 text-green-600 dark:text-green-400 mb-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">No vaccinations due soon</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 max-w-xs">All pets are up to date with their vaccinations.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200/50 dark:border-gray-700/50">
                    <a href="<?php echo e(route('vet.patients.index')); ?>"
                       class="w-full inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        View All Vaccinations
                    </a>
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

        <!-- All Tasks Modal -->
        <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showAllTasksModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showAllTasksModal']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-amber-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span>All Tasks & Reminders</span>
                </div>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <div class="space-y-4">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pendingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex-shrink-0 pt-0.5">
                                <div class="h-5 w-5 rounded-full flex items-center justify-center <?php echo e($task->priority === 'high' ? 'bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400' : 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/50 dark:text-yellow-400'); ?>">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($task->title); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Due <?php echo e($task->due->diffForHumans()); ?>

                                    <!--[if BLOCK]><![endif]--><?php if($task->priority === 'high'): ?>
                                        <span class="ml-2 inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                            High Priority
                                        </span>
                                    <?php else: ?>
                                        <span class="ml-2 inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                            Medium Priority
                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </p>
                            </div>
                            <button type="button" class="ml-2 text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No tasks</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You don't have any tasks or reminders yet.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <button type="button" wire:click="$set('showAllTasksModal', false)" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:focus:ring-indigo-600">
                    Close
                </button>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
    </div>
</div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/vet-dashboard.blade.php ENDPATH**/ ?>