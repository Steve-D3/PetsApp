<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <?php echo e($selectedDate ? 'New Appointment for ' . $selectedDate : 'New Appointment'); ?>

                </div>
            </h3>
        </div>
        
        <div class="px-6 py-5">
            <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            
            <?php if(session()->has('error')): ?>
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-800 dark:text-red-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <?php echo e(session('error')); ?>

                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            
            <form wire:submit.prevent="save" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!--[if BLOCK]><![endif]--><?php if(isset($form->pet_id) && $form->pet_id): ?>
                        <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                            <p class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pet</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($form->pet_name); ?></p>
                            </div>
                            <input type="hidden" name="pet_id" wire:model="form.pet_id" value="<?php echo e($form->pet_id); ?>">
                        </div>
                    <?php else: ?>
                        <div class="space-y-1">
                            <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Pet
                                </span>
                            </label>
                            <select wire:model="form.pet_id" id="pet_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm py-2 px-3">
                                <option value="">Select a pet</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pet->id); ?>" class="dark:bg-gray-700"><?php echo e($pet->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                            <!--[if BLOCK]><![endif]--><?php if($errors->has('form.pet_id')): ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <?php echo e($errors->first('form.pet_id')); ?>

                                </p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php
                        $vetId = is_object($veterinarianProfile) ? $veterinarianProfile->id : $veterinarianProfile;
                        $vet = $vets->firstWhere('id', $vetId);
                    ?>

                    <!--[if BLOCK]><![endif]--><?php if(!$vetId): ?>
                        <div class="space-y-1">
                            <label for="veterinarian_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Veterinarian
                                </span>
                            </label>
                            <select wire:model="form.veterinarian_id" id="veterinarian_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm py-2 px-3">
                                <option value="">Select a veterinarian</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $vets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($vetOption->user_id); ?>" class="dark:bg-gray-700">
                                        <?php echo e($vetOption->user->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                            <!--[if BLOCK]><![endif]--><?php if($errors->has('form.veterinarian_id')): ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <?php echo e($errors->first('form.veterinarian_id')); ?>

                                </p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php elseif($vet): ?>
                        <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                            <p class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Veterinarian</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($vet->user->name); ?></p>
                            </div>
                            <input type="hidden" wire:model="form.veterinarian_id" value="<?php echo e($vet->user_id); ?>">
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date & Time</label>
                        <input type="datetime-local" wire:model="form.start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        <!--[if BLOCK]><![endif]--><?php if($errors->has('form.start_time')): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($errors->first('form.start_time')); ?></p>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                        <textarea wire:model="form.notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600"></textarea>
                        <!--[if BLOCK]><![endif]--><?php if($errors->has('form.notes')): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($errors->first('form.notes')); ?></p>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <button type="button" @click="$dispatch('close-modal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700">
                            Save Appointment
                        </button>
                    </div>
                </form>

                <?php $__env->startPush('scripts'); ?>
                    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
                <?php $__env->stopPush(); ?>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/appointments/form.blade.php ENDPATH**/ ?>