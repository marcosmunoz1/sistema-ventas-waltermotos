@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras/Registro de una nueva compra</b></h1>
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
                    <form action="{{route('admin.compras.store')}}" id="form_compra" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crearMotoModal"><i class="fa-solid fa-cart-shopping"></i> Agregar moto</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tabla-motos">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Dominio</th>
                                                    <th>Color</th>
                                                    <th>Año</th>
                                                    <th>Precio Compra</th>
                                                    <th>Precio Venta</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se insertan dinámicamente con JS -->
                                            </tbody>
                                        </table>
                                        <div class="text-right mt-2">
                                            <strong>Total de compra:</strong> <span id="total_compra">$ 0</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_proveedor"><i class="fas fa-search"></i>Buscar proveedor</button>
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
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nombre_proveedor" disabled>
                                        <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" hidden>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de compra</label><b> *</b>
                                            <input type="date" class="form-control" value="{{old('fecha')}}" name="fecha_compra" required>
                                            @error('fecha_compra')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numero_factura">Número de factura</label><b> *</b>
                                            <input type="text" class="form-control" value="{{old('numero_factura')}}" name="numero_factura" placeholder="Ingresa el número de factura">
                                            @error('numero_factura')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numero_remito">Número de remito</label><b> *</b>
                                            <input type="text" class="form-control" value="{{old('numero_remito')}}" name="numero_remito" placeholder="Ingresa el número de remito" required>
                                            @error('numero_remito')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado_compra">Estado de compra</label><b> *</b>
                                            <select class="form-control" name="estado_compra" required>
                                                <option value="">-- Seleccionar estado --</option>
                                                <option value="Pagado" {{ old('estado_compra') == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                                <option value="Pendiente" {{ old('estado_compra') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            </select>
                                            @error('estado_compra')
                                                <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" style="text-align: center;background-color: #e9e710" type="hidden" name="total_compra" id="precio_total_input" value="0" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-save"></i> Registrar compra</button>
                                        </div>
                                    </div>
                                    @if(session('mensaje'))
                                        <div class="alert alert-success">
                                            {{ session('mensaje') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>
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
                                                            <!-- Primera Columna: Datos -->
                                                            <div class="col-md-9">
                                                                <!-- Fila 1 -->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Marca</label> <b style="color: red;">*</b>
                                                                        <select class="form-control" name="marca_moto" id="marca_moto">
                                                                            <option value="">Seleccione una marca</option>
                                                                            @foreach ($marcas as $marca)
                                                                                <option value="{{ $marca->nombre_marca }}" data-nombre_marca="{{ $marca->nombre_marca }}">
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
                                                                        <label>Precio venta</label><b style="color: red;">*</b>
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
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
            formData.append('marca_moto', $('#marca_moto').val());
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
                url: '{{ route("tmp-compras.store") }}',
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
                error: function(err) {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al agregar moto temporal.',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        }
    </script>
    <script>
        function cargarMotosATabla() {
            $.ajax({
                url: '{{ route("tmp-compras.listar") }}',
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

                        let fila = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${moto.marca_moto}</td>
                                <td>${moto.modelo_moto}</td>
                                <td>${moto.dominio}</td>
                                <td>${moto.color_moto}</td>
                                <td>${moto.anio_moto}</td>
                                <td>$${moto.precio_compra}</td>
                                <td>$${moto.precio_venta}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${moto.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(fila);
                    });

                    $('#precio_total_input').val(precio_total);
                    $('#total_compra').text(`$ ${precio_total.toLocaleString()}`);

                    asignarEventosDelete();
                },
                error: function(err) {
                    console.error(err);
                    alert('Error al obtener motos.');
                }
            });
        }

        function asignarEventosDelete() {
            $('.delete-btn').click(function(){
                var id = $(this).data('id');
                if(id){
                    $.ajax({
                        url: "{{ url('/admin/tmp-compras') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response){
                            if(response.success){
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

        // Cargar motos al iniciar la página
        $(document).ready(function() {
            cargarMotosATabla();
        });
    </script>


    <script>
        function archivo(evt) {
            var files = evt.target.files; //file List objet
            //Obtenemos la imagen del campo "file"
            for (var i = 0, f; f = files[i]; i++) {
                //solo admitimos imagenes
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        //insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="thumb thumbail" src="', e
                            .target.result, '" width="70%" title="', escape(theFile.name), '"/>'
                        ].join('');
                    };
                })(f);
                reader.readAsDataURL(f);

            }

        }
        document.getElementById('imagen_moto').addEventListener('change', archivo, false);
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
@stop

