<?php $__env->startSection('title', 'Editar Moto'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="card card-outline card-warning mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="brand-text font-weight-light mb-0">Motos/<b>Editar Moto</b> </h2>
                </div>
            </div>
            <form action="<?php echo e(url('/admin/motos', $moto->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
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
                                        <div class="form-group">
                                            <label>Marca </label><b style="color: red;">*</b>
                                            <select name="marca" id="" class="form-control" required>
                                                <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($marca->id); ?>"
                                                        <?php echo e($marca->id == $moto->id_marca ? 'selected' : ''); ?>>
                                                        <?php echo e($marca->nombre_marca); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Modelo</label> <b style="color: red;">*</b>
                                        <input type="text" name="modelo" class="form-control" required
                                            value="<?php echo e($moto->modelo_moto); ?>" placeholder="Modelo">
                                        <?php $__errorArgs = ['modelo'];
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
                                        <label>Dominio</label>
                                        <input name="dominio" type="text" class="form-control"
                                            value="<?php echo e($moto->dominio); ?>" placeholder="Dominio">
                                        <?php $__errorArgs = ['dominio'];
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
                                        <input type="number" name="cilindrada" class="form-control" id="cilindrada"
                                            required value="<?php echo e($moto->cilindrada_moto); ?>" placeholder="Cilindradas cc.">
                                        <?php $__errorArgs = ['cilindrada'];
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
                                        <label>Color</label>
                                        <input name="color" type="text" class="form-control" placeholder="Color"
                                            value="<?php echo e($moto->color_moto); ?>">
                                        <?php $__errorArgs = ['color'];
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
                                        <label>Nacionalidad</label>
                                        <select name="nacionalidad" id="" class="form-control" required>
                                            <?php $__currentLoopData = $nacionalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nacionalidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($nacionalidad->id); ?>"
                                                    <?php echo e($nacionalidad->id == $moto->id_nacionalidad ? 'selected' : ''); ?>>
                                                    <?php echo e($nacionalidad->pais); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Año</label>
                                        <input name="anio" type="number" class="form-control" placeholder="Año"
                                            value="<?php echo e($moto->anio_moto); ?>">
                                        <?php $__errorArgs = ['anio'];
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
                                        <label>Km</label>
                                        <input name="km" type="number" class="form-control" placeholder="Kilometraje"
                                            value="<?php echo e(old('km', $moto->km_moto)); ?>">
                                        <?php $__errorArgs = ['km'];
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
                                            <input class="form-check-input" type="checkbox" id="esUsada"
                                                <?php echo e($moto->es_usada == 1 ? 'checked' : ''); ?>>
                                            <label class="form-check-label">¿Es usada?</label>
                                        </div>
                                    </div>

                                </div>
                                <!-- Fila 3 -->
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label>Nro. Motor</label><b style="color: red;">*</b>
                                        <input name="motor" type="text" class="form-control" placeholder="Nro. Motor"
                                            value="<?php echo e($moto->nr_motor); ?>">
                                        <?php $__errorArgs = ['motor'];
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
                                        <input name="chasis" type="text" class="form-control" placeholder="Nro. Chasis"
                                            required value="<?php echo e($moto->nr_chasis); ?>">
                                        <?php $__errorArgs = ['chasis'];
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
                                        <label>D.N.R.P.A</label>
                                        <input name="dnrpa" type="text" class="form-control" placeholder="Nro. DNRPA"
                                            value="<?php echo e($moto->dnrpa); ?>">
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
                                        <label>Certificado</label>
                                        <input name="certificado" type="text" class="form-control"
                                            placeholder="Nro. Certificado" value="<?php echo e($moto->nr_certificado); ?>">
                                        <?php $__errorArgs = ['certificado'];
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
                                        <input type="file" id="file" name="imagen_moto" accept=".jpg, .jpeg, .png"
                                            class="form-control">
                                        <?php $__errorArgs = ['imagen'];
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
                                                <img src="<?php echo e($moto->imagen_moto ? asset($moto->imagen_moto) : asset('storage/motos/default.png')); ?>"
                                                        width="100%" alt="Imagen de la moto">
                                            </output>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fila 4 -->
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Precio de Compra</label>
                                    <div class="input-group">
                                        <span class="input-group-text text-success">$</span>
                                        <input type="text" class="form-control text-success"
                                            value="<?php echo e(number_format($moto->precio_compra, 2, ',', '.')); ?>" disabled>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Precio de Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-text text-danger">$</span>
                                        <input name="precio_venta" type="text" class="form-control text-danger"
                                            value="<?php echo e(number_format($moto->precio_venta, 2, ',', '.')); ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Deposito </label>
                                    <select name="deposito" id="" class="form-control" required>
                                        <?php $__currentLoopData = $depositos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($deposito->id); ?>"
                                                <?php echo e($deposito->id == $moto->id_deposito ? 'selected' : ''); ?>>
                                                <?php echo e($deposito->nombre_deposito); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-file-arrow-up"></i>
                        Actualizar
                    </button>
                    <a href="<?php echo e(url('admin/motos')); ?>" class="btn btn-secondary">
                        <i class="fas fa-cancel"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        document.getElementById('file').addEventListener('change', archivo, false);

        function archivo(evt) {
            var files = evt.target.files; // FileList object
            var list = document.getElementById("list");
            list.innerHTML = ''; // Limpiamos el contenedor

            for (var i = 0, f; f = files[i]; i++) {
                // Solo admitimos imágenes
                if (!f.type.match('image.*')) {
                    console.log('Archivo no permitido:', f.type);
                    continue;
                }

                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        list.innerHTML = [
                            '<img class="thumb thumbnail" src="', e.target.result,
                            '"width="100%" title="', escape(theFile.name), '"/>'
                        ].join('');

                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\motos\edit.blade.php ENDPATH**/ ?>