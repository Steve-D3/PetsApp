<div class="mx-auto lg:mt-28 p-4 sm:p-6 bg-white dark:bg-gray-800 text-black dark:text-white rounded-xl shadow max-w-full sm:max-w-4xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Add New Pet</h2>

    <form wire:submit.prevent="submit" class="lg:grid lg:grid-cols-2 lg:gap-8 space-y-6 lg:space-y-0">
        
        <div class="space-y-6">
            <div>
                <label class="block font-semibold mb-1">Select Existing User</label>
                <select wire:model="existingUserId" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded">
                    <option value="">-- New User --</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>
            </div>

            <!--[if BLOCK]><![endif]--><?php if(!$existingUserId): ?>
                <div class="space-y-4">
                    <div>
                        <label>Name</label>
                        <input type="text" wire:model="newUser.name" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" wire:model="newUser.email" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                    </div>
                    <div>
                        <label>Phone (optional)</label>
                        <input type="text" wire:model="newUser.phone" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Pet Name</label>
                    <input type="text" wire:model="pet.name" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div>
                    <label>Species</label>
                    <input type="text" wire:model="pet.species" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div>
                    <label>Breed</label>
                    <input type="text" wire:model="pet.breed" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div>
                    <label>Microchip Number</label>
                    <input type="text" wire:model="pet.microchip_number" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div>
                    <label>Sterilized</label>
                    <select wire:model="pet.sterilized" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div>
                    <label>Gender</label>
                    <select wire:model="pet.gender" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded">
                        <option value="">--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <label>Weight (kg)</label>
                    <input type="number" step="0.01" wire:model="pet.weight" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div>
                    <label>Birth Date</label>
                    <input type="date" wire:model="pet.birth_date" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded" />
                </div>
                <div class="md:col-span-2">
                    <label>Allergies</label>
                    <textarea wire:model="pet.allergies" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label>Food Preferences</label>
                    <textarea wire:model="pet.food_preferences" class="w-full bg-gray-800 text-white border border-gray-700 px-4 py-2 rounded"></textarea>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-2 text-center pt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Save Pet
            </button>
        </div>
    </form>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/pets-create.blade.php ENDPATH**/ ?>