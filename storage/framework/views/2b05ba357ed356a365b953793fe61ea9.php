<?php $__env->startSection('title', 'Proveedores'); ?>

<?php $__env->startSection('content_header'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Proveedores</h2>
                        <a href="<?php echo e(url('admin/proveedores/crear-proveedor')); ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Proveedor
                        </a>
                    </div>
                </div>

                <div class="col-md-12 mx-auto">
                    <div class="card-body">

                        <table id="tablaProveedores" class="table table-striped table-sm table-responsive">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%">#</th>
                                    <th class="text-center" style="width: 15%">Nombre</th>
                                    <th class="text-center" style="width: 15%">CUIT</th>
                                    <th class="text-center" style="width: 15%">Telefono</th>
                                    <th class="text-center" style="width: 15%">Celular</th>
                                    <th class="text-center" style="color:red 5%">Estado</th>
                                    <th class="text-center" style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <?php $contador = 1; ?>
                            <tbody>
                                <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle"><?php echo e($contador++); ?></td>
                                        <td style="vertical-align: middle"> <?php echo e($proveedor->nombre_proveedor); ?></td>
                                        <td class="text-center" style="vertical-align: middle"><?php echo e($proveedor->cuit); ?></th>
                                        <td class="text-center" style="text-align: right; vertical-align: middle;">
                                            <?php echo e($proveedor->telefono); ?></td>
                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                            <?php echo e($proveedor->celular); ?> </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <span
                                                class="badge <?php echo e($proveedor->estado_proveedor == 1 ? 'bg-success' : 'bg-danger'); ?>">
                                                <?php echo e($proveedor->estado_proveedor == 1 ? 'Activo' : 'Inactivo'); ?>

                                            </span>
                                        </td>

                                        <td class="text-center" style="vertical-align: middle">
                                            <div class="btn-group " role="group" aria-label="Basic example">
                                                <a href="<?php echo e(url('/admin/proveedores', $proveedor->id)); ?>"
                                                    class="btn btn-sm btn-info disabled"  aria-disabled="true"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-warning disabled" tabindex="-1"
                                                    aria-disabled="true">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?php echo e(url('/admin/proveedores', $proveedor->id)); ?>"
                                                    method="post" class="d-inline-block"
                                                    onsubmit="preguntar(event, <?php echo e($proveedor->id); ?>)"
                                                    id="miFormulario<?php echo e($proveedor->id); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        style="border-radius: 0px 4px 4px 0px">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar este proveedor?',
                text: 'Los cambios seran permanentes',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonColor: '#270a0a',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('miFormulario' + id);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>

    <script>
        $('#tablaProveedores').DataTable({
            ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\proveedores\index.blade.php ENDPATH**/ ?>