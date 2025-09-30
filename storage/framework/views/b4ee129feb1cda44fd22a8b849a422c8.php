<?php $__env->startSection('title', 'Acceso Denegado'); ?>

<?php $__env->startSection('content'); ?>

    <div class="text-center">
        <h1 class="text-yellow" style="font-size: 100px;">403</h1>
        <h3>Acceso no autorizado</h3>
        <p>No tenés permisos para realizar esta acción.</p>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Ir al inicio</a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/errors/403.blade.php ENDPATH**/ ?>