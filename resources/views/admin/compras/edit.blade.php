@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras/Modificar datos de la compra</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/compras',$compra->id)}}" id="form_compra" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="proveedor">Proveedor</label>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModal_proveedor"><i class="fas fa-search"></i> Buscar</button>
                                        <div style="margin-right: 10px"></div>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProveedor">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" value="{{$compra->proveedor->nombre_proveedor}}" id="nombre_proveedor" disabled>
                                            <input type="text" class="form-control" id="id_proveedor" value="{{$compra->proveedor->id}}" name="id_proveedor" hidden>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Factura</label>
                                        <input type="text" value="{{$compra->numero_factura}}" class="form-control"
                                            id="numero_factura" name="numero_factura" placeholder="Nr. de factura" required>
                                        @error('numero_factura')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remito</label>
                                        <input type="text" value="{{$compra->numero_remito}}" class="form-control"
                                            id="numero_remito" name="numero_remito" placeholder="Nr. de remito" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha compra</label>
                                        <input type="date" value="{{$compra->fecha_compra}}" name="fecha_compra"
                                            id="fecha_compra" class="form-control datetimepicker-input"
                                            data-target="#reservationdate" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="estado_compra">Estado</label><b> *</b>
                                        <select class="form-control" name="estado_compra" required>
                                            <option value="">-- Seleccionar estado --</option>
                                            <option value="Pagado" {{ old('estado_compra', $compra->estado_compra) == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                            <option value="Pendiente" {{ old('estado_compra', $compra->estado_compra) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        </select>
                                        @error('estado_compra')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crearMotoModal"><i class="fa-solid fa-cart-shopping"></i> Agregar moto</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="tabla-motos">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Dominio</th>
                                                <th>Color</th>
                                                <th>Año</th>
                                                <th>Precio Compra</th>
                                                <th>Cilindrada</th>
                                                <th style="text-align: center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($compra->motos as $moto)
                                                <tr data-id="{{$moto->id}}"
                                                    data-imagen="{{ asset($moto->imagen_moto) }}"
                                                    data-cilindrada="{{ $moto->cilindrada_moto }}"
                                                    data-nr-motor="{{ $moto->nr_motor }}"
                                                    data-nr-chasis="{{ $moto->nr_chasis }}"
                                                    data-certificado="{{ $moto->nr_certificado }}"
                                                    data-dnrpa="{{ $moto->dnrpa }}"
                                                    data-km_moto="{{$moto->km_moto}}"
                                                    data-id_nacionalidad="{{ $moto->id_nacionalidad }}"
                                                    data-nacionalidad="{{ $moto->nacionalidad->pais ?? 'N/D' }}"
                                                    data-precio_venta="{{$moto->precio_venta}}"
                                                    data-condicion="{{$moto->condicion}}"
                                                >
                                                    <td style="text-align: center">{{$contador++}}</td>
                                                    <td class="marca-moto" style="text-align: center">{{$moto->marca->nombre_marca}}</td>
                                                    <td class="modelo-moto" style="text-align: center">{{$moto->modelo_moto}}</td>
                                                    <td class="dominio-moto" style="text-align: center">{{$moto->dominio}}</td>
                                                    <td class="color-moto" style="text-align: center">{{$moto->color_moto}}</td>
                                                    <td class="anio-moto" style="text-align: center">{{$moto->anio_moto}}</td>
                                                    <td class="precio_compra-moto" style="text-align: center">${{number_format($moto->precio_compra, 2, '.', ',')}}</td>
                                                    <td>{{$moto->cilindrada_moto}}cc</td>
                                                    <td style="vertical-align: middle; text-align:center;">
                                                        <div class="d-flex justify-content-center" style="display: flex; justify-content: center; gap: 5px;" role="group" aria-label="Acciones moto">
                                                            <!-- Ver -->
                                                            <button style="text-align: center" type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#VerMotoModal" onclick="verMoto({{ $moto->id }})">
                                                                <i class="fas fa-eye"></i>
                                                            </button>

                                                            <!-- Editar -->
                                                            <a href="{{ route('compras.motos.edit', ['compraId' => $compra->id, 'motoId' => $moto->id]) }}" class="btn btn-warning btn-sm rounded">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            <!-- Eliminar -->
                                                            <button type="button" class="btn btn-danger btn-sm rounded" onclick="eliminarMoto(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-right mt-2">
                                        <strong>Total de compra:</strong> <span id="total_compra">${{number_format($totalCompra, 2, '.', ',')}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="total_compra" id="precio_total_input" value="0" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 ml-auto">
                                    <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Actualizar compra
                                    </button>
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary btn-block">
                                    Volver
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Listado de proveedores</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="mitabla2" class="table table-striped table-bordered table-hover table-sm table-responsive">
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
                                                @foreach($proveedores as $proveedore)
                                                    <tr>
                                                        <td style="text-align: center;vertical-align:middle;">{{$contador++}}</td>
                                                        <td style="text-align: center;vertical-align:middle;">
                                                            <button type="button" class="btn btn-info seleccionar-btn-proveedor" data-id="{{$proveedore->id}}" data-nombre_proveedor="{{$proveedore->nombre_proveedor}}">Seleccionar</button>
                                                        </td>
                                                        <td style="vertical-align:middle;">{{$proveedore->nombre_proveedor}}</td>
                                                        <td style="vertical-align:middle;">{{$proveedore->cuit}}</td>
                                                        <td style="vertical-align:middle;">{{$proveedore->telefono}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal para agregar el detalle de la moto -->
                    <div class="modal" id="crearMotoModal" tabindex="-1" role="dialog" aria-modal="true"
                    aria-labelledby="crearRolLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header text-white d-flex justify-content-center" style="background-color: #252652">
                                <h4 class="modal-title text-center">
                                    <i class="fa-solid fa-motorcycle"></i>
                                    <span id="modalActionText">Agregar</span> detalle de la moto
                                    <i class="fa-solid fa-motorcycle"></i>
                                </h4>
                                <button type="button" class="close position-absolute" style="right: 20px" data-dismiss="modal" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-outline">
                                            <div class="col-md-12 mx-auto mt-2">
                                                <div class="card card-info">
                                                    <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                                        <!-- Datos de Moto -->
                                                        <div class="row">
                                                            <input type="hidden" id="compra_id" value="{{ $compra->id }}">
                                                            <input type="hidden" id="fecha_compra" value="{{ $compra->fecha_compra }}">
                                                            <!-- Primera Columna: Datos -->
                                                            <div class="col-md-9">
                                                                <!-- Fila 1 -->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Marca</label> <b style="color: red;">*</b>
                                                                        <select class="form-control" name="id_marca" id="id_marca">
                                                                            <option value="">Seleccione una marca</option>
                                                                            @foreach ($marcas as $marca)
                                                                                <option value="{{ $marca->id }}" {{ old('id_marca')}}>
                                                                                    {{ $marca->nombre_marca }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Modelo</label> <b style="color: red;">*</b>
                                                                        <input type="text" value="{{ is_array(old('modelo_moto')) ? implode(', ', old('modelo_moto')) : old('modelo_moto') }}" name="modelo_moto" id="modelo_moto" class="form-control" placeholder="Modelo" >
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Dominio</label><b style="color: red;"></b>
                                                                        <input type="text" name="dominio" id="dominio" class="form-control" placeholder="Dominio">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Cilindrada</label><b style="color: red;">*</b>
                                                                        <input type="number" min="0" name="cilindrada_moto" id="cilindrada_moto" class="form-control" placeholder="Cilindrada" >
                                                                    </div>
                                                                </div>

                                                                <!-- Fila 2 -->
                                                                <div class="row mt-2">
                                                                    <div class="col-md-2">
                                                                        <label>Color</label><b style="color: red;">*</b>
                                                                        <input type="text" name="color_moto" id="color_moto" class="form-control" placeholder="Color" >
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Nacionalidad</label><b style="color: red;">*</b>
                                                                        <select class="form-control" name="id_nacionalidad" id="id_nacionalidad" >
                                                                            <option value="">Seleccione una Nacionalidad</option>
                                                                            @foreach ($nacionalidades as $nacionalidad)
                                                                                <option value="{{ $nacionalidad->id }}" data-nombre_nacionalidad="{{ $nacionalidad->pais }}">
                                                                                    {{ $nacionalidad->pais }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Año</label><b style="color: red;">*</b>
                                                                        <input type="number" min="0" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año" >
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Km</label><b style="color: red;">*</b>
                                                                        <input type="number" min="0" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje" >
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check mt-4">
                                                                            <input class="form-check-input" name="es_usada" id="es_usada" type="checkbox">
                                                                            <label class="form-check-label">¿Es usada?</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Fila 3 -->
                                                                <div class="row mt-2">
                                                                    <div class="col-md-6">
                                                                        <label>Nro. Motor</label><b style="color: red;">*</b>
                                                                        <input type="text" name="nr_motor" id="nr_motor" class="form-control" placeholder="Nro. Motor" >
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                                        <input type="text" name="nr_chasis" id="nr_chasis" class="form-control" placeholder="Nro. Chasis" >
                                                                    </div>
                                                                </div>

                                                                <!-- Fila 4 -->
                                                                <div class="row mt-2">
                                                                    <div class="col-md-6">
                                                                        <label>D.N.R.P.A</label><b style="color: red;"></b>
                                                                        <input type="text" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Certificado</label><b style="color: red;"></b>
                                                                        <input type="text" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado" >
                                                                    </div>
                                                                </div>

                                                                <!-- Fila 5 -->
                                                                <div class="row mt-2">
                                                                    <div class="col-md-4">
                                                                        <label>Precio compra</label><b style="color: red;">*</b>
                                                                        <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio compra" >
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Precio venta</label>
                                                                        <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio venta" >
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Deposito</label><b style="color: red;">*</b>
                                                                        <select class="form-control" id="id_deposito" name="id_deposito" >
                                                                            <option value="">Seleccione un Deposito</option>
                                                                            @foreach ($depositos as $deposito)
                                                                                <option value="{{ $deposito->id }}">{{ $deposito->nombre_deposito }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Segunda Columna: Imagen -->
                                                            <div class="col-md-3">
                                                                <div class="text-center">
                                                                    <div class="form-group">
                                                                        <label for="imagen">Imagen</label>
                                                                        <input type="file" id="imagen_moto" name="imagen_moto[]" accept=".jpg, .jpeg, .png" class="form-control" multiple>
                                                                        @error('imagen_moto')
                                                                            <small style="color: red;">{{ $message }}</small>
                                                                        @enderror
                                                                        <br>
                                                                        <center><output id="list"></output></center>
                                                                    </div>
                                                                    <!-- Contenedor para previsualización -->
                                                                    <div id="preview-container" class="mt-2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- .card-body -->
                                                </div> <!-- .card-info -->
                                            </div> <!-- .col-md-12 mx-auto -->
                                        </div> <!-- .card-outline -->
                                    </div> <!-- .col-md-12 -->
                                </div> <!-- .row -->

                                <div class="modal-footer">
                                    <button type="button" onclick="agregarMotoATabla()" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Guardar moto
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-cancel"></i> Cancelar
                                    </button>
                                </div>
                            </div> <!-- .modal-body -->
                        </div> <!-- .modal-content -->
                    </div> <!-- .modal-dialog -->
                    </div> <!-- .modal -->
                    <!-- Modal Ver Moto -->
                    <div class="modal fade" id="VerMotoModal" tabindex="-1" role="dialog" aria-labelledby="VerMotoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                            <h5 class="modal-title" id="VerMotoModalLabel">Detalles de la Moto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" id="contenido-ver-moto">
                            <!-- Aquí se inyecta el contenido dinámico -->
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Fin modal ver moto -->
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop
@section('css')
@stop
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Asignar el total que viene desde la BD
            let totalDesdeBD = @json($compra->total_compra);
            document.getElementById("precio_total_input").value = totalDesdeBD;
        });
    </script>
    <script>

        $('.seleccionar-btn-proveedor').click(function(){
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
        formData.append('fecha_compra', $('#fecha_compra').val());
        formData.append('compra_id', $('#compra_id').val());
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

        // Imagen (solo la primera, se puede adaptar a múltiples)
        const imagenInput = document.getElementById('imagen_moto');
        if (imagenInput.files.length > 0) {
            formData.append('imagen_moto', imagenInput.files[0]);
        }

        // CSRF token
        formData.append('_token', '{{ csrf_token() }}');

        // Enviar AJAX
        $.ajax({
            url: '{{ route("admin.compras.motos.create") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: {
            withCredentials: true
            },
            success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: res.message,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#28a745'
                        }).then(() => {
                            $('#crearMotoModal').modal('hide');
                            cargarMotosATabla();
                            // Limpiar errores y formulario
                            $('.text-error').remove();
                            $('#formAgregarMoto')[0].reset();
                        });
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
                            $(`[name="${campo}"]`).after(`<small class="text-error" style="color:red">${mensaje}</small>`);
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            text: 'Por favor corrige los errores marcados.',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#dc3545'
                        });

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
        function verMoto(id) {
            const fila = document.querySelector(`tr[data-id='${id}']`);
            if (!fila) {
                console.error("No se encontró la fila de la moto ID: " + id);
                return;
            }

            const marca = fila.querySelector('.marca-moto')?.innerText || 'N/A';
            const modelo = fila.querySelector('.modelo-moto')?.innerText || 'N/A';
            const color = fila.querySelector('.color-moto')?.innerText || 'N/A';
            const dominio = fila.querySelector('.dominio-moto')?.innerText || 'N/A';
            const anio = fila.querySelector('.anio-moto')?.innerText || 'N/A';
            const precio_compra = fila.querySelector('.precio_compra-moto')?.innerText || 'N/A';
            const precio_venta = fila.dataset.precio_venta || 'N/A';
            const imagenUrl = fila.dataset.imagen;
            const cilindrada = fila.dataset.cilindrada || '';
            const nrMotor = fila.dataset.nrMotor || '';
            const nrChasis = fila.dataset.nrChasis || '';
            const certificado = fila.dataset.certificado || 'N/A';
            const dnrpa = fila.dataset.dnrpa || 'N/A';
            const km_moto = fila.dataset.km_moto || '';
            const nacionalidad = fila.dataset.nacionalidad || 'N/D';
            const condicion = fila.dataset.condicion || 'N/D';
            const contenido = `
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Marca:</strong> ${marca}</p>
                        <p><strong>Modelo:</strong> ${modelo}</p>
                        <p><strong>Color:</strong> ${color}</p>
                        <p><strong>Dominio:</strong> ${dominio}</p>
                        <p><strong>Año:</strong> ${anio}</p>
                        <p><strong>Precio compra:</strong> ${precio_compra}</p>
                        <p><strong>Nacionalidad:</strong> ${nacionalidad}</p>

                    </div>
                    <div class="col-md-4">
                        <p><strong>Precio venta:</strong> $${precio_venta}</p>
                        <p><strong>Cilindrada:</strong> ${cilindrada}</p>
                        <p><strong>Nr de motor:</strong> ${nrMotor}</p>
                        <p><strong>Nr de chasis:</strong> ${nrChasis}</p>
                        <p><strong>Certificado:</strong> ${certificado}</p>
                        <p><strong>DNRPA:</strong> ${dnrpa}</p>
                        <p><strong>Condición:</strong> ${condicion}</p>
                    </div>
                    <div class="col-md-4">
                        ${imagenUrl ? `<img src="${imagenUrl}" class="img-fluid img-thumbnail mt-2" style="max-width: 200px;">` : '<p><em>Sin imagen</em></p>'}
                    </div>
                </div>

            `;

            document.getElementById('contenido-ver-moto').innerHTML = contenido;
        }
    </script>
    <script>
        function eliminarMoto(button) {
            const fila = button.closest('tr');
            const motoId = fila.getAttribute('data-id');

            if (!motoId) {
                Swal.fire('Error', 'No se pudo identificar la moto para eliminar.', 'error');
                return;
            }

            Swal.fire({
                title: '¿Desea eliminar este registro?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonColor: '#270a0a',
                denyButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: `/admin/compras/motos/${motoId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Eliminado', response.message || 'Moto eliminada correctamente', 'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            } else {
                                // Aquí capturamos el mensaje cuando está vendida
                                Swal.fire('No permitido', response.message || 'No se puede eliminar la moto.', 'warning');
                            }
                        },
                        error: function(xhr) {
                            let mensaje = 'Error en la petición de eliminación';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                mensaje = xhr.responseJSON.message; // mensaje del backend (ej: vendida)
                            }
                            Swal.fire('Error', mensaje, 'error');
                            console.error(xhr);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Cancelado', 'La eliminación fue cancelada', 'info');
                }
            });
        }
    </script>

@stop