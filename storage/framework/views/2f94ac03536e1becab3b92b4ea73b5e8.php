<?php $__env->startSection('content'); ?>
    <div class="row mt-2">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger zoomP">
                <div class="inner">
                    <h3>Motos</h3>
                    <p>Registradas: <?php echo e($cantidadMotos); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <a href="<?php echo e(url('/admin/motos')); ?>" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning zoomP">
                <div class="inner">
                    <h3>Créditos</h3>
                    <p>Registrados: <?php echo e($cantidadCreditos); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <a href="<?php echo e(url('/admin/creditos')); ?>" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success zoomP">
                <div class="inner">
                    <h3>Ventas</h3>
                    <p>Registradas: <?php echo e($cantidadVentas); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-cash-register"></i>
                </div>
                <a href="<?php echo e(url('/admin/ventas')); ?>" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info zoomP">
                <div class="inner">
                    <h3>Clientes</h3>
                    <p>Registrados: <?php echo e($cantidadClientes); ?></p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <a href="<?php echo e(url('/admin/clientes')); ?>" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark zoomP">
                <div class="inner">
                    <h3>Proveedores</h3>
                    <p>Registrados: <?php echo e($cantidadProveedores); ?></p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <a href="<?php echo e(url('/admin/proveedores')); ?>" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-light zoomP">
                <div class="inner">
                    <h3>Compras</h3>
                    <p>Registradas: <?php echo e($cantidadCompras); ?></p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <a href="<?php echo e(url('/admin/compras')); ?>" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary zoomP">
                <div class="inner">
                    <h3>Roles</h3>
                    <p>Registrados: <?php echo e($cantidadRoles); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <a href="<?php echo e(url('/admin/roles')); ?>" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary zoomP">
                <div class="inner">
                    <h3>Usuarios</h3>
                    <p>Registrados: <?php echo e($cantidadUsuarios); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?php echo e(url('/admin/usuarios')); ?>" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Resumen mensual de los montos de ventas</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Resumen de la cantidad de ventas mensuales</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('css'); ?>
    
    
<?php $__env->stopPush(); ?>



<?php $__env->startPush('js'); ?>
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>

    <?php
    $meses = array_fill(1, 12, 0);
    $suma_ventas = array_fill(1, 12, 0);

    foreach ($ventas as $venta) {
        $fecha = strtotime($venta['fecha_venta']);
        // Verifica que strtotime() haya devuelto una fecha válida
        if ($fecha !== false) {
            $mes = date('m', $fecha);
            $meses[(int) $mes]++;
            $suma_ventas[(int) $mes] += $venta['total_pago'];
        } else {
            // Maneja el caso en que la fecha no sea válida (si es necesario)
            echo 'Fecha inválida: ' . $venta['fecha_venta'] . '<br>';
        }
    }
    $reporte_cantidad = implode(',', $meses);
    $reporte_ventas = implode(',', $suma_ventas);
    ?>

    <script>
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiempre', 'Octubre',
            'Noviembre', 'Diciembre'
        ];
        var datos = [<?php echo e($reporte_cantidad); ?>];
        const ctx2 = document.getElementById('myChart')

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Total cantidad de ventas',
                    data: datos,
                    borderWidtch: 1

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
    <script>
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiempre', 'Octubre',
            'Noviembre', 'Diciembre'
        ]
        var datos = [<?php echo e($reporte_ventas); ?>]
        const ctx = document.getElementById('myChart2')

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Monto Total de ventas',
                    data: datos,
                    borderWidtch: 1

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\index.blade.php ENDPATH**/ ?>