<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100"><?php echo e($title); ?></h3>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            <?php echo e($description); ?>

        </p>
    </div>

    <div class="px-4 sm:px-0">
        <?php echo e($aside ?? ''); ?>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/section-title.blade.php ENDPATH**/ ?>