<div>
    <!-- Backdrop -->
    <div 
    x-data="{
        isOpen: <?php if ((object) ('isOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'->value()); ?>')<?php echo e('isOpen'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'); ?>')<?php endif; ?>,
        recordId: <?php if ((object) ('recordId') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('recordId'->value()); ?>')<?php echo e('recordId'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('recordId'); ?>')<?php endif; ?>,
        isSubmitting: false,
        init() {
            // Listen for escape key to close modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.closeModal();
                }
            });
            
            // Listen for Livewire events
            window.addEventListener('close-edit-modal', () => {
                this.closeModal();
            });
        },
        closeModal() {
            if (this.isSubmitting) return;
            this.isOpen = false;
            // Let Livewire know the modal was closed
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('closeModal');
        },
        handleSubmit() {
            this.isSubmitting = true;
            // Show loading state
            const saveButton = this.$refs.saveButton;
            const originalText = saveButton.innerHTML;
            saveButton.disabled = true;
            saveButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `;
            
            // Submit the form
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('save').then(() => {
                this.isSubmitting = false;
                saveButton.disabled = false;
                saveButton.innerHTML = originalText;
            }).catch(() => {
                this.isSubmitting = false;
                saveButton.disabled = false;
                saveButton.innerHTML = originalText;
            });
        }
    }"
    x-init="init"
    @keydown.escape.window="if (isOpen) closeModal()"
    x-show="isOpen" 
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    @click="closeModal">
    </div>

    <!-- Modal -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all sm:max-w-4xl w-full max-h-[90vh] overflow-y-auto" 
         x-ref="modal"
         @click.away="!isSubmitting && closeModal()"
         x-show="isOpen" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         role="dialog" 
         aria-modal="true" 
         aria-labelledby="modal-headline"
         @keydown.escape="closeModal()">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="absolute right-0 top-0 pr-4 pt-4">
                <button type="button" 
                        class="bg-white dark:bg-gray-700 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        @click="closeModal()"
                        :disabled="isSubmitting"
                        :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }"
                        aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-headline">
                    <?php echo e($recordId ? 'Edit Medical Record' : 'Create New Medical Record'); ?>

                    <!--[if BLOCK]><![endif]--><?php if($recordId): ?>
                        <span class="text-sm text-gray-500 dark:text-gray-400 block sm:inline-block sm:ml-2">
                            #<?php echo e($recordId); ?>

                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Update the medical record details
                </p>
            </div>
            
            <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
                <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                <?php echo e(session('error')); ?>

                            </h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!-- Form -->
            <div class="mt-5">
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <!--[if BLOCK]><![endif]--><?php if(session('success')): ?>
                        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700 dark:text-green-200">
                                        <?php echo e(session('success')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                        There were <?php echo e($errors->count()); ?> errors with your submission
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700 dark:text-red-200">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <form wire:submit.prevent="save" class="space-y-6">
                        <div wire:loading.flex class="w-full justify-center items-center py-4">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                        </div>
                        <div wire:loading.class="opacity-50" wire:target="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Record Date -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="record_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Record Date & Time <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" 
                                       id="record_date" 
                                       wire:model.live.debounce.500ms="record_date"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       required>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['record_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Follow Up Required -->
                            <div class="col-span-2 sm:col-span-1 flex items-center pt-6">
                                <div class="flex items-center h-5">
                                    <input id="follow_up_required" 
                                           type="checkbox" 
                                           wire:model.live="follow_up_required"
                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700">
                                </div>
                                <label for="follow_up_required" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Follow-up Required
                                </label>
                            </div>

                            <!-- Follow Up Date (conditionally shown) -->
                            <!--[if BLOCK]><![endif]--><?php if($follow_up_required): ?>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="follow_up_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Follow-up Date & Time <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           id="follow_up_date" 
                                           wire:model="follow_up_date"
                                           class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                           <?php echo e($follow_up_required ? 'required' : ''); ?>>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['follow_up_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($this->getErrorBag()->first('follow_up_date')); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!-- Chief Complaint -->
                        <div>
                            <label for="chief_complaint" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Chief Complaint <span class="text-red-500">*</span>
                            </label>
                            <textarea id="chief_complaint" 
                                      wire:model.live.debounce.500ms="chief_complaint" 
                                      rows="2"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Enter the chief complaint"
                                      required></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['chief_complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!-- Diagnosis -->
                        <div>
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Diagnosis <span class="text-red-500">*</span>
                            </label>
                            <textarea id="diagnosis" 
                                      wire:model.live.debounce.500ms="diagnosis" 
                                      rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Enter the diagnosis"
                                      required></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!-- Treatment Plan -->
                        <div>
                            <label for="treatment_plan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Treatment Plan
                            </label>
                            <textarea id="treatment_plan" 
                                      wire:model.live.debounce.500ms="treatment_plan" 
                                      rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Enter the treatment plan"></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['treatment_plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Additional Notes
                            </label>
                            <textarea id="notes" 
                                      wire:model.live.debounce.500ms="notes" 
                                      rows="2"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Enter any additional notes"></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                            @click="closeModal()"
                            :disabled="isSubmitting">
                        Cancel
                    </button>
                    <button type="button" 
                            x-ref="saveButton"
                            class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                            @click="handleSubmit()"
                            :disabled="isSubmitting">
                        <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isSubmitting ? 'Saving...' : 'Save'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('livewire:initialized', () => {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').on('recordUpdated', () => {
                    // Refresh any parent components that need to update
                    Livewire.dispatch('refreshComponent');
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/medical-record-edit-modal.blade.php ENDPATH**/ ?>