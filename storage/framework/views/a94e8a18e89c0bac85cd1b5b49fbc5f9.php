<?php $__env->startSection('title', 'Ver Usuario'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2 class="brand-text font-weight-light">Admin/Usuarios/<b>Ver-Usuario</b></h2>
    <hr>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos de Usuario</h3>
                </div>

                <div class="col-md-8 mx-auto mt-4">
                    <div class="card card-info">
                        <div class="card-body">


                            <!-- Muestra datos de usuario -->
                            <div class="d-flex mb-3">
                                <label for="name" class="mr-2">Nombre de Usuario:</label>
                                <p class="mb-0"><?php echo e($usuario->name); ?></p>
                            </div>

                            <div class="d-flex mb-3">
                                <label for="role" class="mr-2">Rol:</label>
                                <p class="mb-0"><?php echo e($usuario->roles->pluck('name')->implode(', ')); ?></p>
                            </div>

                            <div class="d-flex  mb-3">
                                <label for="email" class="mr-2">Correo:</label>
                                <p class="mb-0"><?php echo e($usuario->email); ?></p>
                            </div>

                            <div class="d-flex  mb-3">
                                <label for="" class="mr-2">Datos de Registro:</label>
                                <p class="mb-0"><?php echo e($usuario->created_at); ?></p>
                            </div>

                            <!-- Botones de acción -->
                            <div class="card-footer text-right">
                                <a href="<?php echo e(url('admin/usuarios')); ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\usuarios\show.blade.php ENDPATH**/ ?>