<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-900 dark:to-gray-800 py-8 px-4 sm:px-6 lg:px-8 rounded-lg">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-xl shadow-gray-200/50 dark:shadow-gray-900/20 rounded-2xl mb-8 border border-gray-100/50 dark:border-gray-700/50 transition-all duration-300 transform hover:shadow-2xl hover:shadow-gray-300/30 dark:hover:shadow-gray-900/30 hover:-translate-y-0.5">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3">
                            <h1 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                                Medical Records
                            </h1>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-200">
                                <?php echo e($pet->name); ?>

                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">Owner:</span>
                                <span class="ml-1 text-gray-900 dark:text-white"><?php echo e($pet->owner->name); ?></span>
                            </div>
                            <div class="flex items-center text-gray-500 dark:text-gray-400">
                                <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <?php echo e($pet->owner->email); ?>

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => '$toggle(\'showFilters\')','class' => 'bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showFilters\')','class' => 'bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white']); ?>
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            <?php echo e($showFilters ? 'Hide' : 'Show'); ?> Filters
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
                        <!--[if BLOCK]><![endif]--><?php if($showFilters): ?>
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => 'resetFilters','class' => 'bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'resetFilters','class' => 'bg-gray-100 hover:bg-gray-200 hover:text-blue-600 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white']); ?>
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Reset Filters
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
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\MedicalRecord::class)): ?>
                            <a href="<?php echo e(route('medical-records.create', $pet)); ?>"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Record
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <!--[if BLOCK]><![endif]--><?php if($showFilters): ?>
            <div
                class="bg-white dark:bg-gray-800/95 overflow-hidden shadow-sm rounded-xl mb-6 transition-all duration-300 ease-in-out border border-gray-200/80 dark:border-gray-700/60 backdrop-blur-sm">
                <div class="px-6 py-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Filter Records</h3>
                        <button type="button" wire:click="$toggle('showFilters')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                            <span class="sr-only">Close filters</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-center space-x-6">
                        <!-- Search Input -->
                        <div class="space-y-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Search Records
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input id="search" type="text"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600 transition duration-150 ease-in-out"
                                    wire:model.live.debounce.300ms="search" placeholder="Search records..." />
                            </div>
                        </div>

                        <!-- Diagnosis Filter -->
                        <div class="space-y-2">
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Diagnosis
                            </label>
                            <div class="relative">
                                <select id="diagnosis"
                                    class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                    wire:model.live="filters.diagnosis">
                                    <option value="">All Diagnoses</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $diagnoses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnosis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($diagnosis); ?>" class="dark:bg-gray-700"><?php echo e($diagnosis); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    From Date
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="start_date"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                        wire:model.live="filters.start_date" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    To Date
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="end_date"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                        wire:model.live="filters.end_date" />
                                </div>
                            </div>
                        </div>

                        <!-- Follow Up Required -->
                        <div class="flex items-end">
                            <div class="flex items-center h-5">
                                <input id="follow_up_required" type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-2 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 transition duration-150 ease-in-out"
                                    wire:model.live="filters.follow_up_required" />
                                <label for="follow_up_required"
                                    class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Follow Up Required
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Records Table -->
        <div class="overflow-hidden rounded-2xl shadow-xl border border-gray-200/60 dark:border-gray-700/60 bg-white/90 dark:bg-gray-800/95 backdrop-blur-sm transition-all duration-300 hover:shadow-2xl hover:shadow-gray-300/30 dark:hover:shadow-gray-900/20">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200/60 dark:divide-gray-700/60">
                    <thead class="bg-gray-50/90 dark:bg-gray-800/95 backdrop-blur-sm">
                        <tr class="border-b border-gray-200/60 dark:border-gray-700/60">
                            <th scope="col"
                                class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider cursor-pointer group hover:bg-gray-100/80 dark:hover:bg-gray-700/70 transition-colors duration-150"
                                wire:click="sortBy('record_date')">
                                <div class="flex items-center group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200">
                                    <span>Date</span>
                                        <!--[if BLOCK]><![endif]--><?php if($sortField === 'record_date'): ?>
                                            <!--[if BLOCK]><![endif]--><?php if($sortDirection === 'asc'): ?>
                                                <svg class="ml-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            <?php else: ?>
                                                <svg class="ml-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php else: ?>
                                            <svg class="ml-1.5 h-4 w-4 text-transparent" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Diagnosis
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Treatments
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Follow Up
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/90 dark:bg-gray-800/95 divide-y divide-gray-200/80 dark:divide-gray-700/60">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="bg-white/90 dark:bg-gray-800/95 hover:bg-gray-50/90 dark:hover:bg-gray-700/90 transition-colors duration-150 group border-b border-gray-100/50 dark:border-gray-700/60 last:border-0">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 mr-3 ring-1 ring-indigo-100 dark:ring-indigo-800/50 shadow-sm">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    <?php echo e(\Carbon\Carbon::parse($record->record_date)->format('M d, Y')); ?>

                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    <?php echo e(\Carbon\Carbon::parse($record->record_date)->diffForHumans()); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Diagnosis Column -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col space-y-1.5">
                                            <!--[if BLOCK]><![endif]--><?php if($record->veterinarian): ?>
                                                <div class="flex items-center text-sm text-gray-900 dark:text-white font-medium">
                                                    <svg class="h-4 w-4 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <?php echo e($record->veterinarian->name); ?>

                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white bg-indigo-50 dark:bg-indigo-900/20 px-2.5 py-1.5 rounded-md inline-flex items-center self-start border border-indigo-100 dark:border-indigo-800/50 shadow-sm">
                                                <svg class="h-3.5 w-3.5 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <?php echo e($record->diagnosis); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <!-- Treatments Column -->
                                    <td class="px-6 py-4">
                                        <!--[if BLOCK]><![endif]--><?php if($record->treatments->count() > 0): ?>
                                            <div class="flex flex-wrap gap-1.5">
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $record->treatments->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-200 border border-blue-100 dark:border-blue-800/50 shadow-sm hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-150">
                                                        <svg class="h-3 w-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        <?php echo e($treatment->name); ?>

                                                        <!--[if BLOCK]><![endif]--><?php if($treatment->pivot && $treatment->pivot->details): ?>
                                                            <span class="ml-1 text-blue-600 dark:text-blue-300/90 text-opacity-80">(<?php echo e($treatment->pivot->details); ?>)</span>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($record->treatments->count() > 2): ?>
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700/80 dark:text-gray-300 border border-gray-200 dark:border-gray-600/50 hover:bg-gray-200 dark:hover:bg-gray-600/80 transition-colors duration-150">
                                                        +<?php echo e($record->treatments->count() - 2); ?> more
                                                    </span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        <?php else: ?>
                                            <span class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800/60 px-2.5 py-1.5 rounded-md border border-gray-100 dark:border-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition-colors duration-150">
                                                <svg class="h-3.5 w-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                No treatments
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>

                                    <!-- Follow Up Required Column -->
                                    <td class="px-6 py-4">
                                        <!--[if BLOCK]><![endif]--><?php if($record->follow_up_required): ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            <?php echo e(\Carbon\Carbon::parse($record->follow_up_date)->format('M j, Y')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                No Follow-up Needed
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="<?php echo e(route('medical-records.show', ['pet' => $pet->id, 'record' => $record->id])); ?>"
                                                class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-gray-700/90 text-gray-700 dark:text-gray-200 text-xs font-medium rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-all duration-150 ease-in-out group/action hover:shadow-md hover:-translate-y-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-blue-500 group-hover/action:text-blue-600 dark:group-hover/action:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $record)): ?>
                                                <a href="<?php echo e(route('medical-records.edit', ['pet' => $pet->id, 'record' => $record->id])); ?>"
                                                    class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-medium rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-all duration-150 ease-in-out group/action">
                                                    <svg class="h-3.5 w-3.5 mr-1.5 text-indigo-500 group-hover/action:text-indigo-600 dark:group-hover/action:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                               </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-full">
                                    <svg class="h-12 w-12 text-indigo-500 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">No records found</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md">
                                        No medical records have been added for <?php echo e($pet->name); ?> yet. Create your first record to get started.
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\MedicalRecord::class)): ?>
                                        <a href="<?php echo e(route('medical-records.create', $pet)); ?>"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:from-indigo-700 dark:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 transition-all duration-200 transform hover:-translate-y-0.5">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add First Record
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--[if BLOCK]><![endif]--><?php if($records->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row items-center justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        Showing <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($records->firstItem()); ?></span> to
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($records->lastItem()); ?></span> of
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($records->total()); ?></span> records
                        <!--[if BLOCK]><![endif]--><?php if($filters['search'] || $filters['diagnosis'] || $filters['start_date'] || $filters['end_date'] || $filters['follow_up_required']): ?>
                            <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-700/50">
                                <svg class="h-3.5 w-3.5 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filtered
                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-1">
                        <!-- Previous Page Link -->
                        <!--[if BLOCK]><![endif]--><?php if($records->onFirstPage()): ?>
                            <span class="inline-flex items-center px-3 h-8 rounded-md border border-gray-200 dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Previous</span>
                            </span>
                        <?php else: ?>
                            <button wire:click="previousPage"
                                class="inline-flex items-center px-3 h-8 rounded-md border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Previous</span>
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!-- Page Numbers -->
                        <div class="hidden sm:flex items-center space-x-1">
                            <?php
                                $current = $records->currentPage();
                                $last = $records->lastPage();
                                $window = 2; // Number of pages to show on each side of current

                                // Show first page
                                if ($current > $window + 2) {
                                    echo '<button wire:click="gotoPage(1)" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">1</button>';
                                    if ($current > $window + 3) {
                                        echo '<span class="px-2 text-gray-500 dark:text-gray-400">...</span>';
                                    }
                                }

                                // Show window around current page
                                for ($i = max(1, $current - $window); $i <= min($last, $current + $window); $i++) {
                                    if ($i == $current) {
                                        echo '<span class="w-8 h-8 flex items-center justify-center rounded-md border border-indigo-500 bg-indigo-600 text-sm font-medium text-white">' . $i . '</span>';
                                    } else {
                                        echo '<button wire:click="gotoPage(' . $i . ')" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">' . $i . '</button>';
                                    }
                                }

                                // Show last page
                                if ($current < $last - $window - 1) {
                                    if ($current < $last - $window - 2) {
                                        echo '<span class="px-2 text-gray-500 dark:text-gray-400">...</span>';
                                    }
                                    echo '<button wire:click="gotoPage(' . $last . ')" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">' . $last . '</button>';
                                }
                            ?>
                        </div>

                        <!-- Next Page Link -->
                        <!--[if BLOCK]><![endif]--><?php if($records->hasMorePages()): ?>
                            <button wire:click="nextPage"
                                class="inline-flex items-center px-3 h-8 rounded-md border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500">
                                <span>Next</span>
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 h-8 rounded-md border border-gray-200 dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                <span>Next</span>
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/admin/medical-records-index.blade.php ENDPATH**/ ?>