<form wire:submit.prevent="save" class="space-y-6 bg-white dark:bg-gray-800 p-6 lg:my-14 rounded-xl shadow max-w-3xl mx-auto text-gray-900 dark:text-white">
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div>
        <label for="name" class="block font-medium">Full Name</label>
        <input type="text" wire:model.defer="form.name" id="name" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div>
        <label for="email" class="block font-medium">Email</label>
        <input type="email" wire:model.defer="form.email" id="email" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div>
        <label for="license_number" class="block font-medium">License Number</label>
        <input type="text" wire:model.defer="form.license_number" id="license_number" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div>
        <label for="specialty" class="block font-medium">Specialty</label>
        <input type="text" wire:model.defer="form.specialty" id="specialty" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
    </div>

    <div>
        <label for="biography" class="block font-medium">Biography</label>
        <textarea wire:model.defer="form.biography" id="biography" rows="3" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600"></textarea>
    </div>

    <div>
        <label for="phone_number" class="block font-medium">Phone Number</label>
        <input type="text" wire:model.defer="form.phone_number" id="phone_number" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
    </div>

    <div>
        <label for="vet_clinic_id" class="block font-medium">Vet Clinic</label>
        <select wire:model.defer="form.vet_clinic_id" id="vet_clinic_id" class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
            <option value="">-- Select Clinic --</option>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($clinic->id); ?>"><?php echo e($clinic->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </select>
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.vet_clinic_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div>
        <label class="block font-medium mb-1">Off Days</label>
        <div class="flex flex-wrap gap-2">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model.defer="form.off_days" value="<?php echo e($day); ?>" class="mr-1">
                    <?php echo e($day); ?>

                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Vet</button>
    </div>
</form>
<?php /**PATH /var/www/html/resources/views/livewire/admin/vets-create.blade.php ENDPATH**/ ?>