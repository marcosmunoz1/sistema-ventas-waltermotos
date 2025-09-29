<?php $__env->startSection('title', 'Creditos'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-primary mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Lista de Creditos </h2>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="miTabla">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center" style="width: 3%">#</th>
                                            <th class="text-center" style="width: 10%">Fecha</th>
                                            <th class="text-center" style="width: 5%">Venta</th>
                                            <th class="text-center" style="width: 15%">Cliente</th>
                                            <th class="text-center" style="width: 5%">Cuotas</th>
                                            <th class="text-center" style="width: 5%">Valor Financiado</th>
                                            <th class="text-center" style="width: 5%">Saldo</th>
                                            <th class="text-center" style="width: 5%">Int. x Mora</th>
                                            <th class="text-center" style="width: 5%">TOTAL</th>
                                            <th class="text-center" style="width: 2%">Estado</th>
                                            <th class="text-center" style="width: 15%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php $contador = 1; ?>
                                    <tbody>
                                        <?php $__currentLoopData = $creditos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $credito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle"><?php echo e($contador++); ?>

                                                </td>
                                                <td class="text-center"style="vertical-align: middle">
                                                    <?php echo e($credito->venta->fecha_venta); ?>

                                                </td>
                                                <td class="text-center"style="vertical-align: middle">
                                                    <?php echo e($credito->venta->id_venta); ?>

                                                <td style="vertical-align: middle">
                                                    <?php echo e($credito->venta->cliente->apellido_cliente); ?>,
                                                    <?php echo e($credito->venta->cliente->nombre_cliente); ?> </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <?php echo e($credito->cantidad_cuotas); ?></td>
                                                <td class="text-success text-right" style="vertical-align: middle">
                                                    $<?php echo e(number_format($credito->valor_financiado, 2, ',', '.')); ?></td>
                                                <td class="text-danger text-right" style="vertical-align: middle">
                                                    $<?php echo e(number_format($credito->saldo_credito, 2, ',', '.')); ?></td>
                                                <td class="text-right" style="vertical-align: middle">
                                                    $<?php echo e(number_format($credito->total_interes, 2, ',', '.')); ?></td>
                                                <td class="text-right text-primary" style="vertical-align: middle">
                                                    $<?php echo e(number_format($tota = $credito->valor_financiado + $credito->total_interes - $credito->saldo_credito, 2, ',', '.')); ?>

                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge <?php echo e($credito->estado_credito == 'Pagado' ? 'bg-success' : 'bg-danger'); ?>">
                                                        <?php echo e($credito->estado_credito); ?>

                                                    </span>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="<?php echo e(url('/admin/creditos/' . $credito->id)); ?>"
                                                            class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                        
                                                        <?php if($credito->estado_credito != "Pagado"): ?>
                                                            <a href="<?php echo e(url('/admin/creditos/' . $credito->id . '/cobrar-cuotas')); ?>"
                                                                class="btn btn-sm btn-secondary"><i
                                                                    class="fas fa-cash-register"></i></a>
                                                        <?php else: ?>
                                                        <?php endif; ?>

                                                        <form action="<?php echo e(url('/admin/creditos', $credito->id)); ?>"
                                                            method="post" class="d-inline-block"
                                                            onsubmit="preguntar(event, <?php echo e($credito->id); ?>)"
                                                            id="miFormulario<?php echo e($credito->id); ?>">
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
        </div>
    </div>
    <div class="modal fade" id="ventana_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ventana_modal_titulo"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Pestañas -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="compra-tab" data-toggle="tab" data-target="#compra"
                                type="button" role="tab">
                                <i class="fas fa-receipt"></i> Compra
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="moto-tab" data-toggle="tab" data-target="#moto"
                                type="button" role="tab">
                                <i class="fas fa-motorcycle"></i> Moto
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="proveedor-tab" data-toggle="tab" data-target="#proveedor"
                                type="button" role="tab">
                                <i class="fas fa-truck"></i> Proveedor
                            </button>
                        </li>
                    </ul>

                    <!-- Contenido de las pestañas -->
                    <div class="tab-content p-3 border border-top-0 rounded-bottom" id="myTabContent">
                        <!-- Pestaña Compra -->
                        <div class="tab-pane fade show active" id="compra" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold">N° Factura</label>
                                        <input type="text" id="numero_factura" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="fw-bold">N° Remito</label>
                                        <input type="text" id="numero_remito" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold">Fecha Compra</label>
                                        <input type="text" id="fecha_compra" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="fw-bold">Total</label>
                                        <input type="text" id="total_compra" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pestaña Moto -->
                        <!-- Pestaña Moto -->
                        <div class="tab-pane fade" id="moto" role="tabpanel">
                            <div class="card card-outline">
                                <div class="col-md-12 mx-auto mt-2">
                                    <div class="card card-info">
                                        <div class="card-body">
                                            <!-- Datos de Moto -->
                                            <div class="row">
                                                <!-- Primera Columna: Datos -->
                                                <div class="col-md-9">
                                                    <!-- Fila 1 -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Marca</label>
                                                            <input type="text" id="moto_marca" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Modelo</label>
                                                            <input type="text" id="moto_modelo" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Dominio</label>
                                                            <input type="text" id="moto_dominio" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Cilindrada</label>
                                                            <input type="text" id="moto_cilindrada"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Fila 2 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-2">
                                                            <label>Color</label>
                                                            <input type="text" id="moto_color" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nacionalidad</label>
                                                            <input type="text" id="moto_nacionalidad"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Año</label>
                                                            <input type="text" id="moto_anio" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Km</label>
                                                            <input type="text" id="moto_km" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check mt-4">
                                                                <input class="form-check-input" id="moto_usada"
                                                                    type="checkbox" disabled>
                                                                <label class="form-check-label">¿Es usada?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fila 3 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>Nro. Motor</label>
                                                            <input type="text" id="moto_motor" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nro. Chasis</label>
                                                            <input type="text" id="moto_chasis" class="form-control"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Fila 4 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>D.N.R.P.A</label>
                                                            <input type="text" id="moto_dnrpa" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Certificado</label>
                                                            <input type="text" class="form-control"
                                                                id="moto_certificado" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">
                                                            <label>Precio compra</label>
                                                            <input type="text" class="form-control"
                                                                id="moto_precio_compra" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Precio venta</label>
                                                            <input type="text" class="form-control"
                                                                id="moto_precio_venta" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Deposito</label>
                                                            <input type="text" class="form-control" id="moto_deposito"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Segunda Columna: Imagen -->
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <div class="form-group">
                                                            <label for="imagen">Imagen</label>
                                                            <div id="moto_imagen_container" class="mt-2">
                                                                <img id="moto_imagen" src="" class="img-fluid"
                                                                    style="max-height: 200px; display: none;">
                                                                <p class="text-muted" id="no-image-message">No hay imagen
                                                                    disponible</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pestaña Proveedor -->
                        <div class="tab-pane fade" id="proveedor" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold">Nombre</label>
                                        <input type="text" id="proveedor_nombre" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="fw-bold">Cuit</label>
                                        <input type="text" id="proveedor_cuit" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold">Teléfono</label>
                                        <input type="text" id="proveedor_telefono" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="fw-bold">Email</label>
                                        <input type="text" id="proveedor_email" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold">Celular</label>
                                        <input type="text" id="proveedor_celular" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-warning" id="editarCompraLink" style="display: none;"
                        data-toggle="tooltip" title="Editar esta compra">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .nav-tabs .nav-link {
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            background-color: #f8f9fa;
            border-bottom-color: #f8f9fa;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar este Credito?',
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Creditos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Creditos",
                "infoFiltered": "(Filtrado de _MAX_ total Creditos)",
                "lengthMenu": "Mostrar _MENU_ Creditos",
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
    <script>
        function abrir_modal(modal, title, campos, dato) {
            compraActualId = dato.id || null;

            const editLink = $('#editarCompraLink');
            if (compraActualId) {
                editLink.show();
                // Remover cualquier evento previo
                editLink.off('click');

                // Asignar nuevo evento con SweetAlert2
                editLink.on('click', async function(e) {
                    e.preventDefault();

                    // Obtener imagen y verificar si carga correctamente
                    const imagenMotoUrl = $('#moto_imagen').attr('src');
                    let imagenValida = false;

                    if (imagenMotoUrl) {
                        imagenValida = await verificarImagen(imagenMotoUrl);
                    }

                    const imagenMostrar = imagenValida ? imagenMotoUrl :
                        '<?php echo e(asset('images/default-moto.png')); ?>';

                    Swal.fire({
                        title: '¿Editar esta compra?',
                        text: "Serás redirigido al formulario de edición",
                        html: `
            <div class="text-center">
                <img src="${imagenMostrar}"
                class="img-fluid rounded mb-2 border"
                style="max-height: 100px;"
                alt="Imagen de la moto">
                <p>Serás redirigido al formulario de edición</p>
                </div>
                `,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, editar',
                        cancelButtonText: 'Cancelar',

                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `<?php echo e(url('/admin/compras')); ?>/${compraActualId}/edit`;
                        }
                    });
                });

                // Función para verificar si la imagen existe
                function verificarImagen(url) {
                    return new Promise((resolve) => {
                        const img = new Image();
                        img.onload = () => resolve(true);
                        img.onerror = () => resolve(false);
                        img.src = url;
                    });
                }
            } else {
                editLink.hide();
            }


            // Inicializar tooltip
            $('[data-toggle="tooltip"]').tooltip();
            // Mostrar el modal y establecer título
            $(`#${modal}`).modal('show');
            $(`#${modal}_titulo`).text(title);
            const $tablaMotos = $('#tabla_motos'); // Definir aquí

            // Limpiar tabla de motos
            $('#tabla_motos').empty();
            $('#proveedor_nombre, #proveedor_cuit, #proveedor_telefono, #proveedor_email', '#proveedor_celular').val('');
            $('#moto_imagen').attr('src', '');

            /*
                // Mostrar spinner mientras se cargan los detalles completos
                $('#tabla_motos').html('<tr><td colspan="4" class="text-center"><div class="spinner-border"></div></td></tr>'); */

            // Llenar campos básicos
            if (campos && campos.length >= 1) {
                campos.forEach((campo) => {
                    const $element = $(`#${campo}`);
                    if ($element.length) {
                        $element.val(dato[campo] || 'N/A');
                    }
                });
                $('#id').val(dato.id || 0);
            }

            // Cargar detalles asíncronos solo si hay ID
            if (dato?.id) {
                $.ajax({
                    url: "<?php echo e(url('admin/compras/show')); ?>/" + dato.id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Validar respuesta
                        if (!response || !response.motos) {
                            throw new Error('Respuesta inválida');
                        }

                        // Actualizar campos
                        $('#fecha_compra').val(response.fecha_formateada || 'N/A');
                        $('#total_compra').val(response.total_formateado ? '$' + response.total_formateado :
                            '$0.00');


                        // Pestaña Moto (solo mostramos la primera moto si hay varias)
                        if (response.motos && response.motos.length) {
                            const moto = response.motos[0]; // Tomamos la primera moto

                            $('#moto_marca').val(moto.marca_nombre || 'N/A');
                            $('#moto_modelo').val(moto.modelo || 'N/A');
                            $('#moto_dominio').val(moto.dominio || 'N/A');
                            $('#moto_cilindrada').val(moto.cilindrada_moto || 'N/A');
                            $('#moto_color').val(moto.color || 'N/A');
                            $('#moto_nacionalidad').val(moto.nacionalidad || 'N/A');
                            $('#moto_anio').val(moto.anio_moto || 'N/A');
                            $('#moto_km').val(moto.km_moto || 'N/A');
                            $('#moto_usada').prop('checked', moto.es_usada == 1);
                            $('#moto_motor').val(moto.nr_motor || 'N/A');
                            $('#moto_chasis').val(moto.nr_chasis || 'N/A');
                            $('#moto_dnrpa').val(moto.dnrpa || 'N/A');
                            $('#moto_certificado').val(moto.nr_certificado || 'N/A');
                            $('#moto_precio_compra').val(moto.precio_compra ? '$' + moto.precio_compra :
                                '$0.00');
                            $('#moto_precio_venta').val(moto.precio_venta ? '$' + moto.precio_venta : '$0.00');
                            $('#moto_deposito').val(moto.deposito || 'N/A');

                            if (moto.imagen_moto) {
                                // Construir la URL correctamente
                                const imageUrl = "<?php echo e(asset('storage')); ?>/" + moto.imagen_moto.replace(
                                    'storage/', '');

                                // Crear elemento de imagen
                                const imgElement = $('#moto_imagen');

                                // Configurar eventos
                                imgElement.off('error.load').on({
                                    'load': function() {
                                        $(this).show();
                                        $('#no-image-message').hide();
                                        console.log('Imagen cargada con éxito:', imageUrl);
                                    },
                                    'error': function() {
                                        $(this).hide();
                                        $('#no-image-message').show().html(`
                                <div class="alert alert-warning p-2">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    No se pudo cargar la imagen
                                </div>
                            `);
                                        console.error('Error al cargar imagen:', imageUrl);

                                        // Depuración adicional
                                        fetch(imageUrl, {
                                                method: 'HEAD'
                                            })
                                            .then(response => {
                                                console.log('Estado de la imagen:', response
                                                    .status);
                                                if (response.status === 404) {
                                                    console.warn(
                                                        'La imagen no existe en el servidor'
                                                    );
                                                }
                                            })
                                            .catch(error => console.error('Error en verificación:',
                                                error));
                                    }
                                });

                                // Asignar la fuente
                                imgElement.attr('src', imageUrl);
                            } else {
                                $('#moto_imagen').hide();
                                $('#no-image-message').show().html(`
                            <div class="text-muted">
                                <i class="fas fa-image fa-2x mb-2"></i>
                                <p>No hay imagen registrada</p>
                            </div>
                        `);
                            }
                        }

                        // Pestaña Proveedor (¡Aquí estaba el error!)
                        if (response.proveedor) {
                            $('#proveedor_nombre').val(response.proveedor.nombre_proveedor || 'N/A');
                            $('#proveedor_cuit').val(response.proveedor.cuit ||
                                'N/A'); // Cambiado de 'ruc' a 'cuit'
                            $('#proveedor_telefono').val(response.proveedor.telefono || 'N/A');
                            $('#proveedor_email').val(response.proveedor.email || 'N/A');
                            $('#proveedor_celular').val(response.proveedor.celular || 'N/A'); // Añadido
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = 'Error al cargar detalles';
                        if (xhr.responseJSON?.message) {
                            errorMsg += `: ${xhr.responseJSON.message}`;
                        }
                        $tablaMotos.html(`<tr><td colspan="4" class="text-danger">${errorMsg}</td></tr>`);
                        console.error("Error en AJAX:", error);
                    }
                });
            } else {
                $tablaMotos.html('<tr><td colspan="4" class="text-warning">No hay ID de compra</td></tr>');
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\creditos\index.blade.php ENDPATH**/ ?>