<?php $__env->startSection('title', 'Agregar Cliente'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-success mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Clientes/<b>Nuevo Cliente</b> </h2>
                        </div>
                    </div>

                    <div class="col-md-12 mx-auto mt-0">
                        <div
                            class="card-body <?php echo e($auth_type ?? 'login'); ?>-card-body <?php echo e(config('adminlte.classes_auth_body', '')); ?>">
                            <form action="<?php echo e(url('/admin/clientes/create')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <h5 class="text-center text-success"><i class="fas fa-id-card"></i> Datos Personales
                                </h5>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre</label>
                                            <input type="text" name="nombre_cliente" class="form-control" required
                                                value="<?php echo e(old('nombre_cliente')); ?>"
                                                placeholder="Ingrese nombre del cliente">
                                            <?php $__errorArgs = ['nombre_cliente'];
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_cliente">Apellido</label>
                                            <input type="text" name="apellido_cliente" class="form-control" required
                                                value="<?php echo e(old('apellido_cliente')); ?>"
                                                placeholder="Ingrese apellido del cliente">
                                            <?php $__errorArgs = ['apellido_cliente'];
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento_cliente">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento_cliente" class="form-control"
                                                required value="<?php echo e(old('fecha_nacimiento_cliente')); ?>">
                                            <?php $__errorArgs = ['fecha_nacimiento_cliente'];
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cuit_cliente">CUIT</label>
                                            <input type="text" name="cuit_cliente" class="form-control" required
                                                value="<?php echo e(old('cuit_cliente')); ?>" placeholder="Ingrese CUIT del cliente">
                                            <?php $__errorArgs = ['cuit_cliente'];
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni_cliente">DNI</label>
                                            <input type="text" name="dni_cliente" class="form-control" required
                                                value="<?php echo e(old('dni_cliente')); ?>" placeholder="Ingrese DNI del cliente">
                                            <?php $__errorArgs = ['dni_cliente'];
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="profesion">Profesión</label>
                                            <input type="text" name="profesion" class="form-control" required
                                                value="<?php echo e(old('profesion')); ?>"
                                                placeholder="Ingrese la profesion del cliente">
                                            <?php $__errorArgs = ['profesion'];
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
                                    <div class="col-md-3">
                                        <label>Estado civil</label>
                                        <select id="estado_civil_cliente" class="form-control" required
                                            name="estado_civil_cliente">
                                            <?php $__currentLoopData = $valores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($valor->value); ?>"
                                                    <?php echo e(old('estado_civil_cliente') == $valor->value ? 'selected' : ''); ?>>
                                                    <?php echo e(ucfirst($valor->value)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-body">
                                            <h5 class="text-center text-success mt-2"><i class="fas fa-phone-alt"></i>
                                                Datos
                                                De
                                                Contacto
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="celular_cliente">Celular</label>
                                                        <input type="text" name="celular_cliente" class="form-control"
                                                            required value="<?php echo e(old('celular_cliente')); ?>"
                                                            placeholder="Ingrese celular del cliente">
                                                        <?php $__errorArgs = ['celular_cliente'];
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

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Correo</label>
                                                    <input type="email" name="email_cliente" class="form-control" required
                                                        value="<?php echo e(old('email_cliente')); ?>"
                                                        placeholder="Ingrese un correo electrónico">
                                                    <?php $__errorArgs = ['email_cliente'];
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


                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card card-body">
                                            <h5 class="text-center text-success mt-2"><i class="fas fa-map-marker-alt"></i>
                                                Datos De Direccion
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="calle">Calle</label>
                                                        <input type="text" name="calle" class="form-control"
                                                            required value="<?php echo e(old('calle')); ?>"
                                                            placeholder="Ingrese la calle y numero del cliente">
                                                        <?php $__errorArgs = ['calle'];
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
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ciudad">Ciudad</label>
                                                        <input type="text" name="ciudad" class="form-control"
                                                            required value="<?php echo e(old('ciudad')); ?>"
                                                            placeholder="Ingrese la ciudad del cliente">
                                                        <?php $__errorArgs = ['ciudad'];
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="provincia">Provincia</label>
                                                        <input type="text" name="provincia" class="form-control"
                                                            required value="<?php echo e(old('provincia')); ?>"
                                                            placeholder="Ingrese la provincia del cliente">
                                                        <?php $__errorArgs = ['provincia'];
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

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card completa del cónyuge oculta por defecto -->
                                <div id="cardConyugue" class="d-none">
                                    <div class="row">
                                        <div class="card card-body border-success shadow-sm">
                                            <h5 class="text-center text-success mb-3">
                                                <i class="fas fa-user-friends"></i> Datos del Cónyuge
                                            </h5>

                                            <div id="camposConyugue">
                                                <div id="errorConyugue" class="alert alert-danger d-none">
                                                    Debe completar todos los datos del cónyuge para poder registrar al
                                                    cliente.
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="nombre_conyugue">Nombre</label>
                                                        <input type="text" class="form-control" id="nombre_conyugue"
                                                            name="nombre_conyugue" value="<?php echo e(old('nombre_conyugue')); ?>"
                                                            placeholder="Ingresar nombre del cónyuge">
                                                        <?php $__errorArgs = ['nombre_conyugue'];
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
                                                    <div class="form-group col-md-6">
                                                        <label for="apellido_conyugue">Apellido</label>
                                                        <input type="text" class="form-control" id="apellido_conyugue"
                                                            name="apellido_conyugue"
                                                            value="<?php echo e(old('apellido_conyugue')); ?>"
                                                            placeholder="Ingresar apellido del cónyuge">
                                                        <?php $__errorArgs = ['apellido_conyugue'];
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

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="dni_conyugue">DNI</label>
                                                        <input type="text" class="form-control" id="dni_conyugue"
                                                            name="dni_conyugue" value="<?php echo e(old('dni_conyugue')); ?>"
                                                            placeholder="Ingresar DNI del cónyuge">
                                                        <?php $__errorArgs = ['dni_conyugue'];
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
                                                    <div class="form-group col-md-6">
                                                        <label for="fecha_nacimiento_conyugue">Fecha de
                                                            Nacimiento</label>
                                                        <input type="date" class="form-control"
                                                            id="fecha_nacimiento_conyugue"
                                                            value="<?php echo e(old('fecha_nacimiento_conyugue')); ?>"
                                                            name="fecha_nacimiento_conyugue">
                                                        <?php $__errorArgs = ['fecha_nacimiento_conyugue'];
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

                                                <div class="form-group">
                                                    <label for="celular_conyugue">Celular</label>
                                                    <input type="text" class="form-control" id="celular_conyugue"
                                                        name="celular_conyugue" value="<?php echo e(old('celular_conyugue')); ?>"
                                                        placeholder="Ingresar celular del cónyuge">
                                                    <?php $__errorArgs = ['celular_conyugue'];
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
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" name="redirect" value="<?php echo e(request('redirect')); ?>">
                        <!-- Botones -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Registrar
                            </button>
                            <a href="<?php echo e(url('admin/clientes')); ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                        </form>
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
        $(document).ready(function() {
            function toggleConyugueCard() {
                var estadoCivil = $('#estado_civil_cliente').val();
                if (estadoCivil === 'Casado' || estadoCivil === 'En Concubinato') {
                    $('#cardConyugue').removeClass('d-none'); // mostrar card completa
                } else {
                    $('#cardConyugue').addClass('d-none'); // ocultar card completa
                    $('#cardConyugue input').val(''); // limpiar inputs
                }
            }

            $('#estado_civil_cliente').change(function() {
                toggleConyugueCard();
            });

            toggleConyugueCard(); // ejecutar al cargar la página
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\clientes\create.blade.php ENDPATH**/ ?>