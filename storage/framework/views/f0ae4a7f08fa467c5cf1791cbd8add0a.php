<?php $__env->startComponent('mail::layout'); ?>
<?php $__env->slot('header'); ?>
<?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>

# Password Reset Request

You are receiving this email because we received a password reset request for your account.

<?php $__env->startComponent('mail::button', ['url' => $resetUrl, 'color' => 'primary']); ?>
Reset Password
<?php echo $__env->renderComponent(); ?>

This password reset link will expire in <?php echo e($expire); ?> minutes.

If you did not request a password reset, no further action is required.

For security reasons, this link will expire in <?php echo e($expire); ?> minutes or until you request another password reset.

If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:

[<?php echo e($resetUrl); ?>](<?php echo e($resetUrl); ?>)

<?php $__env->slot('footer'); ?>
<?php $__env->startComponent('mail::footer'); ?>
&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.

<?php $__env->startComponent('mail::subcopy'); ?>
If you're having trouble with the button above, copy and paste the URL below into your web browser:
[<?php echo e($resetUrl); ?>](<?php echo e($resetUrl); ?>)
<?php echo $__env->renderComponent(); ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/html/resources/views/emails/password-reset.blade.php ENDPATH**/ ?>