<?php $__env->startSection('title', 'Agregar Rol'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2 class="brand-text font-weight-light ">Admin/Roles/<b>Editar-Rol</b></h2>
    <hr>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifique los Datos</h3>
                    
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div class="card-body">
                        <div class="card card-info">
                            <form action="<?php echo e(url('/admin/roles',$rol->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del Rol</label>
                                        <input type="text"name="name" class="form-control" required
                                            value="<?php echo e($rol->name); ?>" placeholder="Ingrese un nombre de rol">
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
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-file-arrow-up"></i>
                                        Actualizar
                                    </button>
                                    <a href="<?php echo e(url('admin/roles')); ?>" class="btn btn-secondary">
                                        <i class="fas fa-cancel"></i> Cancelar
                                    </a>
                                </div>
                            </form>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\roles\edit.blade.php ENDPATH**/ ?>