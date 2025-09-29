<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-success mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Compras/<b>Nueva Compra</b> </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.compras.store')); ?>" id="form_compra" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="proveedor">Proveedor</label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-toggle="modal" data-target="#exampleModal_proveedor">
                                                <i class="fas fa-search"></i> Buscar
                                            </button>
                                            <input type="text" class="form-control mx-1" id="nombre_proveedor" readonly>
                                            <input type="hidden" id="id_proveedor" name="id_proveedor">

                                            <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                data-target="#modalAgregarProveedor">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <?php $__errorArgs = ['id_proveedor'];
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

                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Factura</label>
                                        <input type="text" value="<?php echo e(old('numero_factura')); ?>" class="form-control"
                                            id="numero_factura" name="numero_factura" placeholder="Nr. de factura" required>
                                        <?php $__errorArgs = ['numero_factura'];
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

                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remito</label>
                                        <input type="text" value="<?php echo e(old('numero_remito')); ?>" class="form-control"
                                            id="numero_remito" name="numero_remito" placeholder="Nr. de remito" required>
                                        <?php $__errorArgs = ['numero_remito'];
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

                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha compra</label>
                                        <input type="date" value="<?php echo e(old('fecha_compra')); ?>" name="fecha_compra"
                                            id="fecha_compra" class="form-control" required>
                                    </div>
                                </div>

                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="estado_compra">Estado <b>*</b></label>
                                        <select class="form-control" name="estado_compra" required>
                                            <option value="">-- Seleccionar estado --</option>
                                            <option value="Pagado" <?php echo e(old('estado_compra') == 'Pagado' ? 'selected' : ''); ?>>
                                                Pagado</option>
                                            <option value="Pendiente"
                                                <?php echo e(old('estado_compra') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente
                                            </option>
                                        </select>
                                        <?php $__errorArgs = ['estado_compra'];
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
                            <hr>
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                        data-target="#crearMotoModal"><i class="fa-solid fa-cart-shopping"></i> Agregar
                                        moto</button>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped table-sm table-responsiv" id="tabla-motos">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 10%">Marca</th>
                                        <th class="text-center" style="width: 10%">Modelo</th>
                                        <th class="text-center" style="width: 10%">Color</th>
                                        <th class="text-center" style="width: 10%">Año</th>
                                        <th class="text-center" style="width: 10%">Cilindrada</th>
                                        <th class="text-center" style="width: 10%">Precio Compra</th>
                                        <th class="text-center" style="width: 10%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se insertan dinámicamente con JS -->
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" style="text-align: center;background-color: #e9e710"
                                            type="hidden" name="total_compra" id="precio_total_input" value="0"
                                            required>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end fw-bold text-primary">
                            <h3 class="sw-bold text-primary bg-success px-2  py-2 rounded">
                                TOTAL: <span id="total_compra_display"> 00,0
                                </span>
                            </h3>
                        </div>
                    </div>
                    <!-- Botones de acción -->
                    <div class="card-footer text-right ">

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Registrar
                        </button>
                        <a href="<?php echo e(url('admin/compras')); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>

                    </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para agregar el detalle de la moto -->
    <div class="modal" id="crearMotoModal" tabindex="-1" role="dialog" aria-modal="true"
        aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">

                    <h4 class="modal-title text-center">
                        <i class="fa-solid fa-motorcycle"></i>
                        <span id="modalActionText">Ingresar datos de motocicleta</span>

                    </h4>
                    <button type="button" class="close position-absolute" style="right: 20px" data-dismiss="modal"
                        aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline">
                                <div class="col-md-12 mx-auto mt-2">
                                    <div
                                        class="card-body <?php echo e($auth_type ?? 'login'); ?>-card-body <?php echo e(config('adminlte.classes_auth_body', '')); ?>">
                                        <!-- Datos de Moto -->
                                        <div class="row">
                                            <!-- Primera Columna: Datos -->
                                            <div class="col-md-9">
                                                <!-- Fila 1 -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Marca</label> <b style="color: red;">*</b>
                                                        <select class="form-control" name="id_marca" id="id_marca">
                                                            <option value="">Seleccione una marca
                                                            </option>
                                                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($marca->id); ?>"
                                                                    <?php echo e(old('id_marca', $moto->id_marca ?? '') == $marca->id ? 'selected' : ''); ?>>
                                                                    <?php echo e($marca->nombre_marca); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['id_marca'];
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
                                                    <div class="col-md-4">
                                                        <label>Modelo</label> <b style="color: red;">*</b>
                                                        <input type="text"
                                                            value="<?php echo e(is_array(old('modelo_moto')) ? implode(', ', old('modelo_moto')) : old('modelo_moto')); ?>"
                                                            name="modelo_moto" id="modelo_moto" class="form-control"
                                                            placeholder="Modelo">
                                                        <?php $__errorArgs = ['modelo_moto'];
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
                                                    <div class="col-md-2">
                                                        <label>Dominio</label><b style="color: red;"></b>
                                                        <input type="text" name="dominio" id="dominio"
                                                            class="form-control" placeholder="Dominio">
                                                        <?php $__errorArgs = ['estado_compra'];
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
                                                    <div class="col-md-2">
                                                        <label>Cilindrada</label><b style="color: red;">*</b>
                                                        <input type="number" min="0" name="cilindrada_moto"
                                                            id="cilindrada_moto" class="form-control"
                                                            placeholder="Cilindrada">
                                                        <?php $__errorArgs = ['cilindrada_moto'];
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

                                                <!-- Fila 2 -->
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <label>Color</label><b style="color: red;">*</b>
                                                        <input type="text" name="color_moto" id="color_moto"
                                                            class="form-control" placeholder="Color">
                                                        <?php $__errorArgs = ['color_moto'];
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
                                                    <div class="col-md-4">
                                                        <label>Nacionalidad</label><b style="color: red;">*</b>
                                                        <select class="form-control" name="id_nacionalidad"
                                                            id="id_nacionalidad">
                                                            <option value="">Seleccione una
                                                                Nacionalidad</option>
                                                            <?php $__currentLoopData = $nacionalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nacionalidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($nacionalidad->id); ?>"
                                                                    data-nombre_nacionalidad="<?php echo e($nacionalidad->pais); ?>">
                                                                    <?php echo e($nacionalidad->pais); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['id_nacionalidad'];
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
                                                    <div class="col-md-2">
                                                        <label>Año</label><b style="color: red;">*</b>
                                                        <input type="number" min="0" name="anio_moto"
                                                            id="anio_moto" class="form-control" placeholder="Año">
                                                        <?php $__errorArgs = ['anio_moto'];
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
                                                    <div class="col-md-2">
                                                        <label>Km</label><b style="color: red;">*</b>
                                                        <input type="number" min="0" name="km_moto"
                                                            id="km_moto" class="form-control"
                                                            placeholder="Kilometraje">
                                                        <?php $__errorArgs = ['km_moto'];
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
                                                    <div class="col-md-2">
                                                        <div class="form-check mt-4">
                                                            <input class="form-check-input" name="es_usada"
                                                                id="es_usada" type="checkbox">
                                                            <label class="form-check-label">¿Es
                                                                usada?</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Fila 3 -->
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label>Nro. Motor</label><b style="color: red;">*</b>
                                                        <input type="text" name="nr_motor" id="nr_motor"
                                                            class="form-control" placeholder="Nro. Motor">
                                                        <?php $__errorArgs = ['nr_motor'];
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
                                                    <div class="col-md-6">
                                                        <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                        <input type="text" name="nr_chasis" id="nr_chasis"
                                                            class="form-control" placeholder="Nro. Chasis">
                                                        <?php $__errorArgs = ['nr_chasis'];
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

                                                <!-- Fila 4 -->
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label>D.N.R.P.A</label><b style="color: red;"></b>
                                                        <input type="text" name="dnrpa" id="dnrpa"
                                                            class="form-control" placeholder="Nro. DNRPA">
                                                        <?php $__errorArgs = ['dnrpa'];
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
                                                    <div class="col-md-6">
                                                        <label>Certificado</label><b style="color: red;"></b>
                                                        <input type="text" class="form-control" name="nr_certificado"
                                                            id="nr_certificado" placeholder="Nro. Certificado">
                                                        <?php $__errorArgs = ['nr_certificado'];
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

                                                <!-- Fila 5 -->
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        <label>Precio compra</label><b style="color: red;">*</b>
                                                        <input type="text" class="form-control"
                                                            id="precioCompraFormatted" placeholder="Precio compra">
                                                        <!-- Input hidden (valor limpio para BD) -->
                                                        <input type="hidden" name="precio_compra" id="precio_compra">
                                                        <?php $__errorArgs = ['precio_compra'];
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
                                                    <div class="col-md-4">
                                                        <label>Precio venta</label>
                                                        <input type="text" class="form-control"
                                                            id="precioVentaFormatted" placeholder="Precio venta">
                                                        <!-- Input hidden (valor limpio para BD) -->
                                                        <input type="hidden" name="precio_venta" id="precio_venta">
                                                        <?php $__errorArgs = ['precio_venta'];
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
                                                    <div class="col-md-4">
                                                        <label>Deposito</label><b style="color: red;">*</b>
                                                        <select class="form-control" id="id_deposito" name="id_deposito">
                                                            <option value="">Seleccione un Deposito
                                                            </option>
                                                            <?php $__currentLoopData = $depositos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($deposito->id); ?>">
                                                                    <?php echo e($deposito->nombre_deposito); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['id_deposito'];
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
                                            </div>

                                            <!-- Segunda Columna: Imagen -->
                                            <div class="col-md-3">
                                                <div class="text-center">
                                                    <div class="form-group">
                                                        <label for="imagen">Imagen</label>
                                                        <input type="file" id="imagen_moto" name="imagen_moto"
                                                            accept=".jpg, .jpeg, .png" class="form-control">
                                                        <?php $__errorArgs = ['imagen_moto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <small style="color: red;"><?php echo e($message); ?></small>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <br>
                                                        <center>
                                                            <output id="list">
                                                                <img id="preview-moto"
                                                                    src="<?php echo e(asset('storage/motos/default.png')); ?>"
                                                                    width="70%" alt="Vista previa"
                                                                    style="border:1px solid #ccc; border-radius:8px; object-fit:cover;">
                                                            </output>
                                                        </center>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="agregarMotoATabla()" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar moto
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-cancel"></i> Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal seleccionar proveedor-->
    <div class="modal fade" id="exampleModal_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="mitabla2" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align: center;">Nro</th>
                                <th scope="col" style="text-align: center;">Acción</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">CUIT</th>
                                <th scope="col">Telefono</th>

                            </tr>
                        </thead>
                        <?php $contador = 1; ?>
                        <tbody>
                            <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="text-align: center;vertical-align:middle;"><?php echo e($contador++); ?>

                                    </td>
                                    <td style="text-align: center;vertical-align:middle;">
                                        <button type="button" class="btn btn-info seleccionar-btn-proveedor"
                                            data-id="<?php echo e($proveedore->id); ?>"
                                            data-nombre_proveedor="<?php echo e($proveedore->nombre_proveedor); ?>">Seleccionar</button>
                                    </td>
                                    <td style="vertical-align:middle;"><?php echo e($proveedore->nombre_proveedor); ?>

                                    </td>
                                    <td style="vertical-align:middle;"><?php echo e($proveedore->cuit); ?></td>
                                    <td style="vertical-align:middle;"><?php echo e($proveedore->telefono); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal agregar proveedor -->
    <div class="modal fade" id="modalAgregarProveedor" tabindex="-1" role="dialog"
        aria-labelledby="modalProveedorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="modalProveedorLabel">Agregar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Formulario -->
                <form id="formAgregarProveedor">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="redirect_to" value="<?php echo e(url()->current()); ?>">
                        <div class="form-group">
                            <label for="nombre_proveedor">Nombre</label>
                            <input type="text" placeholder="Ingrese el nombre" name="nombre_proveedor"
                                id="nombre_proveedor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cuit">CUIT</label>
                            <input type="text" placeholder="Ingrese el CUIT" name="cuit" id="cuit"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" placeholder="Ingrese el telefono" name="telefono" id="telefono"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" placeholder="Ingrese el celular" name="celular" id="celular"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" placeholder="Ingrese el correo electronico" name="email"
                                id="email" class="form-control">
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal ver moto -->
    <div class="modal fade" id="modalVerMoto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detalles de la Moto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Marca:</strong> <span id="verMarca"></span></p>
                            <p><strong>Modelo:</strong> <span id="verModelo"></span></p>
                            <p><strong>Dominio:</strong> <span id="verDominio"></span></p>
                            <p><strong>Cilindrada:</strong> <span id="verCilindrada"></span></p>
                            <p><strong>Color:</strong> <span id="verColor"></span></p>
                            <p><strong>N° Chasis:</strong> <span id="verChasis"></span></p>
                            <p><strong>Precio Compra:</strong> <span id="verPrecioCompra"></span></p>
                            <p><strong>Precio Venta:</strong> <span id="verPrecioVenta"></span></p>

                        </div>
                        <div class="col-md-4">
                            <p><strong>Nacionalidad:</strong> <span id="verNacionalidad"></span></p>
                            <p><strong>Año:</strong> <span id="verAnio"></span></p>
                            <p><strong>Km:</strong> <span id="verKm"></span></p>
                            <p><strong>Usada:</strong> <span id="verUsada"></span></p>
                            <p><strong>N° Motor:</strong> <span id="verMotor"></span></p>
                            <p><strong>DNRPA:</strong> <span id="verDnrpa"></span></p>
                            <p><strong>N° Certificado:</strong> <span id="verCertificado"></span></p>

                            <p><strong>Depósito:</strong> <span id="verDeposito"></span></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Imagen:</strong></p>
                            <div class="text-center">
                                <img id="verImagen" src="" alt="Imagen de la moto"
                                    class="img-fluid rounded shadow-sm" style="max-height: 250px;">
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
    <script>
        $('#crearMotoModal').on('hidden.bs.modal', function() {
            // Limpiar todos los inputs de texto, number, etc
            $(this).find('input[type="text"], input[type="number"], input[type="date"]').val('');

            // Limpiar selects
            $(this).find('select').prop('selectedIndex', 0);

            // Limpiar checkboxes y radios
            $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);

            // Eliminar errores pintados por Ajax
            $(this).find('.text-error').remove();
            $(this).find('.is-invalid').removeClass('is-invalid');

            // Limpiar imagen si aplica
            // Limpiar input file y previews
            $(this).find('input[type="file"]').val('');
            $(this).find('#preview-container').empty().hide();
            // Resetear la imagen de previsualización a la default
            $(this).find('#preview-moto').attr('src', '<?php echo e(asset('storage/motos/default.png')); ?>');
        });
    </script>

    <script>
        // ============================
        // Formatear precios con hidden
        // ============================
        document.getElementById('precioCompraFormatted').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                e.target.value = new Intl.NumberFormat('es-AR').format(value);
                document.getElementById('precio_compra').value = value;


            } else {
                e.target.value = '';
                document.getElementById('precio_compra').value = '';
            }
        });

        document.getElementById('precioVentaFormatted').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                e.target.value = new Intl.NumberFormat('es-AR').format(value);
                document.getElementById('precioVenta').value = value;


            } else {
                e.target.value = '';
                document.getElementById('precioVenta').value = '';
            }
        });
    </script>

    <script>
        $('.seleccionar-btn-proveedor').click(function() {
            var id_proveedor = $(this).data('id');
            var nombre_proveedor = $(this).data('nombre_proveedor');
            $('#id_proveedor').val(id_proveedor);
            $('#nombre_proveedor').val(nombre_proveedor);
            $('#exampleModal_proveedor').modal('hide');
        });
    </script>

    <script>
        window.agregarMotoATabla = function() {
            let formData = new FormData();
            // Agregamos los campos del formulario
            formData.append('id_marca', $('#id_marca').val());
            formData.append('modelo_moto', $('#modelo_moto').val());
            formData.append('dominio', $('#dominio').val());
            formData.append('cilindrada_moto', $('#cilindrada_moto').val());
            formData.append('color_moto', $('#color_moto').val());
            formData.append('id_nacionalidad', $('#id_nacionalidad').val());
            formData.append('anio_moto', $('#anio_moto').val());
            formData.append('km_moto', $('#km_moto').val());
            formData.append('es_usada', $('#es_usada').is(':checked') ? 1 : 0);
            formData.append('nr_motor', $('#nr_motor').val());
            formData.append('nr_chasis', $('#nr_chasis').val());
            formData.append('dnrpa', $('#dnrpa').val());
            formData.append('nr_certificado', $('#nr_certificado').val());
            formData.append('precio_compra', $('#precio_compra').val());
            formData.append('precio_venta', $('#precio_venta').val());
            formData.append('id_deposito', $('#id_deposito').val());

            // Imagen
            const imagenInput = document.getElementById('imagen_moto');
            if (imagenInput.files.length > 0) {
                formData.append('imagen_moto', imagenInput.files[0]);
            }

            // CSRF token
            formData.append('_token', '<?php echo e(csrf_token()); ?>');

            // Enviar AJAX
            $.ajax({
                url: '<?php echo e(route('tmp-compras.store')); ?>',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhrFields: {
                    withCredentials: true
                },
                success: function(res) {
                    if (res.success) {
                        //Swal.fire({
                        //    icon: 'success',
                        //    title: '¡Éxito!',
                        //    text: res.message,
                        //    confirmButtonText: 'Aceptar',
                        //    confirmButtonColor: '#28a745'
                        //}).then(() => {
                        $('#crearMotoModal').modal('hide');
                        cargarMotosATabla();
                        // Limpiar errores y formulario
                        $('.text-error').remove();
                        $('#formAgregarMoto')[0].reset();
                        //});
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Limpiar errores anteriores
                        $('.text-error').remove();

                        let errors = xhr.responseJSON.errors;
                        for (let campo in errors) {
                            let mensaje = errors[campo][0];
                            $(`[name="${campo}"]`).after(
                                `<small class="text-error" style="color:red">${mensaje}</small>`);
                        }

                        /*Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            text: 'Por favor corrige los errores marcados.',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#dc3545'
                        });*/

                    } else {
                        console.error(xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al agregar moto.',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                }
            });

        }
    </script>

    <script>
        const marcas = <?php echo json_encode($marcas, 15, 512) ?>; // $marcas viene del controlador

        function getNombreMarca(id) {
            const marca = marcas.find(m => m.id === id);
            return marca ? marca.nombre_marca : 'Desconocida';
        }

        function cargarMotosATabla() {
            $.ajax({
                url: '<?php echo e(route('tmp-compras.listar')); ?>',
                method: 'GET',
                success: function(response) {
                    let tbody = $('#tabla-motos tbody');
                    tbody.empty();

                    // Si no vienen motos o el array está vacío, mostramos mensaje
                    if (!response.motos || response.motos.length === 0) {
                        let filaVacia = `
                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    🚫 No hay motos cargadas todavía.
                                </td>
                            </tr>
                        `;
                        tbody.append(filaVacia);
                        // No seguimos con el resto del código porque no hay motos
                        $('#precio_total_input').val(0);
                        $('#total_compra').text(`$ 0`);
                        return;
                    }

                    let precio_total = 0;

                    response.motos.forEach(function(moto, index) {
                        precio_total += parseFloat(moto.precio_compra) || 0;
                        // Obtenemos el nombre de la marca
                        const nombreMarca = getNombreMarca(moto.id_marca);
                        let urlEditar = `/admin/motos-temporales/${moto.id}/editar`;

                        let fila = `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td class="text-center" style="width: 10%">${nombreMarca}</td>
                        <td class="text-center">${moto.modelo_moto}</td>
                        <td class="text-center">${moto.color_moto}</td>
                        <td class="text-center">${moto.anio_moto}</td>
                        <td class="text-center">${moto.cilindrada_moto}cc</td>
                        <td class="text-center text-danger">$${moto.precio_compra ? parseFloat(moto.precio_compra).toLocaleString('es-AR') : '0'}</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-sm verMotoBtn"
                                data-moto='${JSON.stringify(moto)}'>
                                <i class="fas fa-eye"></i>
                            </button>
                             <!-- Editar -->
                            <a href="${urlEditar}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${moto.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `;

                        tbody.append(fila);
                    });


                    $('#precio_total_input').val(precio_total);
                    $('#total_compra').text(`$ ${precio_total.toLocaleString('es-AR')}`);
                    $('#total_compra_display').text(
                        `$ ${precio_total.toLocaleString('es-AR')}`); // texto visible para usuario


                    asignarEventosDelete();
                    asignarEventosVer();
                },
                error: function(err) {
                    console.error(err);
                    alert('Error al obtener motos.');
                }
            });
        }

        function asignarEventosDelete() {
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: "<?php echo e(url('/admin/tmp-compras')); ?>/" + id,
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Moto eliminada",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                cargarMotosATabla(); // ← Actualizás sin recargar
                            } else {
                                alert('Error al eliminar la moto');
                            }
                        },
                        error: function(error) {
                            console.error(error);
                            alert('Error en la solicitud de eliminación');
                        }
                    });
                }
            });
        }

        function asignarEventosVer() {
            $('.verMotoBtn').click(function() {
                let moto = $(this).data('moto'); // Viene del JSON.stringify()

                $('#verMarca').text(moto.marca ? moto.marca.nombre_marca : 'No registrado');
                $('#verModelo').text(moto.modelo_moto ?? 'No registrado');
                $('#verDominio').text(moto.dominio ?? 'No registrado');
                $('#verCilindrada').text(moto.cilindrada_moto ? moto.cilindrada_moto + 'cc' : 'No registrado');
                $('#verColor').text(moto.color_moto ?? 'No registrado');
                $('#verNacionalidad').text(moto.nacionalidad ? moto.nacionalidad.pais : 'No registrado');
                $('#verAnio').text(moto.anio_moto ?? 'No registrado');
                $('#verKm').text(moto.km_moto ?? 'No registrado');
                $('#verUsada').text(moto.es_usada == 1 ? 'Sí' : 'No');
                $('#verMotor').text(moto.nr_motor ?? 'No registrado');
                $('#verChasis').text(moto.nr_chasis ?? 'No registrado');
                $('#verDnrpa').text(moto.dnrpa ?? 'No registrado');
                $('#verCertificado').text(moto.nr_certificado ?? 'No registrado');
                $('#verPrecioCompra').text(moto.precio_compra ?
                    `$ ${parseFloat(moto.precio_compra).toLocaleString('es-AR')}` : 'No registrado');
                $('#verPrecioVenta').text(moto.precio_venta ?
                    `$ ${parseFloat(moto.precio_venta).toLocaleString('es-AR')}` : 'No registrado');
                $('#verDeposito').text(moto.deposito ? moto.deposito.nombre_deposito : 'No registrado');
                // Imagen de la moto con fallback a default
                let imgRuta = moto.imagen_moto ?
                    '/' + moto.imagen_moto // si guardaste la ruta completa desde storage
                    :
                    '/storage/motos/default.png'; // fallback a imagen default
                $('#verImagen').attr('src', imgRuta).show();

                //Abrir modal
                $('#modalVerMoto').modal('show');
            });
        }


        // Cargar motos al iniciar la página
        $(document).ready(function() {
            cargarMotosATabla();
        });
    </script>


    <script>
        // Función para previsualización
        function archivo(evt) {
            var files = evt.target.files;
            var preview = document.getElementById("preview-moto");

            if (files.length === 0) {
                preview.src = "<?php echo e(asset('storage/motos/default.png')); ?>";
                return;
            }

            var f = files[0];
            if (!f.type.match('image.*')) {
                preview.src = "<?php echo e(asset('storage/motos/default.png')); ?>";
                return;
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(f);
        }

        document.getElementById('imagen_moto').addEventListener('change', archivo, false);

        // Resetear modal al abrir
        $('#modalAgregarMoto').on('show.bs.modal', function(e) {
            var preview = document.getElementById("preview-moto");
            var input = document.getElementById("imagen_moto");

            // Limpiar input
            input.value = "";

            // Volver a imagen default
            preview.src = "<?php echo e(asset('storage/motos/default.png')); ?>";
        });
    </script>



    <script>
        $('#formAgregarProveedor').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '<?php echo e(route('proveedores.crearProveedorCompra')); ?>', // tu ruta definida
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Cerrar modal
                    $('#modalAgregarProveedor').modal('hide');

                    // Limpiar errores anteriores
                    $('.text-error').remove();

                    // Actualizar inputs en compras
                    $('#id_proveedor').val(response.id);
                    $('#nombre_proveedor').val(response.nombre);

                    Swal.fire({
                        icon: 'success',
                        title: 'Proveedor agregado',
                        text: 'Se seleccionó automáticamente el proveedor recién creado.',
                        confirmButtonColor: '#28a745'
                    });
                },
                error: function(xhr) {
                    $('.text-error').remove();

                    if (xhr.status === 422) { // errores de validación
                        let errors = xhr.responseJSON.errors;
                        for (let campo in errors) {
                            let mensaje = errors[campo][0];
                            $(`[name="${campo}"]`).after(
                                `<small class="text-error" style="color:red">${mensaje}</small>`);
                        }
                    } else {
                        console.error(xhr.responseText);
                    }
                }
            });
            $('#modalAgregarProveedor').on('hidden.bs.modal', function() {
                $(this).find('input').val(''); // Limpia todos los inputs del modal
                $(this).find('.text-error').remove(); // Limpia los errores mostrados
            });
        });
    </script>
    <script>
        $('#mitabla').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });


        $('#mitabla2').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/admin/compras/create.blade.php ENDPATH**/ ?>