<?php $__env->startSection('title', 'Sesion Caducada'); ?>

<?php $__env->startSection('content'); ?>

    <div class="text-center">
        <h1 class="text-info" style="font-size: 100px;">419</h1>
        <h3>La página expiró.</h3>
        <p>Debes volver a iniciar sesion para continuar.</p>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Iniciar sesión
        </a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\errors\419.blade.php ENDPATH**/ ?>