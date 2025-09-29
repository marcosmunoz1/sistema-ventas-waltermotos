<?php $__env->startSection('title', 'Ventas'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-md-12">
           <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Ventas</h2>
                        <a href="<?php echo e(url('admin/ventas/crear-venta')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Nueva Venta</a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="miTabla">
                                <thead class="table-primary">
                                    <tr>

                                        <th class="text-center" style="width: 10%">Fecha</th>
                                        <th class="text-center" style="width: 5%">Numero</th>
                                        <th class="text-center" style="width: 15%">Cliente</th>
                                        <th class="text-center" style="width: 5%">P. Venta</th>
                                        <th class="text-center" style="width: 5%">Interes Mora</th>
                                        <th class="text-center" style="width: 5%">Total Pagado</th>
                                        <th class="text-center" style="width: 5%">Forma</th>
                                        <th class="text-center" style="width: 5%">Estado</th>
                                        <th class="text-center" style="width: 10%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"style="vertical-align: middle">
                                                <?php echo e(\Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y')); ?>


                                            </td>
                                            <td class="text-center"style="vertical-align: middle"> <?php echo e($venta->id_venta); ?>

                                            <td style="vertical-align: middle">
                                                <?php echo e($venta->cliente->apellido_cliente); ?>,
                                                <?php echo e($venta->cliente->nombre_cliente); ?> </td>
                                            <td class="text-success text-right" style="vertical-align: middle">
                                                $<?php echo e(number_format($venta->precio_venta, 2, ',', '.')); ?></td>
                                            <td class="text-right" style="vertical-align: middle">
                                                $<?php echo e(number_format($venta->total_interes, 2, ',', '.')); ?></td>
                                            <td class="text-danger text-right" style="vertical-align: middle">
                                                $<?php echo e(number_format($venta->total_pago, 2, ',', '.')); ?></td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <?php
                                                    $color = $venta->forma_pago === 'Contado' ? 'primary' : 'warning';
                                                ?>
                                                <span
                                                    class="badge bg-<?php echo e($color); ?>"><?php echo e(ucfirst($venta->forma_pago)); ?></span>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle">
                                                <span
                                                    class="badge <?php echo e($venta->estado_venta == 'Pagado' ? 'bg-success' : 'bg-danger'); ?>">
                                                    <?php echo e($venta->estado_venta); ?>

                                                </span>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="<?php echo e(url('/admin/ventas/' . $venta->id_venta)); ?>"
                                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                    
                                                    <a href="<?php echo e(url('/admin/ventas/reporte/' . $venta->id_venta)); ?>"
                                                        class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>
                                                    <form action="<?php echo e(url('/admin/ventas', $venta->id_venta)); ?>"
                                                        method="post" class="d-inline-block"
                                                        onsubmit="preguntar(event, <?php echo e($venta->id_venta); ?>)"
                                                        id="miFormulario<?php echo e($venta->id_venta); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 0px 4px 4px 0px">
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
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar esta Venta?',
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
        $('#miTabla').DataTable({
            ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                "lengthMenu": "Mostrar _MENU_ Ventas",
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/admin/ventas/index.blade.php ENDPATH**/ ?>