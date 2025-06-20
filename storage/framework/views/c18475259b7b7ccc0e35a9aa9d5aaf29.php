<div x-data="{
    isOpen: <?php if ((object) ('isOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'->value()); ?>')<?php echo e('isOpen'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'); ?>')<?php endif; ?>,
    record: <?php if ((object) ('record') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('record'->value()); ?>')<?php echo e('record'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('record'); ?>')<?php endif; ?>.defer,
    isLoading: false,
    
    init() {
        // Listen for the open-detail-modal event
        this.$wire.on('open-detail-modal', (recordId) => {
            this.isOpen = true;
            this.isLoading = true;
            
            if (typeof recordId === 'object' && recordId.recordId) {
                recordId = recordId.recordId;
            }
            
            this.$wire.openModal(recordId).then(() => {
                this.isLoading = false;
                // Focus on the modal when opened
                this.$nextTick(() => {
                    const modal = this.$refs.modal;
                    if (modal) {
                        modal.focus();
                    }
                });
            });
        });
        
        // Close on escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeModal();
            }
        };
        
        document.addEventListener('keydown', handleEscape);
        
        // Cleanup event listener when component is destroyed
        this.$on('destroy', () => {
            document.removeEventListener('keydown', handleEscape);
        });
    },
    
    closeModal() {
        if (this.isLoading) return;
        
        this.isOpen = false;
        this.$wire.closeModal();
        
        // Reset any form state
        this.$nextTick(() => {
            this.$wire.resetErrorBag();
        });
    },
    
    handleBackdropClick(e) {
        // Close modal when clicking outside the modal content
        if (e.target.id === 'modal-backdrop') {
            this.closeModal();
        }
    }
}" 
     x-show="isOpen" 
     x-cloak
     @keydown.escape.window="closeModal"
     class="fixed inset-0 z-50 overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true"
     @click.self="handleBackdropClick"
     x-ref="modal"
     tabindex="-1">
    <!-- Backdrop -->
    <div x-show="isOpen" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
         @click="closeModal">
    </div>

    <!-- Modal content -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6">
            
            <!-- Close button -->
            <div class="absolute right-0 top-0 pr-4 pt-4">
                <button type="button" 
                        @click="closeModal"
                        class="rounded-md bg-white dark:bg-gray-700 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Loading state -->
            <div x-show="isLoading" class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
            </div>

            <!-- Error state -->
            <div x-show="!isLoading && $wire.hasError('record')" class="p-4 bg-red-50 dark:bg-red-900/20 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            <?php echo e($errors->first('record')); ?>

                        </h3>
                    </div>
                </div>
            </div>

            <!-- Record details -->
            <div x-show="!isLoading && record" class="space-y-6">
                <!-- Header -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                        Medical Record Details
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        View and manage medical record details
                    </p>
                </div>

                <!-- Record content -->
                <div class="space-y-4">
                    <!-- Record info -->
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pet</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    <?php echo e(isset($record['pet']['name']) ? $record['pet']['name'] : 'N/A'); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Veterinarian</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    <?php echo e(isset($record['veterinarian']['name']) ? $record['veterinarian']['name'] : 'N/A'); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Record Date</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    <!--[if BLOCK]><![endif]--><?php if(isset($record['record_date']) && $record['record_date']): ?>
                                        <?php echo e(\Carbon\Carbon::parse($record['record_date'])->format('M d, Y h:i A')); ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Appointment</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    <!--[if BLOCK]><![endif]--><?php if(isset($record['appointment']) && $record['appointment']): ?>
                                        <?php echo e(\Carbon\Carbon::parse($record['appointment']['appointment_date'])->format('M d, Y h:i A')); ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Medical details -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Symptoms / Chief Complaint</h4>
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-md p-4 border border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                    <?php echo e($record['symptoms'] ?? 'No symptoms recorded'); ?>

                                </p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Diagnosis</h4>
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-md p-4 border border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                    <?php echo e($record['diagnosis'] ?? 'No diagnosis recorded'); ?>

                                </p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Treatment Plan</h4>
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-md p-4 border border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                    <?php echo e($record['treatment_plan'] ?? 'No treatment plan recorded'); ?>

                                </p>
                            </div>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if(!empty($record['notes'])): ?>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Additional Notes</h4>
                                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-md p-4 border border-gray-200 dark:border-gray-700">
                                    <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                        <?php echo e($record['notes']); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                    <button type="button"
                            @click="$dispatch('edit-record', { recordId: record.id }); closeModal();"
                            class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Record
                    </button>
                    <button type="button"
                            @click="closeModal"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600 sm:col-start-1 sm:mt-0">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- Include the edit modal -->
<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.medical-record-edit-modal', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2147790133-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php /**PATH /var/www/html/resources/views/livewire/admin/medical-record-detail-modal.blade.php ENDPATH**/ ?>