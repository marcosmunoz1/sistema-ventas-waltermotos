<?php $__env->startSection('title'); ?>
    <?php echo e(config('adminlte.title')); ?>

    <?php if (! empty(trim($__env->yieldContent('subtitle')))): ?>
        | <?php echo $__env->yieldContent('subtitle'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content_header'); ?>
    <?php if (! empty(trim($__env->yieldContent('content_header_title')))): ?>
        <h1 class="text-muted">
            <?php echo $__env->yieldContent('content_header_title'); ?>

            <?php if (! empty(trim($__env->yieldContent('content_header_subtitle')))): ?>
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    <?php echo $__env->yieldContent('content_header_subtitle'); ?>
                </small>
            <?php endif; ?>
        </h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('content_body'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer'); ?>

    <div class="text-center">
        <p class="mb-0">
            &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.company_name', 'WalterMotos')); ?>

            - Todos los derechos reservados - Version 1.0.0
        </p>
       
    </div>


<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
<?php $__env->stopPush(); ?>



<?php $__env->startPush('css'); ?>
    <style type="text/css">
        
        /*
            .card-header {
                border-bottom: none;
            }
            .card-title {
                font-weight: 600;
            }
            */
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/layouts/app.blade.php ENDPATH**/ ?>