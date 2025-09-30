<?php $__env->startSection('title', 'Cobrar Cuotas'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Creditos/Cobrar Cuota:
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
                                            <th class="text-center" style="width: 5%">Interes</th>
                                            <th class="text-center" style="width: 5%">Estado</th>
                                            <th class="text-center" style="width: 5%">Cobrar</th>
                                            <th class="text-center" style="width: 5%">Imprimir</th>

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
                                                <td class="text-danger text-center" style="vertical-align: middle">
                                                    $<?php echo e(number_format($detalle->interes_mora, 2, ',', '.')); ?>

                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge <?php echo e($detalle->estado_cuota == 'Pendiente' ? 'bg-danger' : 'bg-success'); ?>">
                                                        <?php echo e($detalle->estado_cuota); ?>

                                                    </span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <input type="radio" name="cuota_seleccionada" class="fila-check"
                                                        value="<?php echo e($detalle->id); ?>"
                                                        data-numero-cuota="<?php echo e($detalle->numero_cuota); ?>"
                                                        data-valor-cuota="<?php echo e($detalle->valor_cuota); ?>"
                                                        <?php if($detalle->estado_cuota !== 'Pendiente'): ?> disabled <?php endif; ?>>

                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php if($detalle->estado_cuota !== 'Pendiente'): ?>
                                                        <a href="<?php echo e(url('/admin/creditos/reporte', $detalle->id)); ?>"
                                                            class="btn btn-sm btn-secondary">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-sm btn-secondary disabled" aria-disabled="true">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="card card-footer text-center">
                                <h5 class="text-center text-success"><i class="fa-solid fa-hand-holding-dollar"></i>
                                    Pago de Cuotas
                                </h5>
                            </div>

                            <form action="<?php echo e(url('/admin/creditos/cobrar-cuotas')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id_credito" value="<?php echo e($credito->id); ?>">

                                <div class="mx-2 mt-2 mb-2">

                                    <!-- Campo Fecha -->
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-text">Fecha:</span>
                                            <input type="date" id="fecha" name="fecha"
                                                value="<?php echo e(old('fecha', date('Y-m-d'))); ?>" class="form-control" required>
                                            <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <!-- Monto a pagar -->
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-text">Valor a Cancelar: $</span>
                                            <input type="number" id="precioTotal" name="precioTotal"
                                                class="form-control text-danger" readonly>
                                        </div>
                                        <?php $__errorArgs = ['precioTotal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Corresponde a Cuotas:</span>
                                        <input type="text" id="cuotas" name="cuotas" class="form-control" readonly>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text">Interes:</span>
                                        <input type="number" id="interes" name="interes" class="form-control">
                                        <span class="input-group-text"
                                            style="width: 80px; display: inline-block;  text-align: left;">%</span>
                                    </div>
                                    <hr>
                                    <div class="input-group">
                                        <span class="input-group-text">TOTAL:</span>
                                        <input type="number" step="0.01" id="total" name="total"
                                            class="form-control">
                                    </div>

                                    <!-- Botones de acción -->
                                    <div id="cuotasInputsContainer"></div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save"></i> Cobrar
                                        </button>
                                    </div>
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
    
    <script>
        const checkboxes = document.querySelectorAll('.fila-check');
        const totalInput = document.getElementById('precioTotal');
        const cuotasInput = document.getElementById('cuotas');
        const interesInput = document.getElementById('interes');
        const totalConInteresInput = document.getElementById('total');
        const cuotasContainer = document.getElementById('cuotasInputsContainer');

        let cuotasSeleccionadas = [];

        function actualizarTotalConInteres() {
            const subtotal = parseFloat(totalInput.value) || 0;
            const interes = parseFloat(interesInput.value) || 0;
            const totalFinal = subtotal + (subtotal * interes / 100);
            totalConInteresInput.value = totalFinal.toFixed(2);
        }

        interesInput.addEventListener('input', actualizarTotalConInteres);

        function renderizarInputsOcultos() {
            cuotasContainer.innerHTML = ''; // Limpiar anteriores
            cuotasSeleccionadas.forEach((cuota, index) => {
                cuotasContainer.insertAdjacentHTML('beforeend', `
                    <input type="hidden" name="cuotas[${index}][id]" value="${cuota.id}">
                    <input type="hidden" name="cuotas[${index}][numero_cuota]" value="${cuota.numero_cuota}">
                    <input type="hidden" name="cuotas[${index}][valor_cuota]" value="${cuota.valor_cuota}">
                `);
            });
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const id = this.value;
                const numero_cuota = this.dataset.numeroCuota;
                const valor_cuota = parseFloat(this.dataset.valorCuota);

                if (this.checked) {
                    // Desmarcar todos los demás
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });

                    // Array solo con la cuota seleccionada
                    cuotasSeleccionadas = [{
                        id,
                        numero_cuota,
                        valor_cuota
                    }];
                } else {
                    // Si se desmarca, array vacío
                    cuotasSeleccionadas = [];
                }

                // Actualizar total y número de cuota (solo el seleccionado)
                if (cuotasSeleccionadas.length > 0) {
                    totalInput.value = cuotasSeleccionadas[0].valor_cuota.toFixed(2);
                    cuotasInput.value = cuotasSeleccionadas[0].numero_cuota;
                } else {
                    totalInput.value = '';
                    cuotasInput.value = '';
                }

                actualizarTotalConInteres();
                renderizarInputsOcultos();
            });
        });
    </script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\creditos\cobrar-cuotas.blade.php ENDPATH**/ ?>