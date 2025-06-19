<div
    class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6 transition-colors duration-200 rounded-lg">
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
                    <?php if (isset($component)) { $__componentOriginal6315a526d124ee5b3ba861082d11f72e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6315a526d124ee5b3ba861082d11f72e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.plus','data' => ['class' => '-ml-1 mr-2 h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => '-ml-1 mr-2 h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6315a526d124ee5b3ba861082d11f72e)): ?>
<?php $attributes = $__attributesOriginal6315a526d124ee5b3ba861082d11f72e; ?>
<?php unset($__attributesOriginal6315a526d124ee5b3ba861082d11f72e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6315a526d124ee5b3ba861082d11f72e)): ?>
<?php $component = $__componentOriginal6315a526d124ee5b3ba861082d11f72e; ?>
<?php unset($__componentOriginal6315a526d124ee5b3ba861082d11f72e); ?>
<?php endif; ?>
                    New Appointment
                </button>
            </div>
        </div>

        <!--[if BLOCK]><![endif]--><?php if($loading): ?>
            <div
                class="flex flex-col items-center justify-center h-96 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl border border-gray-100 dark:border-gray-700/50 p-8 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500 mb-4"></div>
                <p class="text-gray-600 dark:text-gray-300">Loading appointments...</p>
            </div>
        <?php else: ?>
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
                                        <?php echo e($selectedDate->format('F Y')); ?>

                                    </h2>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">
                                        Manage your appointments
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 transition-all duration-300">
                            <div id="calendar" class="h-[600px] ">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Appointment Details Modal -->
                <!--[if BLOCK]><![endif]--><?php if($showDetails && $selectedAppointment): ?>
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
                                    <p class="text-gray-600 dark:text-gray-300"><?php echo e($selectedAppointment['pet_name']); ?></p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">Owner Name:</h4>
                                    <p class="text-gray-600 dark:text-gray-300"><?php echo e($selectedAppointment['owner_name']); ?></p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">Time:</h4>
                                    <p class="text-gray-600 dark:text-gray-300"><?php echo e($selectedAppointment['start_time']); ?></p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">Status:</h4>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                                                                                                <?php if($selectedAppointment['status'] === 'completed'): ?> bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                                                                                                                                                <?php elseif($selectedAppointment['status'] === 'cancelled'): ?> bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                                                                                                                                                    <?php else: ?> bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                                                                                                                                                <?php endif; ?>">
                                        <?php echo e(ucfirst($selectedAppointment['status'])); ?>

                                    </span>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($selectedAppointment['notes']): ?>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Notes:</h4>
                                        <p class="text-gray-600 dark:text-gray-300"><?php echo e($selectedAppointment['notes']); ?></p>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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
                                        For <?php echo e($selectedDate->format('F Y')); ?>

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
                            <!--[if BLOCK]><![endif]--><?php if(count($appointments) > 0): ?>
                                <ul class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('admin.appointments.show', $appointment['id'])); ?>"
                                            class="block hover:bg-gray-50/90 dark:hover:bg-gray-700/60 transition-all duration-200 transform hover:scale-[1.01] hover:shadow-sm">
                                            <div class="p-4">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex-shrink-0 mt-0.5">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/30 flex items-center justify-center shadow-sm">
                                                            <?php if (isset($component)) { $__componentOriginale6eaa1fb23a5dde7f44337b383c5a9cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6eaa1fb23a5dde7f44337b383c5a9cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.paw','data' => ['class' => 'h-5 w-5 text-indigo-600 dark:text-indigo-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.paw'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-5 w-5 text-indigo-600 dark:text-indigo-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale6eaa1fb23a5dde7f44337b383c5a9cc)): ?>
<?php $attributes = $__attributesOriginale6eaa1fb23a5dde7f44337b383c5a9cc; ?>
<?php unset($__attributesOriginale6eaa1fb23a5dde7f44337b383c5a9cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale6eaa1fb23a5dde7f44337b383c5a9cc)): ?>
<?php $component = $__componentOriginale6eaa1fb23a5dde7f44337b383c5a9cc; ?>
<?php unset($__componentOriginale6eaa1fb23a5dde7f44337b383c5a9cc); ?>
<?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between gap-2">
                                                            <h3
                                                                class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                                <?php echo e($appointment['pet_name']); ?>

                                                            </h3>
                                                            <?php
                                                                $statusClasses = [
                                                                    'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                                    'confirmed' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300',
                                                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                                    'no_show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                                ];
                                                                $statusClass = $statusClasses[$appointment['status']] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                                            ?>
                                                            <span
                                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium <?php echo e($statusClass); ?> flex-shrink-0">
                                                                <?php echo e(ucfirst(str_replace('_', ' ', $appointment['status']))); ?>

                                                            </span>
                                                        </div>
                                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                                            <?php if (isset($component)) { $__componentOriginal78401f3e2385b5fdffa95e016607311b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78401f3e2385b5fdffa95e016607311b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.calendar','data' => ['class' => 'w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.calendar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $attributes = $__attributesOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__attributesOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $component = $__componentOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__componentOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
                                                            <?php echo e($appointment['start_time']); ?>

                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                                                            <?php if (isset($component)) { $__componentOriginal218c5c64b059a605cc15629404be144b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal218c5c64b059a605cc15629404be144b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.user','data' => ['class' => 'w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 inline-block mr-1.5 -mt-0.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $attributes = $__attributesOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__attributesOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $component = $__componentOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__componentOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
                                                            <?php echo e($appointment['owner_name']); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            <?php else: ?>
                                <div class="p-8 text-center animate-pulse">
                                    <div
                                        class="mx-auto h-16 w-16 rounded-full bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/20 flex items-center justify-center mb-4 shadow-inner">
                                        <?php if (isset($component)) { $__componentOriginal78401f3e2385b5fdffa95e016607311b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78401f3e2385b5fdffa95e016607311b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.calendar','data' => ['class' => 'h-8 w-8 text-indigo-600 dark:text-indigo-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.calendar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-8 text-indigo-600 dark:text-indigo-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $attributes = $__attributesOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__attributesOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $component = $__componentOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__componentOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
                                    </div>
                                    <h3 class="text-base font-medium text-gray-900 dark:text-white">No appointments</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        No appointments scheduled for this month.
                                    </p>
                                    <div class="mt-6">
                                        <button wire:click="openCreateModal"
                                            class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5 transform">
                                            <?php if (isset($component)) { $__componentOriginal6315a526d124ee5b3ba861082d11f72e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6315a526d124ee5b3ba861082d11f72e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.plus','data' => ['class' => '-ml-1 mr-2 h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => '-ml-1 mr-2 h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6315a526d124ee5b3ba861082d11f72e)): ?>
<?php $attributes = $__attributesOriginal6315a526d124ee5b3ba861082d11f72e; ?>
<?php unset($__attributesOriginal6315a526d124ee5b3ba861082d11f72e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6315a526d124ee5b3ba861082d11f72e)): ?>
<?php $component = $__componentOriginal6315a526d124ee5b3ba861082d11f72e; ?>
<?php unset($__componentOriginal6315a526d124ee5b3ba861082d11f72e); ?>
<?php endif; ?>
                                            New Appointment
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pet->id); ?>"><?php echo e($pet->name); ?>

                                                        (<?php echo e($pet->owner->name); ?>)</option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </select>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['newAppointment.pet_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
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
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['newAppointment.start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>

                                        <!-- Notes -->
                                        <div>
                                            <label for="notes"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Notes
                                            </label>
                                            <textarea id="notes" wire:model="newAppointment.notes" rows="3"
                                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['newAppointment.notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
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

        <?php $__env->startPush('scripts'); ?>
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
                        events: <?php echo json_encode($appointments, 15, 512) ?>,
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
                                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelAppointment(event.id);
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
                        darkTheme: <?php echo json_encode(auth()->user()->dark_mode ?? false, 15, 512) ?>
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
        <?php $__env->stopPush(); ?>
    </div>

    <?php $__env->startPush('styles'); ?>
        <style>
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
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/appointment-calendar.blade.php ENDPATH**/ ?>