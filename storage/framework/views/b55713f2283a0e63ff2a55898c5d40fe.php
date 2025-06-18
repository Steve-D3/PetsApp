<div class="flex flex-col py-8 px-6 text-white justify-center items-center">
    <div class=" max-w-7xl mx-auto flex flex-col sm:flex-row  sm:gap-4 mb-4 w-full px-6">
        <div class="py-6 px-4 sm:px-6 lg:px-8 lg:mx-auto">
            <!-- Header -->
            <div class="sm:flex sm:items-center sm:justify-between mb-8">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pets</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage all pets and their information</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text"
                               wire:model.live.debounce.300ms="search"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Search pets...">
                    </div>
                    <a href="<?php echo e(route('admin.pets.create')); ?>"
                       class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Pet
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                        <select id="type" wire:model.live="filterSpecies" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-700 dark:text-white">
                            <option value="">All Types</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Bird">Bird</option>
                            <option value="Reptile">Reptile</option>
                            <option value="Rabbit">Rabbit</option></div>
                        </select>
                    </div>
                    <div>
                        <label for="sterilized" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sterilized</label>
                        <select id="sterilized" wire:model.live="filterSterilized" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-700 dark:text-white">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="microchip" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Microchip</label>
                        <select id="microchip" wire:model.live="filterMicrochip" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md dark:bg-gray-700 dark:text-white">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button wire:click="resetFilters" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pets Grid -->
            <!--[if BLOCK]><![endif]--><?php if($pets->count() > 0): ?>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-200 hover:shadow-md">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                        <!--[if BLOCK]><![endif]--><?php if($pet->type === 'dog'): ?>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        <?php elseif($pet->type === 'cat'): ?>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                        <?php else: ?>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                            <a href="<?php echo e(route('admin.pets.show', $pet->id)); ?>" class="hover:text-blue-600 dark:hover:text-blue-400">
                                                <?php echo e($pet->name); ?>

                                            </a>
                                        </h3>
                                        <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">
                                            <?php echo e(ucfirst($pet->type)); ?> • <?php echo e($pet->breed ?? 'Mixed'); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="mt-6 border-t border-gray-100 dark:border-gray-700 pt-4">
                                    <dl class="space-y-3">
                                        <div class="flex items-center">
                                            <dt class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($pet->owner?->name ?? 'No owner'); ?>

                                            </dd>
                                        </div>
                                        <div class="flex items-center">
                                            <dt class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($pet->birth_date ? $this->calculateAge($pet->birth_date) . ' years old' : 'Age not specified'); ?>

                                            </dd>
                                        </div>
                                        <div class="flex items-center">
                                            <dt class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.001 3.001 0 018.528 15H7.472a3 3 0 01-2.95-2.537l-.026-.162-1.281-4.05a1 1 0 01.57-1.166l.923-.462L6 5.5V3a1 1 0 011-1zm1.5 12.5a1 1 0 100-2 1 1 0 000 2zm-3-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                                <?php echo e($pet->weight ? $pet->weight . ' kg' : 'Weight not specified'); ?>

                                            </dd>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($pet->microchip_number): ?>
                                        <div class="flex items-center">
                                            <dt class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h2a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400 truncate">
                                                Microchip: <?php echo e($pet->microchip_number); ?>

                                            </dd>
                                        </div>
                                        <?php else: ?>
                                        <div class="flex items-center">
                                            <dt class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h2a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                                Microchip: Not specified
                                            </dd>
                                        </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </dl>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3 flex justify-end space-x-3 border-t border-gray-100 dark:border-gray-700">
                                <a href="<?php echo e(route('admin.pets.show', $pet->id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/50">
                                    View
                                </a>
                                <a href="<?php echo e(route('admin.pets.edit', $pet->id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                                    Edit
                                </a>
                                <button wire:click="delete(<?php echo e($pet->id); ?>)"
                                        wire:confirm="Are you sure you want to delete this pet?"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50">
                                    Delete
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php else: ?>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No pets found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <?php echo e($search || $filterSpecies || $filterSterilized || $filterMicrochip ? 'Try adjusting your search or filter criteria' : 'Get started by adding a new pet'); ?>

                    </p>
                    <div class="mt-6">
                        <a href="<?php echo e(route('admin.pets.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New Pet
                        </a>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/pets-index.blade.php ENDPATH**/ ?>