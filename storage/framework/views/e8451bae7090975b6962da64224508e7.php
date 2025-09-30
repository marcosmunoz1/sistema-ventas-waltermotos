<?php $__env->startSection('title', 'Asignar Permiso'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2 class="brand-text font-weight-light ">Asignar Permisos al Rol: <b><?php echo e($rol->name); ?></b></h2>
    <hr>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="select-all">
                    <label class="form-check-label" for="select-all">Seleccionar todos</label>
                </div>
            </div>

            <form action="<?php echo e(url('/admin/roles/asignar', $rol->id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> <!-- Si estás actualizando un rol -->

                <div class="card-body">
                    <div class="row">
                        <?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modulo => $grupoPermisos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2">
                                <h3><?php echo e($modulo); ?></h3>
                                <?php $__currentLoopData = $permisosDivididos[$modulo]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <!-- Acceder correctamente a los permisos divididos -->
                                    <div class="col-md-12">
                                        <?php $__currentLoopData = $grupo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input permiso-checkbox"
                                                    name="permisos[]" value="<?php echo e($permiso->id); ?>"
                                                    <?php echo e($rol->hasPermissionTo($permiso->name) ? 'checked' : ''); ?>>
                                                <label class="form-check-label"><?php echo e($permiso->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>


                <!-- Botones de acción -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                    <a href="<?php echo e(url('admin/roles')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
    <style>
        .permissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .permission-column {
            display: flex;
            flex-direction: column;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            // Obtén todos los checkboxes de permisos
            const checkboxes = document.querySelectorAll('.permiso-checkbox');

            // Si el checkbox "Seleccionar todos" está marcado
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\roles\asignar.blade.php ENDPATH**/ ?>