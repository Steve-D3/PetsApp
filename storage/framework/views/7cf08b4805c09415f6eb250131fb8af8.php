<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Welcome back! Here's what's happening with your clinic.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Appointments Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Appointments</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(number_format(\App\Models\Appointment::count())); ?></p>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400"><span class="text-green-500 font-medium">+12%</span> from last month</p>
                    </div>
                </div>
            </div>

            <!-- Vets Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Veterinarians</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(number_format(\App\Models\User::where('role', 'vet')->count())); ?></p>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 rounded-full" style="width: 45%"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400"><span class="text-green-500 font-medium">+8%</span> from last month</p>
                    </div>
                </div>
            </div>

            <!-- Clients Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Clients</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(number_format(\App\Models\User::where('role', 'owner')->count())); ?></p>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-purple-500 rounded-full" style="width: 72%"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400"><span class="text-green-500 font-medium">+15%</span> from last month</p>
                    </div>
                </div>
            </div>

            <!-- Pets Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pets</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(number_format(\App\Models\Pet::count())); ?></p>
                        </div>
                        <div class="p-3 rounded-lg bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: 85%"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400"><span class="text-green-500 font-medium">+22%</span> from last month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Appointments -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Appointments</h2>
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => '$toggle(\'showAllAppointments\')','class' => 'bg-blue-600 hover:bg-blue-700 text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showAllAppointments\')','class' => 'bg-blue-600 hover:bg-blue-700 text-white']); ?>
                            View All
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    </div>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <?php
                        $recentAppointments = \App\Models\Appointment::with(['pet', 'veterinarian'])
                            ->orderBy('start_time', 'desc')
                            ->take(5)
                            ->get()
                            ->each(function($appointment) {
                                if ($appointment->start_time) {
                                    $appointment->start_time = \Carbon\Carbon::parse($appointment->start_time);
                                }
                                if ($appointment->end_time) {
                                    $appointment->end_time = \Carbon\Carbon::parse($appointment->end_time);
                                }
                                return $appointment;
                            });
                    ?>
                    <!--[if BLOCK]><![endif]--><?php if($recentAppointments->count() > 0): ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $recentAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            <?php echo e($appointment->pet->name ?? 'Pet'); ?> - <?php echo e($appointment->veterinarian->name ?? 'Vet'); ?>

                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php
                                                $startTime = $appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time) : null;
                                                $endTime = $appointment->end_time ? \Carbon\Carbon::parse($appointment->end_time) : null;
                                            ?>
                                            <?php echo e($startTime ? $startTime->format('M d, Y \a\t H:i') : 'No date/time set'); ?>

                                            <!--[if BLOCK]><![endif]--><?php if($endTime): ?>
                                                <br>to <?php echo e($endTime->format('H:i')); ?>

                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </p>
                                    </div>
                                    <div class="ml-4">
                                        <span class="px-2 py-1 text-xs rounded-full
                                        <?php if($appointment->status === 'confirmed'): ?> bg-blue-900/50 text-blue-400
                                        <?php elseif($appointment->status === 'completed'): ?> bg-green-900/30 text-green-400
                                        <?php elseif($appointment->status === 'cancelled'): ?> bg-red-900/30 text-red-400
                                        <?php elseif($appointment->status === 'pending'): ?> bg-yellow-900/30 text-yellow-400
                                        <?php else: ?> <?php endif; ?>">
                                            <?php echo e(ucfirst($appointment->status)); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                        <div class="p-6 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No recent appointments found.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <!-- Recent Clients -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Clients</h2>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <?php
                        $recentClients = \App\Models\User::where('role', 'owner')
                            ->withCount('pets')
                            ->latest()
                            ->take(5)
                            ->get();
                    ?>
                    <!--[if BLOCK]><![endif]--><?php if($recentClients->count() > 0): ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $recentClients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 font-medium">
                                        <?php echo e(substr($client->name, 0, 1)); ?>

                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            <?php echo e($client->name); ?>

                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php echo e($client->pets_count); ?> <?php echo e(Str::plural('pet', $client->pets_count)); ?>

                                        </p>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            <?php echo e($client->created_at->diffForHumans()); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                        <div class="p-6 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No clients found.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Upcoming Appointments</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pet</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Owner</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Veterinarian</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php
                            $upcomingAppointments = \App\Models\Appointment::with(['pet.owner', 'veterinarian'])
                                ->where('start_time', '>=', now())
                                ->orderBy('start_time')
                                ->take(5)
                                ->get()
                                ->each(function($appointment) {
                                    if ($appointment->start_time) {
                                        $appointment->start_time = \Carbon\Carbon::parse($appointment->start_time);
                                    }
                                    if ($appointment->end_time) {
                                        $appointment->end_time = \Carbon\Carbon::parse($appointment->end_time);
                                    }
                                    return $appointment;
                                });
                        ?>
                        <!--[if BLOCK]><![endif]--><?php if($upcomingAppointments->count() > 0): ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $upcomingAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    <?php echo e($appointment->pet->name ?? 'N/A'); ?>

                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    <?php echo e($appointment->pet->species ?? 'N/A'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <?php echo e($appointment->pet->owner->name ?? 'N/A'); ?>

                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php echo e($appointment->pet->owner->email ?? 'N/A'); ?>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <?php echo e($appointment->veterinarian->name ?? 'N/A'); ?>

                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php echo e($appointment->veterinarian->specialization ?? 'Veterinarian'); ?>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <?php echo e($appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y') : 'N/A'); ?>

                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php echo e($appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('H:i') : 'N/A'); ?>

                                            <!--[if BLOCK]><![endif]--><?php if($appointment->end_time): ?>
                                                - <?php echo e(\Carbon\Carbon::parse($appointment->end_time)->format('H:i')); ?>

                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                        <?php if($appointment->status === 'confirmed'): ?> bg-blue-900/50 text-blue-400
                                        <?php elseif($appointment->status === 'completed'): ?> bg-green-900/30 text-green-400
                                        <?php elseif($appointment->status === 'cancelled'): ?> bg-red-900/30 text-red-400
                                        <?php elseif($appointment->status === 'pending'): ?> bg-yellow-900/30 text-yellow-400
                                        <?php else: ?> <?php endif; ?>">
                                            <?php echo e(ucfirst($appointment->status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href=" <?php echo e(route('admin.appointments.show', $appointment->id)); ?> " class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No upcoming appointments found.
                                </td>
                            </tr>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- All Appointments Modal -->
    <!--[if BLOCK]><![endif]--><?php if($showAllAppointments): ?>
        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['wire:model.live' => 'showAllAppointments']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showAllAppointments']); ?>
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">All Appointments</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pet</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Owner</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Veterinarian</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $allAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            <?php echo e($appointment->start_time->format('M d, Y')); ?>

                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <?php echo e($appointment->start_time->format('h:i A')); ?> - <?php echo e($appointment->end_time->format('h:i A')); ?>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    <?php echo e($appointment->pet->name); ?>

                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    <?php echo e($appointment->pet->species); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white"><?php echo e($appointment->pet->owner->name); ?></div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($appointment->pet->owner->phone); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white"><?php echo e($appointment->veterinarian->user->name ?? 'Unassigned'); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                            $statusColors = [
                                                'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                'no_show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                'in_progress' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                            ];
                                            $color = $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                        ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($color); ?>">
                                            <?php echo e(str_replace('_', ' ', ucfirst($appointment->status))); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="<?php echo e(route('admin.appointments.show', $appointment->id)); ?>" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No appointments found.
                                    </td>
                                </tr>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>

                <!--[if BLOCK]><![endif]--><?php if($allAppointments->hasPages()): ?>
                    <div class="mt-4">
                        <?php echo e($allAppointments->links()); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/dashboard-overview.blade.php ENDPATH**/ ?>