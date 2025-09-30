<?php $__env->startSection('title', 'Detalle Venta'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Ver-Detalle de Venta</b></h2>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-user"></i> Cliente </h6>
                        </div>
                        <div class="card-body">
                            <h6><strong>Cliente: </strong> <?php echo e($cliente->apellido_cliente); ?>,
                                <?php echo e($cliente->nombre_cliente); ?>

                            </h6>
                            <h6><strong>Email: </strong> <?php echo e($cliente->email_cliente); ?></h6>
                            <h6><strong>CUIT: </strong> <?php echo e($cliente->cuit_cliente); ?></h6>
                            <h6><strong>DNI: </strong> <?php echo e($cliente->dni_cliente); ?></h6>
                            <h6><strong>Fecha Nacimiento: </strong> <?php echo e(\Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y')); ?></h6>
                            <h6><strong>Telefono: </strong> <?php echo e($cliente->celular_cliente); ?></h6>
                            <h6><strong>Estado Civil: </strong> <?php echo e($cliente->estado_civil_cliente); ?>

                            </h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-user-friends"></i> Conyuge </h6>
                        </div>
                        <div class="card-body">
                            <div class="mx-2 mt-2">
                                <h6><strong>Conyugue:</strong>
                                    <?php echo e($cliente->conyugue->apellido_conyugue); ?>,
                                    <?php echo e($cliente->conyugue->nombre_conyugue); ?>

                                </h6>
                                <h6><strong>DNI:</strong> <?php echo e($cliente->conyugue->dni_conyugue); ?></h6>
                                <h6><strong>Fecha Nacimiento:</strong>
                                    <?php echo e(\Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('d-m-Y')); ?>

                                </h6>
                                <h6><strong>Teléfono:</strong>
                                    <?php echo e($cliente->conyugue->celular_conyugue); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-file-invoice-dollar"></i>
                                Valores </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <label>Fecha: </label>
                                <p class="mb-0 mx-2"><?php echo e(\Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y')); ?>

                                </p>
                            </div>
                            <div class="d-flex">
                                <label>Total: </label>
                                <p class="mb-0 mx-2"> $ <?php echo e(number_format($venta->precio_venta, 2, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-motorcycle"></i>
                                Moto </h6>
                        </div>
                        <div class="card-body">
                            <div class="mx-2 mt-2">
                                <div class="row">
                                    <div class="col-3">
                                        <h6><strong>Marca:</strong> <?php echo e($moto->marca->nombre_marca); ?></h6>
                                        <h6><strong>Modelo:</strong> <?php echo e($moto->modelo_moto); ?></h6>
                                        <h6><strong>Año:</strong> <?php echo e($moto->anio_moto); ?></h6>
                                        <h6><strong>Dominio:</strong> <?php echo e($moto->dominio); ?></span></h6>
                                    </div>
                                    <div class="col-4">
                                        <h6><strong>Color:</strong> <?php echo e($moto->color_moto); ?></span></h6>
                                        <h6><strong>Cilindradas:</strong> <?php echo e($moto->cilindrada_moto); ?>cc</span> </h6>
                                        <h6><strong>Nacionalidad:</strong> <?php echo e($moto->nacionalidad->pais); ?> </h6>
                                        <h6><strong>Km:</strong> <?php echo e($moto->km_moto); ?>km. </h6>
                                    </div>
                                    <div class="col-5">
                                        <h6><strong>DNRPA:</strong> <?php echo e($moto->dnrpa); ?></span> </h6>
                                        <h6><strong>Nro. Certificado:</strong> <?php echo e($moto->nr_certificado); ?></span></h6>
                                        <h6><strong>Nro. Motor:</strong> <?php echo e($moto->nr_motor); ?></span> </h6>
                                        <h6><strong>Nro. Chasis:</strong> <?php echo e($moto->nr_chasis); ?></span> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <!-- Botones de acción -->
              <div class="card-footer text-right">
                <a href="<?php echo e(url('admin/ventas')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/admin/ventas/show.blade.php ENDPATH**/ ?>