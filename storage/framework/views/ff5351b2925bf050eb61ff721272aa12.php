<?php $__env->startSection('title', 'Detalle Credito'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Creditos/Detalle de Credito:
                            <b><?php echo e($credito->venta->cliente->apellido_cliente); ?>,
                            <?php echo e($credito->venta->cliente->nombre_cliente); ?> </b>
                        </h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped" id="miTabla">
                                    <thead class="table-info">
                                        <tr>
                                            <th class="text-center" style="width: 5%">Cuota</th>
                                            <th class="text-center" style="width: 5%">Vencimiento</th>
                                            <th class="text-center" style="width: 15%">Fecha Pago</th>
                                            <th class="text-center" style="width: 5%">Valor</th>
                                            <th class="text-center" style="width: 5%">Interes x Mora</th>
                                            <th class="text-center" style="width: 5%">Estado</th>

                                        </tr>
                                    </thead>
                                    <?php $contador = 1; ?>
                                    <tbody>
                                        <?php $__currentLoopData = $credito->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>

                                                <td class="text-center" style="vertical-align: middle">
                                                    <?php echo e($detalle->numero_cuota); ?></td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <?php echo e(\Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d-m-Y')); ?>

                                                <td class="text-center" style="vertical-align: middle">
                                                    <?php if($detalle->fecha_pago): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($detalle->fecha_pago)->format('d-m-Y')); ?>

                                                    <?php else: ?>
                                                        Impaga
                                                    <?php endif; ?>

                                                </td>
                                                <td class="text-success text-center" style="vertical-align: middle">
                                                    $<?php echo e(number_format($detalle->valor_cuota, 2, ',', '.')); ?>

                                                </td>
                                                <td class="text-info text-right" style="vertical-align: middle">
                                                    $<?php echo e(number_format($detalle->interes_mora, 2, ',', '.')); ?>

                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge <?php echo e($detalle->estado_cuota == 'Pendiente' ? 'bg-danger' : 'bg-success'); ?>">
                                                        <?php echo e($detalle->estado_cuota); ?>

                                                    </span>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body mt-2">
                            <div class="d-flex"><label>Fecha: </label>
                                <p class="mb-0 mx-2">
                                    <?php echo e(\Carbon\Carbon::parse($credito->venta->fecha_venta)->format('d-m-Y')); ?>

                                </p>
                            </div>
                            <div class="d-flex"><label>Total de Venta: </label>
                                <p class="mb-0 mx-2"> $
                                    <?php echo e(number_format($credito->venta->precio_venta, 2, ',', '.')); ?>

                                </p>
                            </div>
                            <div class="d-flex"><label>Entrega: </label>
                                <p class="mb-0 mx-2"> $
                                    <?php echo e(number_format($credito->entrega, 2, ',', '.')); ?>

                                </p>
                            </div>
                            <div class="d-flex"><label>Total Financiado</label>
                                <p class="mb-0 mx-2"> $
                                    <?php echo e(number_format($credito->valor_financiado, 2, ',', '.')); ?></p>
                            </div>
                            <div class="d-flex"><label>Interés de Credito:</label>
                                <p class="mb-0 mx-2"><?php echo e($credito->interes); ?> %</p>
                            </div>
                            <div class="d-flex"><label>Cuotas:</label>
                                <p class="mb-0 mx-2"><?php echo e($credito->cantidad_cuotas); ?> </p>
                            </div>
                            <div class="d-flex"><label>Interés por Mora:</label>
                                <p class="mb-0 mx-2 text-info">$
                                    <?php echo e(number_format($credito->total_interes, 2, ',', '.')); ?></p>

                            </div>
                            <div class="d-flex"><label>Total Cancelado</label>
                                <p class="mb-0 mx-2 text-green">$
                                    <?php echo e(number_format($credito->venta->total_pago, 2, ',', '.')); ?></p>
                            </div>
                            <div class="d-flex"><label>Saldo de Crédito</label>
                                <p class="mb-0 mx-2 text-red">$
                                    <?php echo e(number_format($credito->saldo_credito, 2, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Botones de acción -->
    <div class="card-footer text-right mb-2">
        <a href="<?php echo e(url('admin/creditos')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    <style>
        .input-group-text {
            width: 50%;
            display: inline-block;
            text-align: right;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\creditos\show.blade.php ENDPATH**/ ?>