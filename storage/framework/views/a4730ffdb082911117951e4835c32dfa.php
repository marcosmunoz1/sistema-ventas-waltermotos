<?php $__env->startSection('title', 'Ver Permiso'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Permisos/<b>Ver Premiso</b> </h2>
                    </div>
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">

                    <div class="card card-body mt-4 card-info">
                        <div
                            class="card-body <?php echo e($auth_type ?? 'login'); ?>-card-body <?php echo e(config('adminlte.classes_auth_body', '')); ?>">

                            <div class="d-flex mb-3">
                                <label for="name" class="mr-2">Nombre del Permiso:</label>
                                <p class="mb-0"><?php echo e($permiso->name); ?></p>
                            </div>

                            <div class="card-footer">
                                <a href="<?php echo e(url('admin/permisos')); ?>" class="btn btn-secondary float-right">
                                    <i class="fa-solid fa-arrow-left"></i> Volver
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\permisos\show.blade.php ENDPATH**/ ?>