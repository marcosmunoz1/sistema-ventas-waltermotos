@extends('adminlte::page')

@section('title', 'Crear Venta')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Nueva-Venta</b></h2>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-success ">
            <form action="{{ url('/admin/ventas/crear-venta') }}" id="form_venta" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div
                            class="col-md-8 card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                            <!-- buscar cliente -->
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                data-target="#buscarClienteModal">
                                                <i class="fas fa-search"></i> Buscar Cliente <i class="fas fa-user"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                data-target="#buscarClienteModal">
                                                <i class="fas fa-plus"></i> Cliente
                                            </button>
                                        </div>
                                        <div class="mx-2 mt-2">
                                            <input type="hidden" name="id_cliente">
                                            <h6><strong>Cliente:</strong><span id="clienteNombreCompleto"></span></h6>
                                            <h6><strong>Teléfono:</strong> <span id="clienteTelefono"></h6>
                                            <h6><strong>Email:</strong> <span id="clienteEmail"></h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6><strong>DNI:</strong> <span id="clienteDni"></span></h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6><strong>Estado Civil:</strong> <span id="clienteEstado"></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- buscar conyuge -->
                                <div class="col-md-5">
                                    <div class="card">

                                        <div class="card-footer text-center">
                                            <h5> Conyugue <i class="fas fa-user-friends"></i>
                                            </h5>
                                            {{--   <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                                data-target="#buscarConyugeModal">
                                                <i class="fas fa-edit"></i> Editar Conyugue <i
                                                    class="fas fa-user-friends"></i>
                                            </button> --}}
                                        </div>

                                        <div class="mx-2 mt-2">
                                            <h6><strong>Conyugue:</strong> <span id="conyugueNombreCompleto"></span>
                                            </h6>
                                            <h6><strong>Teléfono:</strong> <span id="conyugueTelefono"></h6>
                                            <h6><strong>Fecha Nacimiento:</strong> <span id="conyugueFecha"></h6>
                                            <h6><strong>DNI:</strong> <span id="conyugueDni"></span></h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <!-- Botón para buscar Moto -->
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#buscarMotoModal">
                                        <i class="fas fa-search"></i> Buscar Moto <i class="fas fa-motorcycle"></i>
                                    </button>
                                </div>
                                <div class="mx-2 mt-2">
                                    <div class="row">
                                        <div class="col-3">
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
                                        <div class="col-5">
                                            <h6><strong>DNRPA:</strong> <span id="motoDnrpa"></span> </h6>
                                            <h6><strong>Nro. Certificado:</strong> <span id="motoCertificado"></span>
                                            </h6>
                                            <h6><strong>Nro. Motor:</strong> <span id="motoMotor"></span> </h6>
                                            <h6><strong>Nro. Chasis:</strong> <span id="motoChasis"></span> </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card">
                                <div class="card-footer text-center">
                                    <h5 class="text-center text-success"><i class="fa-solid fa-hand-holding-dollar"></i>
                                        Forma de Pago
                                    </h5>
                                </div>
                                <div class="mx-2 mt-2 mb-2">
                                    <!-- Campo Fecha -->
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-text">Fecha:</span>
                                            <input type="date" id="fecha" name="fecha"
                                                value="{{ old('fecha', date('Y-m-d')) }}" class="form-control" required>
                                            @error('fecha')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo Forma de Pago -->
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-text">Forma de Pago:</span>
                                            <select id="formaPago" name="forma_pago" class="form-control" required>
                                                <option value="Contado"
                                                    {{ old('forma_pago') == 'Contado' ? 'selected' : '' }}>Contado</option>
                                                <option value="Credito"
                                                    {{ old('forma_pago') == 'Credito' ? 'selected' : '' }}>Crédito</option>
                                            </select>
                                            @error('forma_pago')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo Precio de Venta -->
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-text">Precio de Venta: $</span>
                                            <input type="text" id="precioVentaFormatted"
                                                class="form-control text-danger"
                                                value="{{ number_format($moto->precio_venta ?? 0, 0, ',', '.') }}">
                                            <input type="hidden" id="precioVenta" name="precio_venta"
                                                value="{{ $moto->precio_venta ?? 0 }}">
                                        </div>

                                        @error('precio_venta')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <!-- Campos ocultos que se mostrarán cuando se seleccione "Credito" -->
                                    <div class="form-group" id="campo-credito" style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-text">Entrega: $</span>
                                            <input type="text" class="form-control text-success"
                                                id="entregaFormatted">
                                            <input type="hidden" id="entrega" name="entrega">
                                        </div>
                                        <hr>
                                        <div class="input-group">
                                            <span class="input-group-text">Monto a Financiar: $</span>
                                            <input type="text" id="saldoFormatted" class="form-control text-primary"
                                                readonly>
                                            <input type="hidden" id="saldo" name="saldo">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Cantidad de Cuotas</span>
                                            <input type="number" id="cuotas" name="cuotas" class="form-control"
                                                min="1" value="1">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Interés:</span>
                                            <input type="number" id="interes" name="interes" class="form-control"
                                                value="0">
                                            <span class="input-group-text"
                                                style="width: 80px; display: inline-block; text-align: left;">%</span>
                                        </div>
                                        <hr>
                                        <div class="input-group">
                                            <span class="input-group-text">Valor de la Cuota:</span>
                                            <input type="text" id="valorCuotaFormatted" class="form-control" readonly>
                                            <input type="hidden" id="valorCuota" name="valor_cuota">
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>



                    </div>

                </div>
                <!-- Botones de acción -->
                <div class="card-footer text-right ">
                    <button type="submit" class="btn btn-success" id="">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                    <a href="{{ url('admin/ventas') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>


        <!-- Modal para Buscar Cliente -->
        <div class="modal fade" id="buscarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="clientesModalLabel">Buscar Cliente</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table">
                            <table id="tablaClientes" class="table table-striped table-bordered table-hover table-sm">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col" class="text-center">...</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">DNI</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">e-Mail</th>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-cancel"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Nuevo Cliente -->
        <div class="modal fade" id="nuevoClientesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5">Nuevo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                                                <input type="text" name="apellido" id="apellido"
                                                    class="form-control" required value="{{ old('apellido') }}"
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
                                                <input type="text" name="telefono" id="telefono"
                                                    class="form-control" value="{{ old('telefono') }}"
                                                    placeholder="Ingrese un telefono">
                                                @error('telefono')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" name="direccion" id="direccion"
                                                    class="form-control" value="{{ old('direccion') }}"
                                                    placeholder="Ingrese una direccion">
                                                @error('direccion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Correo</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ old('email') }}"
                                                    placeholder="Ingrese un correo electrónico">
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
                                                <form
                                                    action="{{ url('/admin/conyugues', $cliente->id_conyugue_cliente) }}"
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
        <div class="modal fade" id="buscarMotoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="clientesModalLabel">Buscar Moto</h3>
                        <button type="button" class="close position-absolute" style="right: 20px" data-dismiss="modal"
                            aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table">
                            <table class="table table-sm table-striped" id="tablaMotos">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 5%;">...</th>
                                        <th class="text-center" style="width: 10%">Marca</th>
                                        <th class="text-center" style="width: 10%">Modelo</th>
                                        <th class="text-center" style="width: 5%">Año</th>
                                        <th class="text-center" style="width: 10%">Nacionalidad</th>
                                        <th class="text-center" style="width: 5%">P. Compra</th>
                                        <th class="text-center" style="width: 5%">P. Venta</th>
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
                                                '{{ $moto->dnrpa }}',
                                                '{{ $moto->precio_venta }}'
                                            )">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                </button>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $moto->marca->nombre_marca }}</td>
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $moto->modelo_moto }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">{{ $moto->anio_moto }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $moto->nacionalidad->pais }}</td>
                                            <td class="text-right text-success" style="vertical-align: middle">
                                                ${{ number_format($moto->precio_compra, 2, ',', '.') }}
                                            </td>
                                            <td class="text-right text-danger" style="vertical-align: middle">
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

        <style>
            .input-group-text {
                width: 50%;
                display: inline-block;
                text-align: right;
            }
        </style>

    @endsection

    @section('js')
        <script>
            // ============================
            // Inicializar DataTables
            // ============================
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
                    },
                });

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

            // ============================
            // Seleccionar Cliente desde Modal
            // ============================
            function seleccionarClienteDesdeModal(id, apellido, nombre, dni, telefono, email,
                estado_civil_cliente, apellido_conyugue, nombre_conyugue, dni_conyugue,
                celular_conyugue, fecha_nacimiento_conyugue) {

                const nombreCompleto = apellido + ', ' + nombre;
                document.querySelector('input[name="id_cliente"]').value = id;

                // Datos cliente
                document.getElementById('clienteNombreCompleto').textContent = nombreCompleto;
                document.getElementById('clienteTelefono').textContent = telefono;
                document.getElementById('clienteEmail').textContent = email;
                document.getElementById('clienteDni').textContent = dni;
                document.getElementById('clienteEstado').textContent = estado_civil_cliente;

                // Datos cónyuge
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

                $('#buscarClienteModal').modal('hide');
            }

            // ============================
            // Seleccionar Moto desde Modal
            // ============================
            function seleccionarMotoDesdeModal(id, nombre_marca, modelo_moto, dominio, color_moto,
                anio_moto, km_moto, cilindrada_moto, pais, nr_motor, nr_chasis,
                nr_certificado, dnrpa, precio_venta) {

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

                // Guardar en hidden
                document.getElementById('precioVenta').value = precio_venta;

                // Mostrar formateado
                if (precio_venta) {
                    document.getElementById('precioVentaFormatted').value =
                        parseFloat(precio_venta).toLocaleString('es-AR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                } else {
                    document.getElementById('precioVentaFormatted').value = '';
                }

                $('#buscarMotoModal').modal('hide');
            }

            // ============================
            // Formatear precios con hidden
            // ============================
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

            const entregaFormatted = document.getElementById('entregaFormatted');
            const entregaHidden = document.getElementById('entrega');

            entregaFormatted.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value) {
                    e.target.value = new Intl.NumberFormat('es-AR').format(value);
                    entregaHidden.value = value;
                } else {
                    e.target.value = '';
                    entregaHidden.value = '';
                }
            });

            // ============================
            // Mostrar campos de crédito
            // ============================
            $(document).ready(function() {
                // Mostrar / ocultar campos de crédito
                $('#formaPago').change(function() {
                    if ($(this).val() === 'Credito') {
                        $('#campo-credito').show();
                        calcularSaldo();
                    } else {
                        $('#campo-credito').hide();
                    }
                });

                // Función para calcular el saldo (monto a financiar)
                function calcularSaldo() {
                    var precioVenta = parseFloat($('#precioVenta').val()) || 0;
                    var entrega = parseFloat($('#entrega').val()) || 0;
                    var saldoRestante = precioVenta - entrega;

                    $('#saldo').val(saldoRestante.toFixed(2)); // valor limpio
                    $('#saldoFormatted').val(new Intl.NumberFormat('es-AR').format(saldoRestante)); // visible
                }

                // Función para calcular el valor de la cuota
                function calcularValorCuota() {
                    var saldo = parseFloat($('#saldo').val()) || 0;
                    var cuotas = parseInt($('#cuotas').val()) || 1;
                    var interes = parseFloat($('#interes').val()) || 0;
                    var valorCuota = 0;

                    if (saldo > 0 && cuotas > 0) {
                        var tasaInteresMensual = interes / 100 / 12;

                        if (tasaInteresMensual > 0) {
                            valorCuota = (saldo * tasaInteresMensual) /
                                (1 - Math.pow(1 + tasaInteresMensual, -cuotas));
                        } else {
                            valorCuota = saldo / cuotas;
                        }
                    }

                    $('#valorCuota').val(valorCuota.toFixed(2)); // limpio
                    $('#valorCuotaFormatted').val(new Intl.NumberFormat('es-AR', {
                        minimumFractionDigits: 2
                    }).format(valorCuota)); // visible
                }

                // Formatear "Entrega" mientras se escribe
                $('#entregaFormatted').on('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value) {
                        e.target.value = new Intl.NumberFormat('es-AR').format(value);
                        $('#entrega').val(value);
                    } else {
                        e.target.value = '';
                        $('#entrega').val('');
                    }
                    calcularSaldo();
                    calcularValorCuota();
                });

                // Disparadores
                $('#precioVenta').on('input', function() {
                    calcularSaldo();
                    calcularValorCuota();
                });

                $('#cuotas, #interes').on('input', function() {
                    calcularValorCuota();
                });
            });
        </script>



    @endsection
