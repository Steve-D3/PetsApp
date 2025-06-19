<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">User Details</h2>
                    <div class="flex space-x-4">
                        <a href="<?php echo e(route('admin.users.index')); ?>"
                            class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Users
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Information</h3>
                                <div class="space-y-6">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Name:</span>
                                        <span class="font-medium text-gray-900 dark:text-white"><?php echo e($user->name); ?></span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Email:</span>
                                        <span
                                            class="font-medium text-gray-900 dark:text-white"><?php echo e($user->email); ?></span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Role:</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300">
                                            <?php echo e(ucfirst($user->role)); ?>

                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Last Login:</span>
                                        <span class="font-medium text-gray-900 dark:text-white">
                                            <?php echo e($user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never'); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pets</h3>
                                <!--[if BLOCK]><![endif]--><?php if($user->pets->count() > 0): ?>
                                    <div class="space-y-4">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $user->pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 cursor-pointer">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2">
                                                            <span
                                                                class="text-gray-900 dark:text-white font-medium"><?php echo e($pet->name); ?></span>
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
                                                                <?php echo e($pet->species); ?>

                                                            </span>
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <?php echo e($pet->breed); ?>

                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Weight:</span> <?php echo e($pet->weight); ?> kg
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Gender:</span> <?php echo e(ucfirst($pet->gender)); ?>

                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Birth Date:</span>
                                                            <?php echo e($pet->birth_date ? $pet->birth_date->format('M d, Y') : 'Unknown'); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-12 px-4">
                                        <div class="mx-auto h-32 w-32 text-gray-300 dark:text-gray-500">
                                            <svg viewBox="0 0 48.839 48.839" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                                <path
                                                    d="M39.041,36.843c2.054,3.234,3.022,4.951,3.022,6.742c0,3.537-2.627,5.252-6.166,5.252c-1.56,0-2.567-0.002-5.112-1.326c0,0-1.649-1.509-5.508-1.354c-3.895-0.154-5.545,1.373-5.545,1.373c-2.545,1.323-3.516,1.309-5.074,1.309c-3.539,0-6.168-1.713-6.168-5.252c0-1.791,0.971-3.506,3.024-6.742c0,0,3.881-6.445,7.244-9.477c2.43-2.188,5.973-2.18,5.973-2.18h1.093v-0.001c0,0,3.698-0.009,5.976,2.181C35.059,30.51,39.041,36.844,39.041,36.843z M16.631,20.878c3.7,0,6.699-4.674,6.699-10.439S20.331,0,16.631,0S9.932,4.674,9.932,10.439S12.931,20.878,16.631,20.878z M10.211,30.988c2.727-1.259,3.349-5.723,1.388-9.971s-5.761-6.672-8.488-5.414s-3.348,5.723-1.388,9.971C3.684,29.822,7.484,32.245,10.211,30.988z M32.206,20.878c3.7,0,6.7-4.674,6.7-10.439S35.906,0,32.206,0s-6.699,4.674-6.699,10.439C25.507,16.204,28.506,20.878,32.206,20.878z M45.727,15.602c-2.728-1.259-6.527,1.165-8.488,5.414s-1.339,8.713,1.389,9.972c2.728,1.258,6.527-1.166,8.488-5.414S48.455,16.861,45.727,15.602z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No Pets Found
                                        </h3>
                                        <p class="mt-2 max-w-md mx-auto text-gray-500 dark:text-gray-400">
                                            This user hasn't registered any pets yet. When they do, their pets will appear
                                            here.
                                        </p>

                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/user-show.blade.php ENDPATH**/ ?>