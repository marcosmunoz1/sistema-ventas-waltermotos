@extends('adminlte::page')

@section('title', 'Crear Venta')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Crear-Venta</b></h2>
    <hr>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-success">

            <div class="card-body">
                <form action="{{ url('/admin/ventas/crear-venta') }}" id="form_compra" method="post">
                    @csrf

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <label style="align-content: center">Fecha </label>
                                <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                                    class="form-control mx-3" required>
                                @error('fecha')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- buscar cliente -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#buscarClienteModal">
                                        <i class="fas fa-search"></i> Buscar Cliente <i class="fas fa-user"></i>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="hidden" name="cliente_id">
                                            <h6><strong>Cliente:</strong> <span id="clienteNombreCompleto"></span> </h6>
                                            <h6><strong>Teléfono:</strong> <span id="clienteTelefono"></h6>
                                            <h6><strong>Email:</strong> <span id="clienteEmail"></h6>
                                            <h6><strong>DNI:</strong> <span id="clienteDni"></span></h6>
                                        </div>
                                        <div class="col-6">
                                            <strong>Estado Civil:</strong> <span id="clienteEstado"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- buscar conyuge -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                        data-target="#buscarConyugeModal">
                                        <i class="fas fa-edit"></i> Editar Conyugue <i class="fas fa-user"></i>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <h6><strong>Conyugue:</strong> <span id="conyugueNombreCompleto"></span> </h6>
                                    <h6><strong>Teléfono:</strong> <span id="conyugueTelefono"></h6>
                                    <h6><strong>Fecha Nacimiento:</strong> <span id="conyugueFecha"></h6>
                                    <h6><strong>DNI:</strong> <span id="conyugueDni"></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <!-- Botón para buscar Moto -->
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#buscarMotoModal">
                            <i class="fas fa-search"></i> Buscar Moto <i class="fas fa-motorcycle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <input type="hidden" name="id_moto">
                                <h6><strong>Marca:</strong> <span id="motoMarca"></span> </h6>
                                <h6><strong>Modelo:</strong> <span id="motoModelo"></span></h6>
                                <h6><strong>Año:</strong> <span id="motoAnio"></span></h6>
                                <h6><strong>Dominio:</strong> <span id="motoDominio"></span></h6>
                            </div>
                            <div class="col-4">
                                <h6><strong>Color:</strong> <span id="motoColor"></span></h6>
                                <h6><strong>Cilindradas:</strong> <span id="motoCilindrada"></span> </h6>
                                <h6><strong>Nacionalidad:</strong> <span id="motoPais"></span> </h6>
                                <h6><strong>Km:</strong> <span id="motoKm"></span> </h6>
                                
                            </div>
                            <div class="col-4">
                                <h6><strong>DNRPA:</strong> <span id="motoDnrpa"></span> </h6>
                                <h6><strong>Nro. Certificado:</strong> <span id="motoCertificado"></span> </h6>
                                <h6><strong>Nro. Motor:</strong> <span id="motoMotor"></span> </h6>
                                <h6><strong>Nro. Chasis:</strong> <span id="motoChasis"></span> </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- Botones de acción -->
        <div class="card-footer ">
            <button type="submit" class="btn btn-success" id="btnRegistrar">
                <i class="fas fa-save"></i> Registrar
            </button>
            <a href="{{ url('admin/ventas') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </div>

    <!-- Modal para Buscar Cliente -->
    <div class="modal fade" id="buscarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="clientesModalLabel">Buscar Cliente</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <table class="table table-ms table-striped" id="tablaClientes"
                            style="table-layout: fixed; width: 100%;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">...</th>
                                    <th scope="col" style="width: 25%;">Apellido</th>
                                    <th scope="col" style="width: 25%;">Nombre</th>
                                    <th scope="col" style="width: 10%;">DNI</th>
                                    <th scope="col" style="width: 20%;">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <button class="btn btn-info"
                                                onclick="seleccionarClienteDesdeModal( 
                                                    '{{ $cliente->id }}', 
                                                    '{{ $cliente->apellido_cliente }}', 
                                                    '{{ $cliente->nombre_cliente }}', 
                                                    '{{ $cliente->dni_cliente }}', 
                                                    '{{ $cliente->celular_cliente }}', 
                                                    '{{ $cliente->email_cliente }}',
                                                    '{{ $cliente->estado_civil_cliente }}',
                                                     @if ($cliente->conyugue) '{{ $cliente->conyugue->apellido_conyugue }}',
                                                        '{{ $cliente->conyugue->nombre_conyugue }}',
                                                        '{{ $cliente->conyugue->dni_conyugue }}',
                                                        '{{ $cliente->conyugue->celular_conyugue }}',
                                                        '{{ $cliente->conyugue->fecha_nacimiento_conyugue }}'
                                                    @else
                                                        '', '', '', '', '' @endif    
                                                    )">
                                                <i class="fa-solid fa-circle-plus"></i>
                                            </button>
                                        </td>
                                        <td class="text-truncate" style="vertical-align: middle;">
                                            {{ $cliente->apellido_cliente }}
                                        </td>
                                        <td class="text-truncate" style="vertical-align: middle;">
                                            {{ $cliente->nombre_cliente }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            {{ $cliente->dni_cliente }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            {{ $cliente->telefono_cliente }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            {{ $cliente->email_cliente }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Cliente -->
    <div class="modal fade" id="nuevoClientesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">Nuevo Cliente</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mx-auto mt-4">
                        <div class="card card-info">
                            <div class="card-body">
                                <!-- Primera fila: Nombre de Usuario y Nombre del Rol -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido">Apellido </label><b style="color: red;"> *</b>
                                            <input type="text" name="apellido" id="apellido" class="form-control"
                                                required value="{{ old('apellido') }}"
                                                placeholder="Ingrese el apellido de cliente">
                                            @error('apellido')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="nombre">Nombre </label><b style="color: red;"> *</b>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                required value="{{ old('nombre') }}" placeholder="Ingrese el nombre">
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni">D.N.I </label><b style="color: red;"> *</b>
                                            <input type="text" name="dni" id="dni" class="form-control"
                                                value="{{ old('dni') }}"
                                                placeholder="Ingrese el documento del cliente">
                                            @error('dni')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <!-- Segunda fila: Correo -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control"
                                                value="{{ old('telefono') }}" placeholder="Ingrese un telefono">
                                            @error('telefono')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control"
                                                value="{{ old('direccion') }}" placeholder="Ingrese una direccion">
                                            @error('direccion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Ingrese un correo electrónico">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <!-- Botones de acción -->
                                <div class="card-footer text-right">
                                    <button type="button" onclick="guardarCliente()" class="btn btn-success">
                                        <i class="fas fa-save"></i> Registrar
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                                    </button>
                                </div>

                                </form> <!-- Cierre correcto del formulario -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Conyugue -->
    <div class="modal fade" id="buscarConyugeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="clientesModalLabel">Cónyugue</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Modifique los Datos</h3>
                                </div>
                                <div class="col-md-12 mx-auto d-flex justify-content-center">
                                    <div class="card-body">
                                        <div class="card card-info">
                                            <form action="{{ url('/admin/conyugues', $cliente->id_conyugue_cliente) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="card-body">
                                                    @if ($cliente->conyugue)
                                                        <!-- Mostrar datos del conyugue -->
                                                        <div class="form-group">
                                                            <label for="apellido_conyugue">Apellido</label>
                                                            <input type="text" name="apellido_conyugue"
                                                                class="form-control" required
                                                                value="{{ $cliente->conyugue->apellido_conyugue }}"
                                                                placeholder="Ingrese el apellido del cónyuge">
                                                            @error('apellido_conyugue')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nombre_conyugue">Nombre</label>
                                                            <input type="text" name="nombre_conyugue"
                                                                class="form-control" required
                                                                value="{{ $cliente->conyugue->nombre_conyugue }}"
                                                                placeholder="Ingrese el nombre del cónyuge">
                                                            @error('nombre_conyugue')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="dni_conyugue">DNI</label>
                                                            <input type="text" name="dni_conyugue"
                                                                class="form-control" required
                                                                value="{{ $cliente->conyugue->dni_conyugue }}"
                                                                placeholder="Ingrese el DNI del cónyuge">
                                                            @error('dni_conyugue')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="celular_conyugue">Celular</label>
                                                            <input type="text" name="celular_conyugue"
                                                                class="form-control" required
                                                                value="{{ $cliente->conyugue->celular_conyugue }}"
                                                                placeholder="Ingrese el celular del cónyuge">
                                                            @error('celular_conyugue')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento_conyugue">Fecha de
                                                                Nacimiento</label>
                                                            <input type="date" name="fecha_nacimiento_conyugue"
                                                                class="form-control" required
                                                                value="{{ $cliente->conyugue->fecha_nacimiento_conyugue }}">
                                                            @error('fecha_nacimiento_conyugue')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <p>No tiene cónyuge registrado.</p>
                                                    @endif
                                                </div>

                                                <div class="card-footer text-right">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="fa-solid fa-file-arrow-up"></i> Actualizar
                                                    </button>
                                                    <butto class="btn btn-secondary" data-dismiss="modal">
                                                        <i class="fas fa-cancel"></i> Cancelar
                                                        </button>
                                                </div>
                                            </form>
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

    <!-- Modal para Buscar Moto -->
    <div class="modal fade" id="buscarMotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="clientesModalLabel">Buscar Moto</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <table class="table table-ms table-striped" id="tablaMotos">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">...</th>
                                    <th class="text-center" style="width: 10%">Marca</th>
                                    <th class="text-center" style="width: 10%">Modelo</th>
                                    <th class="text-center" style="width: 5%">Año</th>
                                    <th class="text-center" style="width: 10%">Nacionalidad</th>
                                    <th class="text-center" style="width: 10%">P. Compra</th>
                                    <th class="text-center" style="width: 10%">P. Venta</th>
                                    <th class="text-center" style="width: 10%">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($motos as $moto)
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <button class="btn btn-info"
                                                onclick="seleccionarMotoDesdeModal(
                                                '{{ $moto->id }}', 
                                                '{{ $moto->marca->nombre_marca }}', 
                                                '{{ $moto->modelo_moto }}',
                                                '{{ $moto->dominio }}',
                                                '{{ $moto->color_moto }}',
                                                '{{ $moto->anio_moto }}',
                                                '{{ $moto->km_moto }}',
                                                '{{ $moto->cilindrada_moto }}', 
                                                '{{ $moto->nacionalidad->pais }}', 
                                                '{{ $moto->nr_motor }}', 
                                                '{{ $moto->nr_chasis }}', 
                                                '{{ $moto->nr_certificado }}', 
                                                '{{ $moto->dnrpa }}'
                                            )">
                                                <i class="fa-solid fa-circle-plus"></i>
                                            </button>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            {{ $moto->marca->nombre_marca }}</td>
                                        <td class="text-center" style="vertical-align: middle">{{ $moto->modelo_moto }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">{{ $moto->anio_moto }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            {{ $moto->nacionalidad->pais }}</td>
                                        <td class="text-end text-success bg-light fs-5" style="vertical-align: middle">
                                            ${{ number_format($moto->precio_compra, 2, ',', '.') }}
                                        </td>
                                        <td class="text-end text-danger bg-light fs-5" style="vertical-align: middle">
                                            ${{ number_format($moto->precio_venta, 2, ',', '.') }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <img src="{{ asset('storage/' . $moto->imagen_moto) }}"
                                                style="max-width: 100%; width: auto;" alt="">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
@endsection

@section('js')
    {{-- Aquí puedes agregar scripts adicionales --}}

    {{-- Script de Clientes --}}
    <script>
        $(document).ready(function() {
            $('#tablaClientes').DataTable({
                "pageLength": 5,
                "language": {
                    "emptyTable": "No hay información.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                    "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                    "lengthMenu": "Mostrar _MENU_ Clientes",
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
        });


        // Función para seleccionar el cliente desde el modal
        function seleccionarClienteDesdeModal(id, apellido, nombre, dni, telefono, email, estado_civil_cliente,
            apellido_conyugue, nombre_conyugue, dni_conyugue, celular_conyugue, fecha_nacimiento_conyugue) {

            const nombreCompleto = apellido + ', ' + nombre;
            document.querySelector('input[name="cliente_id"]').value = id;

            // Mostrar los datos del cliente 
            document.getElementById('clienteNombreCompleto').textContent = nombreCompleto;
            document.getElementById('clienteTelefono').textContent = telefono;
            document.getElementById('clienteEmail').textContent = email;
            document.getElementById('clienteDni').textContent = dni;
            document.getElementById('clienteEstado').textContent = estado_civil_cliente;

            // Mostrar los datos del cónyuge, solo si existen
            if (apellido_conyugue && nombre_conyugue) {
                const nombreCompletoConyugue = apellido_conyugue + ', ' + nombre_conyugue;
                document.getElementById('conyugueNombreCompleto').textContent = nombreCompletoConyugue;
                document.getElementById('conyugueTelefono').textContent = celular_conyugue || 'No disponible';
                document.getElementById('conyugueFecha').textContent = fecha_nacimiento_conyugue || 'No disponible';
                document.getElementById('conyugueDni').textContent = dni_conyugue || 'No disponible';
            } else {
                document.getElementById('conyugueNombreCompleto').textContent = 'No Tiene';
                document.getElementById('conyugueTelefono').textContent = '';
                document.getElementById('conyugueFecha').textContent = '';
                document.getElementById('conyugueDni').textContent = '';
            }

            // Cerrar el modal
            $('#buscarClienteModal').modal('hide');
        }
    </script>

    {{-- Script de Motos --}}
    <script>
        $(document).ready(function() {
            $('#tablaMotos').DataTable({
                "pageLength": 5,
                "language": {
                    "emptyTable": "No hay información.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Motos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Motos",
                    "infoFiltered": "(Filtrado de _MAX_ total Motos)",
                    "lengthMenu": "Mostrar _MENU_ Motos",
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
        });

        function seleccionarMotoDesdeModal(id, nombre_marca, modelo_moto, dominio, color_moto, anio_moto,
            km_moto, cilindrada_moto, pais, nr_motor, nr_chasis, nr_certificado, dnrpa) {


            // Depuración para ver los valores que se están pasando
            console.log('Datos recibidos:', {
                id,
                nombre_marca,
                modelo_moto,
                dominio,
                color_moto,
                anio_moto,
                km_moto,
                cilindrada_moto,
                pais,
                nr_motor,
                nr_chasis,
                nr_certificado,
                dnrpa
            });

            document.querySelector('input[name="id_moto"]').value = id;
            document.getElementById('motoMarca').textContent = nombre_marca || 'N/A';
            document.getElementById('motoModelo').textContent = modelo_moto || 'N/A';
            document.getElementById('motoDominio').textContent = dominio || 'N/A';
            document.getElementById('motoColor').textContent = color_moto || 'N/A';
            document.getElementById('motoAnio').textContent = anio_moto || 'N/A';
            document.getElementById('motoKm').textContent = km_moto || 'N/A';
            document.getElementById('motoCilindrada').textContent = cilindrada_moto || 'N/A';
            document.getElementById('motoPais').textContent = pais || 'N/A';
            document.getElementById('motoMotor').textContent = nr_motor || 'N/A';
            document.getElementById('motoChasis').textContent = nr_chasis || 'N/A';
            document.getElementById('motoCertificado').textContent = nr_certificado || 'N/A';
            document.getElementById('motoDnrpa').textContent = dnrpa || 'N/A';

            // Cerrar el modal
            $('#buscarMotoModal').modal('hide');

        }
    </script>

@endsection
