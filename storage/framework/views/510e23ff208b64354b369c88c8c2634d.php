<?php $__env->startSection('title', 'Agregar Permiso'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12">
            <div class="card card-outline card-success mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Permisos/<b>Nuevo Premiso</b> </h2>
                    </div>
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div
                        class="card-body <?php echo e($auth_type ?? 'login'); ?>-card-body <?php echo e(config('adminlte.classes_auth_body', '')); ?>">

                        <div class="card card-info">
                            <form action="<?php echo e(url('/admin/permisos/crear-permiso')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del Permiso</label>
                                        <input type="text"name="name" class="form-control" required
                                            value="<?php echo e(old('name')); ?>" placeholder="Ingrese un nombre">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small style="color: red;"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <!-- Botones de acción -->
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Registrar
                                    </button>
                                    <a href="<?php echo e(url('admin/permisos')); ?>" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>

                            </form>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\permisos\create.blade.php ENDPATH**/ ?>