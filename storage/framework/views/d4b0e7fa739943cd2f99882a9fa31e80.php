<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    wire:ignore>
    <div class="flex items-center justify-center min-h-screen p-2 sm:p-4 text-center">
        <!-- Enhanced background overlay with smoother transition -->
        <div class="fixed inset-0 bg-gradient-to-br from-gray-900/80 to-gray-800/80 dark:from-gray-900/90 dark:to-gray-800/90 backdrop-blur-sm transition-all duration-300"
            aria-hidden="true" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Modal container with enhanced animation and shadow -->
        <div class="relative w-full max-w-5xl mx-auto transform transition-all duration-300"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <!-- Modal content with subtle border and shadow -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden w-full max-h-[90vh] flex flex-col border border-gray-100 dark:border-gray-700">
                <!-- Enhanced header with gradient background -->
                <div
                    class="bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 px-5 sm:px-6 py-4 border-b border-indigo-500/20">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-white tracking-tight" id="modal-title">
                            <div class="flex items-center space-x-3">
                                <div class="p-1.5 rounded-lg bg-white/10 backdrop-blur-sm">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span>Medical Record Details</span>
                            </div>
                        </h3>
                        <button wire:click="redirectBack" class="text-white hover:text-gray-200 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div
                        class="mt-1 flex flex-col sm:flex-row sm:items-center text-sm text-indigo-100 space-y-1 sm:space-y-0">
                        <span class="truncate">Record ID: <?php echo e($record->id); ?></span>
                        <span class="hidden sm:inline mx-2">•</span>
                        <span
                            class="truncate"><?php echo e(\Carbon\Carbon::parse($record->record_date)->format('M d, Y')); ?></span>
                    </div>
                </div>

                <!-- Main content with scrollable area -->
                <div class="flex-1 overflow-y-auto p-4 sm:p-6">
                    <div class="space-y-6">
                        <!-- Patient and Vet Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Patient Card -->
                            <div
                                class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                <div
                                    class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50 flex items-center justify-between">
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                        <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Patient Information
                                    </h4>
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 dark:from-blue-900/50 dark:to-indigo-900/50 dark:text-blue-200 border border-blue-200 dark:border-blue-800/50">
                                            <?php echo e($record->pet->species); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative">
                                            <div
                                                class="h-14 w-14 rounded-full bg-gradient-to-br from-indigo-100 to-blue-100 dark:from-indigo-900/30 dark:to-blue-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border-2 border-white dark:border-gray-700 shadow-sm">
                                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php if($record->pet->gender === 'male'): ?>
                                                <div
                                                    class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-blue-500 flex items-center justify-center border-2 border-white dark:border-gray-800">
                                                    <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            <?php else: ?>
                                                <div
                                                    class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-pink-500 flex items-center justify-center border-2 border-white dark:border-gray-800">
                                                    <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <div class="min-w-0">
                                            <h5
                                                class="text-lg font-bold text-gray-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                <?php echo e($record->pet->name); ?>

                                            </h5>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($record->pet->breed); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-5 space-y-3 text-sm">
                                        <div class="flex items-center text-gray-700 dark:text-gray-300 group">
                                            <div
                                                class="p-1.5 rounded-md bg-blue-50 dark:bg-blue-900/20 text-blue-500 dark:text-blue-400 mr-3 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/30 transition-colors">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Age</div>
                                                <div><?php echo e($record->pet->age); ?> years</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center text-gray-700 dark:text-gray-300 group">
                                            <div
                                                class="p-1.5 rounded-md bg-purple-50 dark:bg-purple-900/20 text-purple-500 dark:text-purple-400 mr-3 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/30 transition-colors">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Gender</div>
                                                <div><?php echo e(ucfirst($record->pet->gender)); ?></div>
                                            </div>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($record->pet->color): ?>
                                            <div class="flex items-center text-gray-700 dark:text-gray-300 group">
                                                <div
                                                    class="p-1.5 rounded-md bg-amber-50 dark:bg-amber-900/20 text-amber-500 dark:text-amber-400 mr-3 group-hover:bg-amber-100 dark:group-hover:bg-amber-900/30 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.486M7 17h.01" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Color</div>
                                                    <div><?php echo e($record->pet->color); ?></div>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>

                            <!-- Veterinarian Card -->
                            <div
                                class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                <div
                                    class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 flex items-center justify-between">
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Veterinarian Information
                                    </h4>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="h-14 w-14 rounded-full bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 flex items-center justify-center text-green-600 dark:text-green-400 border-2 border-white dark:border-gray-700 shadow-sm">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <h5
                                                class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                                <?php echo e($record->vet->user->name); ?>

                                            </h5>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($record->vet->specialization ?? 'General Practice'); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-5 space-y-3 text-sm">
                                        <!--[if BLOCK]><![endif]--><?php if($record->vet->user->phone): ?>
                                            <div class="flex items-center text-gray-700 dark:text-gray-300 group">
                                                <div
                                                    class="p-1.5 rounded-md bg-blue-50 dark:bg-blue-900/20 text-blue-500 dark:text-blue-400 mr-3 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/30 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Contact</div>
                                                    <a href="tel:<?php echo e($record->vet->user->phone); ?>"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                                        <?php echo e($record->vet->user->phone); ?>

                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <!--[if BLOCK]><![endif]--><?php if($record->vet->user->email): ?>
                                            <div class="flex items-center text-gray-700 dark:text-gray-300 group">
                                                <div
                                                    class="p-1.5 rounded-md bg-purple-50 dark:bg-purple-900/20 text-purple-500 dark:text-purple-400 mr-3 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/30 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Email</div>
                                                    <a href="mailto:<?php echo e($record->vet->user->email); ?>"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                                        <?php echo e($record->vet->user->email); ?>

                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information -->
                        <div
                            class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                            <div
                                class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                        <div
                                            class="p-1.5 rounded-lg bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 mr-3">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                            </svg>
                                        </div>
                                        Medical Information
                                    </h4>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-900/50 dark:text-rose-200">
                                        <?php echo e($record->created_at->format('M j, Y')); ?>

                                    </span>
                                </div>
                            </div>

                            <?php
                                $sections = [
                                    'chief_complaint' => [
                                        'icon' => 'M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2',
                                        'title' => 'Chief Complaint',
                                        'value' => $record->chief_complaint,
                                        'color' => 'bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400'
                                    ],
                                    'diagnosis' => [
                                        'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                        'title' => 'Diagnosis',
                                        'value' => $record->diagnosis,
                                        'color' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400'
                                    ],
                                    'treatment_plan' => [
                                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                                        'title' => 'Treatment Plan',
                                        'value' => $record->treatment_plan,
                                        'color' => 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400'
                                    ],
                                    'medications' => [
                                        'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                                        'title' => 'Medications',
                                        'value' => $record->medications,
                                        'color' => 'bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400'
                                    ]
                                ];
                            ?>

                            <!--[if BLOCK]><![endif]--><?php if(!empty(array_filter(array_column($sections, 'value')))): ?>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!--[if BLOCK]><![endif]--><?php if(!empty($section['value'])): ?>
                                                <div
                                                    class="relative group-hover:opacity-90 hover:!opacity-100 transition-all duration-300">
                                                    <div
                                                        class="absolute -inset-0.5 bg-gradient-to-r from-rose-400 to-pink-500 rounded-xl opacity-0 group-hover:opacity-50 blur transition duration-300 group-hover:duration-200">
                                                    </div>
                                                    <div
                                                        class="relative flex bg-white dark:bg-gray-800 rounded-xl p-4 h-full border border-gray-100 dark:border-gray-700 hover:border-transparent transition-colors">
                                                        <div class="flex-shrink-0">
                                                            <div
                                                                class="h-10 w-10 rounded-lg <?php echo e($section['color']); ?> flex items-center justify-center">
                                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="1.8" d="<?php echo $section['icon']; ?>" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4 flex-1 min-w-0">
                                                            <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                                                <?php echo e($section['title']); ?>

                                                            </h5>
                                                            <div class="prose prose-sm dark:prose-invert max-w-none">
                                                                <p
                                                                    class="text-gray-600 dark:text-gray-300 whitespace-pre-line break-words">
                                                                    <?php echo e($section['value']); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-10 px-6">
                                    <div
                                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-rose-50 dark:bg-rose-900/20">
                                        <svg class="h-8 w-8 text-rose-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-base font-semibold text-gray-900 dark:text-white">
                                        No medical information available
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        No medical details have been recorded for this visit yet.
                                    </p>
                                    <div class="mt-4">
                                        <a href="#"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors duration-200">
                                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Details
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!-- Follow Up & Actions -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Follow Up Card -->
                            <div
                                class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                <div
                                    class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20">
                                    <div class="flex items-center justify-between">
                                        <h4
                                            class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                            <div
                                                class="p-1.5 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 mr-3">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            Follow Up
                                        </h4>
                                        <!--[if BLOCK]><![endif]--><?php if($record->follow_up_required): ?>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-200">
                                                <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-amber-400" fill="currentColor"
                                                    viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Required
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="space-y-5">
                                        <div
                                            class="p-4 rounded-xl bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/10 dark:to-yellow-900/10 border border-amber-100 dark:border-amber-900/20">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-amber-800 dark:text-amber-200">
                                                        <?php echo e($record->follow_up_required ? 'Follow-up Required' : 'No Follow-up Needed'); ?>

                                                    </h3>
                                                    <!--[if BLOCK]><![endif]--><?php if($record->follow_up_required && $record->follow_up_date): ?>
                                                        <div class="mt-2 text-sm text-amber-700 dark:text-amber-300">
                                                            <p class="flex items-center">
                                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="1.8"
                                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                                <?php echo e(\Carbon\Carbon::parse($record->follow_up_date)->format('F j, Y')); ?>

                                                                <span class="ml-2 text-amber-600 dark:text-amber-400">
                                                                    (<?php echo e(\Carbon\Carbon::parse($record->follow_up_date)->diffForHumans()); ?>)
                                                                </span>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>
                                        </div>

                                        <!--[if BLOCK]><![endif]--><?php if($record->follow_up_notes): ?>
                                            <div
                                                class="mt-2 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                                <h4
                                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                                    Notes</h4>
                                                <div class="prose prose-sm dark:prose-invert max-w-none">
                                                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                                        <?php echo e($record->follow_up_notes); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                        <!--[if BLOCK]><![endif]--><?php if($record->follow_up_required): ?>
                                            <div class="mt-2">
                                                <button type="button"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    Schedule Follow-up
                                                </button>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>

                            <!-- Actions Card -->
                            <div
                                class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                <div
                                    class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20">
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                        <div
                                            class="p-1.5 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mr-3">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        Actions
                                    </h4>
                                </div>
                                <div class="p-5">
                                    <div class="space-y-3">
                                        <a href="<?php echo e(route('medical-records.edit', ['pet' => $record->pet_id, 'record' => $record->id])); ?>"
                                            class="group relative flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:-translate-y-0.5">
                                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-indigo-300 group-hover:text-indigo-200"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </span>
                                            Edit Record
                                        </a>

                                        <button type="button"
                                            class="group relative w-full flex items-center justify-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:-translate-y-0.5">
                                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </span>
                                            Download PDF
                                        </button>

                                        <div class="pt-2 mt-4 border-t border-gray-100 dark:border-gray-700">
                                            <button type="button"
                                                class="group relative w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 focus:outline-none transition-colors">
                                                <span class="absolute left-0 inset-y-0 flex items-center">
                                                    <svg class="h-5 w-5 text-rose-400 group-hover:text-rose-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </span>
                                                <span>Delete Record</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($treatments->count() > 0 || $vaccinations->count() > 0): ?>
                            <!-- Treatments & Vaccinations -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <!-- Treatments Card -->
                                <div
                                    class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                    <div
                                        class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20">
                                        <div class="flex items-center justify-between">
                                            <h4
                                                class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                                <div
                                                    class="p-1.5 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 mr-3">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                Treatments
                                            </h4>
                                            <!--[if BLOCK]><![endif]--><?php if($treatments->count() > 0): ?>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200">
                                                    <?php echo e($treatments->count()); ?>

                                                    <?php echo e(Str::plural('Treatment', $treatments->count())); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <!--[if BLOCK]><![endif]--><?php if($treatments->count() > 0): ?>
                                            <ul class="space-y-4">
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                        class="group/item relative pl-4 transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded-lg">
                                                        <div
                                                            class="absolute left-0 top-3.5 h-2.5 w-2.5 rounded-full bg-blue-500 group-hover/item:bg-blue-600 transition-colors">
                                                        </div>
                                                        <div class="flex items-start justify-between">
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                    <?php echo e($treatment->name); ?></div>
                                                                <!--[if BLOCK]><![endif]--><?php if($treatment->pivot && $treatment->pivot->notes): ?>
                                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                                        <?php echo e($treatment->pivot->notes); ?></p>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </div>
                                                            <button type="button"
                                                                class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-blue-500 dark:text-gray-500 dark:hover:text-blue-400 transition-opacity">
                                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </ul>
                                        <?php else: ?>
                                            <div class="text-center py-6 px-4">
                                                <div
                                                    class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-blue-50 dark:bg-blue-900/30 mb-3">
                                                    <svg class="h-7 w-7 text-blue-500 dark:text-blue-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">No treatments
                                                    recorded</h4>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add treatments to track
                                                    medical procedures and care.</p>
                                                <div class="mt-4">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3.5 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                        Add Treatment
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>

                                <!-- Vaccinations Card -->
                                <div
                                    class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                    <div
                                        class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20">
                                        <div class="flex items-center justify-between">
                                            <h4
                                                class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                                                <div
                                                    class="p-1.5 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 mr-3">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                Vaccinations
                                            </h4>
                                            <!--[if BLOCK]><![endif]--><?php if($vaccinations->count() > 0): ?>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200">
                                                    <?php echo e($vaccinations->count()); ?>

                                                    <?php echo e(Str::plural('Vaccine', $vaccinations->count())); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <!--[if BLOCK]><![endif]--><?php if($vaccinations->count() > 0): ?>
                                            <ul class="space-y-4">
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $vaccinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaccination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $isExpired = false;
                                                        if ($vaccination->pivot && $vaccination->pivot->expires_at) {
                                                            $isExpired = \Carbon\Carbon::parse($vaccination->pivot->expires_at)->isPast();
                                                        }
                                                    ?>
                                                    <li
                                                        class="group/item relative pl-4 transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-3 rounded-lg border-l-2 <?php echo e($isExpired ? 'border-rose-500' : 'border-green-500'); ?>">
                                                        <div class="flex items-start justify-between">
                                                            <div class="flex-1 min-w-0">
                                                                <div class="flex items-center">
                                                                    <h5
                                                                        class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                                        <?php echo e($vaccination->name); ?></h5>
                                                                    <!--[if BLOCK]><![endif]--><?php if($isExpired): ?>
                                                                        <span
                                                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-900/50 dark:text-rose-200">
                                                                            Expired
                                                                        </span>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                                </div>

                                                                <div class="mt-1.5 grid grid-cols-2 gap-x-4 gap-y-1 text-xs">
                                                                    <!--[if BLOCK]><![endif]--><?php if($vaccination->pivot && $vaccination->pivot->administered_at): ?>
                                                                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                                                                            <svg class="flex-shrink-0 mr-1.5 h-3.5 w-3.5 text-green-500"
                                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                            </svg>
                                                                            <span>Administered:
                                                                                <?php echo e(\Carbon\Carbon::parse($vaccination->pivot->administered_at)->format('M j, Y')); ?></span>
                                                                        </div>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                                    <!--[if BLOCK]><![endif]--><?php if($vaccination->pivot && $vaccination->pivot->expires_at): ?>
                                                                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                                                                            <svg class="flex-shrink-0 mr-1.5 h-3.5 w-3.5 text-amber-500"
                                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                            </svg>
                                                                            <span>Expires:
                                                                                <?php echo e(\Carbon\Carbon::parse($vaccination->pivot->expires_at)->format('M j, Y')); ?></span>
                                                                        </div>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                                    <!--[if BLOCK]><![endif]--><?php if($vaccination->pivot && $vaccination->pivot->administered_by): ?>
                                                                        <div
                                                                            class="flex items-center text-gray-600 dark:text-gray-400 col-span-2">
                                                                            <svg class="flex-shrink-0 mr-1.5 h-3.5 w-3.5 text-blue-500"
                                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                            </svg>
                                                                            <span>By: <?php echo e($vaccination->pivot->administered_by); ?></span>
                                                                        </div>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                                </div>

                                                                <!--[if BLOCK]><![endif]--><?php if($vaccination->pivot && $vaccination->pivot->notes): ?>
                                                                    <div class="mt-2 p-2 bg-gray-50 dark:bg-gray-700/30 rounded-md">
                                                                        <p class="text-xs text-gray-600 dark:text-gray-300">
                                                                            <?php echo e($vaccination->pivot->notes); ?></p>
                                                                    </div>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </div>
                                                            <button type="button"
                                                                class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-green-500 dark:text-gray-500 dark:hover:text-green-400 transition-opacity ml-2">
                                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </ul>
                                        <?php else: ?>
                                            <div class="text-center py-6 px-4">
                                                <div
                                                    class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-50 dark:bg-green-900/30 mb-3">
                                                    <svg class="h-7 w-7 text-green-500 dark:text-green-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">No vaccinations
                                                    recorded</h4>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track vaccinations and
                                                    their expiration dates.</p>
                                                <div class="mt-4">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3.5 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                        Add Vaccination
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
                <!-- Footer with sticky positioning -->
                <div
                    class="sticky bottom-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-4 py-3 sm:px-6">
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="<?php echo e(route('medical-records.index', $record->pet)); ?>"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors duration-200">
                            Close
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
            <a href="<?php echo e(route('medical-records.index', $record->pet)); ?>"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                Close
            </a>
        </div>
    </div>
</div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/medical-record-details.blade.php ENDPATH**/ ?>