<div class="py-8 px-6 text-white xl:px-24 lg:max-w-7xl mx-auto">
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Veterinarians</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your veterinary team and their details</p>
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
                       placeholder="Search vets...">
            </div>
            <a href="<?php echo e(route('admin.vets.create')); ?>"
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Veterinarian
            </a>
        </div>
    </div>

    <!-- Veterinarians Grid -->
    <!--[if BLOCK]><![endif]--><?php if($vets->count() > 0): ?>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $vets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-200 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-medium text-lg">
                                <?php echo e(substr($vet->user?->name ?? 'U', 0, 1)); ?>

                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    <a href="<?php echo e(route('admin.vets.show', $vet->id)); ?>" class="hover:text-blue-600 dark:hover:text-blue-400">
                                        <?php echo e($vet->user?->name ?? 'Unknown Vet'); ?>

                                    </a>
                                </h3>
                                <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                    <?php echo e($vet->specialty ?? 'General Practitioner'); ?>

                                </p>
                            </div>
                        </div>
                        <div class="mt-6 border-t border-gray-100 dark:border-gray-700 pt-4">
                            <dl class="space-y-3">
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                    </dt>
                                    <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo e($vet->license_number ?? 'License not specified'); ?>

                                    </dd>
                                </div>
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                    </dt>
                                    <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo e($vet->clinic?->name ?? 'No clinic assigned'); ?>

                                    </dd>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($vet->user?->email): ?>
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </dt>
                                    <dd class="ml-3 text-sm text-gray-500 dark:text-gray-400 truncate">
                                        <?php echo e($vet->user->email); ?>

                                    </dd>
                                </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </dl>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3 flex justify-end space-x-3 border-t border-gray-100 dark:border-gray-700">
                        <a href="<?php echo e(route('admin.vets.show', $vet->id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/50">
                            View
                        </a>
                        <a href="<?php echo e(route('admin.vets.edit', $vet->id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                            Edit
                        </a>
                        <button wire:click="delete(<?php echo e($vet->id); ?>)"
                                wire:confirm="Are you sure you want to delete this veterinarian?"
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No veterinarians found</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                <?php echo e($search || $specialtyFilter || $clinicFilter ? 'Try adjusting your search or filter criteria' : 'Get started by adding a new veterinarian'); ?>

            </p>
            <div class="mt-6">
                <a href="<?php echo e(route('admin.vets.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    New Veterinarian
                </a>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/vets-index.blade.php ENDPATH**/ ?>