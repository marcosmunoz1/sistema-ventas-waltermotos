<?php $__env->startSection('title', 'Página no encontrada'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center">
        <h1 class="text-danger" style="font-size: 100px;">404</h1>
        <h3>La página que buscas no existe</h3>
        <p>Es posible que el enlace esté roto o que la página haya sido eliminada.</p>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Ir al inicio</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\errors\404.blade.php ENDPATH**/ ?>