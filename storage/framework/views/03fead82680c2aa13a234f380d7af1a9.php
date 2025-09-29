<?php $__env->startSection('title', 'Editar Moto'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="brand-text font-weight-light mb-0">Compras/Editar-Moto/<b>NR.CHASIS(<?php echo e($moto->nr_chasis); ?>) </b></h2>
                </div>
            </div>
               <form action="<?php echo e(route('compras.temporales.motos.update', ['motoId' => $moto->id])); ?>"
                    enctype="multipart/form-data" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="col-md-12 mx-auto mt-2">
                        <div class="card card-info">
                            <div class="card-body">

                                <!-- Datos de Moto -->
                                <div class="row">
                                    <!-- Primera Columna -->
                                    <div class="col-md-9">
                                        <!-- Fila 1 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Marca</label><b style="color: red;">*</b>
                                                    <select class="form-control" name="id_marca" id="id_marca">
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
                                            </div>

                                            <div class="col-md-4">
                                                <label>Modelo</label><b style="color: red;">*</b>
                                                <input type="text" name="modelo_moto" class="form-control"
                                                    value="<?php echo e($moto->modelo_moto); ?>" placeholder="Modelo" required>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Dominio</label>
                                                <input name="dominio" type="text" class="form-control"
                                                    value="<?php echo e($moto->dominio); ?>" placeholder="Dominio">
                                                 <?php $__errorArgs = ['dominio'];
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
                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                <input type="number" name="cilindrada_moto" class="form-control"
                                                    value="<?php echo e($moto->cilindrada_moto); ?>" placeholder="Cilindradas cc." required>
                                            </div>
                                        </div>

                                        <!-- Fila 2 -->
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label>Color</label><b style="color: red;">*</b>
                                                <input name="color_moto" type="text" class="form-control"
                                                    placeholder="Color" value="<?php echo e($moto->color_moto); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nacionalidad</label><b style="color: red;">*</b>
                                                <select name="id_nacionalidad" class="form-control" required>
                                                    <?php $__currentLoopData = $nacionalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nacionalidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($nacionalidad->id); ?>"
                                                            <?php echo e($nacionalidad->id == $moto->id_nacionalidad ? 'selected' : ''); ?>>
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
                                                <input name="anio_moto" type="number" class="form-control"
                                                    value="<?php echo e($moto->anio_moto); ?>" placeholder="Año">
                                                <?php $__errorArgs = ['anio_moto'];
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
                                                <label>Km</label><b style="color: red;">*</b>
                                                <input name="km_moto" type="number" class="form-control"
                                                    value="<?php echo e($moto->km_moto); ?>" placeholder="Kilometraje">
                                                <?php $__errorArgs = ['km_moto'];
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
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" name="es_usada"
                                                        <?php echo e($moto->es_usada == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label">¿Es usada?</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fila 3 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                <input name="nr_motor" type="text" class="form-control"
                                                    value="<?php echo e($moto->nr_motor); ?>" placeholder="Nro. Motor" required>
                                                <?php $__errorArgs = ['nr_motor'];
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
                                            <div class="col-md-6">
                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                <input name="nr_chasis" type="text" class="form-control"
                                                    value="<?php echo e($moto->nr_chasis); ?>" placeholder="Nro. Chasis" required>
                                                 <?php $__errorArgs = ['nr_chasis'];
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

                                        <!-- Fila 4 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>D.N.R.P.A</label>
                                                <input name="dnrpa" type="text" class="form-control"
                                                    value="<?php echo e($moto->dnrpa); ?>" placeholder="Nro. DNRPA">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Certificado</label>
                                                <input name="nr_certificado" type="text" class="form-control"
                                                    value="<?php echo e($moto->nr_certificado); ?>" placeholder="Nro. Certificado">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Segunda Columna: Imagen -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <input type="file" id="file" name="imagen_moto" accept=".jpg,.jpeg,.png" class="form-control">
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
                                                       <img id="preview-moto" src="<?php echo e($moto->imagen_moto ? asset($moto->imagen_moto) : asset('storage/motos/default.png')); ?>"
                                                        width="70%" alt="Vista previa" style="border:1px solid #ccc; border-radius:8px; object-fit:cover;">
                                                    </output>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila precios -->
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label>Precio de Compra</label><b style="color: red;">*</b>
                                        <div class="input-group">
                                            <span class="input-group-text text-success">$</span>
                                            <input type="text" class="form-control" value="<?php echo e($moto->precio_compra); ?>"
                                                id="precioCompraFormatted" placeholder="Precio compra">
                                            <input type="hidden" name="precio_compra" value="<?php echo e($moto->precio_compra); ?>" id="precio_compra" >
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
                                    </div>

                                    <div class="col-md-3">
                                        <label>Precio de Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-danger">$</span>
                                            <input type="text"  class="form-control" value="<?php echo e($moto->precio_venta); ?>"
                                                id="precioVentaFormatted" placeholder="Precio venta">
                                            <input type="hidden" name="precio_venta" value="<?php echo e($moto->precio_venta); ?>" id="precio_venta"> 
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
                                    </div>

                                    <div class="col-md-3">
                                        <label>Depósito</label><b style="color: red;">*</b>
                                        <select name="id_deposito" class="form-control" required>
                                            <?php $__currentLoopData = $depositos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($deposito->id); ?>"
                                                    <?php echo e($deposito->id == $moto->id_deposito ? 'selected' : ''); ?>>
                                                    <?php echo e($deposito->nombre_deposito); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-file-arrow-up"></i> Actualizar
                            </button>
                             <a href="<?php echo e(route('admin.compras.create')); ?>" class="btn btn-secondary mx-1"><i
                                class="fas fa-times"></i>
                                Cancelar
                              </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

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

        document.getElementById('file').addEventListener('change', archivo, false);

        // Resetear modal al abrir
        $('#modalAgregarMoto').on('show.bs.modal', function(e) {
            var preview = document.getElementById("preview-moto");
            var input = document.getElementById("file");

            // Limpiar input
            input.value = "";

            // Volver a imagen default
            preview.src = "<?php echo e(asset('storage/motos/default.png')); ?>";
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
                document.getElementById('precio_venta').value = value;


            } else {
                e.target.value = '';
                document.getElementById('precio_venta').value = '';
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\compras\edit_tmp_moto.blade.php ENDPATH**/ ?>