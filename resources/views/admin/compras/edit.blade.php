@extends('layouts.app')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-warning mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Compras/<b>Editar Compra</b> </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/compras', $compra->id) }}" id="form_compra" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-info">
                                <div class="row">
                                    {{-- Proveedor --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="proveedor">Proveedor</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                    data-toggle="modal" data-target="#exampleModal_proveedor">
                                                    <i class="fas fa-search"></i> Buscar
                                                </button>
                                                <input type="text" class="form-control mx-1"
                                                    value="{{ $compra->proveedor->nombre_proveedor }}" id="nombre_proveedor"
                                                    disabled>
                                                <input type="text" class="form-control" id="id_proveedor"
                                                    value="{{ $compra->proveedor->id }}" name="id_proveedor" hidden>
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                    data-target="#modalAgregarProveedor">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Factura --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Factura</label>
                                            <input type="text" value="{{ $compra->numero_factura }}" class="form-control"
                                                id="numero_factura" name="numero_factura" placeholder="Nr. de factura"
                                                required>
                                            @error('numero_factura')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Remito --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Remito</label>
                                            <input type="text" value="{{ $compra->numero_remito }}" class="form-control"
                                                id="numero_remito" name="numero_remito" placeholder="Nr. de remito"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Fecha compra --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fecha compra</label>
                                            <input type="date" value="{{ $compra->fecha_compra }}" name="fecha_compra"
                                                id="fecha_compra" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Estado --}}
                                    <div class="col-md-2 ">
                                        <div class="form-group">
                                            <label for="estado_compra">Estado <b>*</b></label>
                                            <select class="form-control" name="estado_compra" required>
                                                <option value="">-- Seleccionar estado --</option>
                                                <option value="Pagado"
                                                    {{ old('estado_compra', $compra->estado_compra) == 'Pagado' ? 'selected' : '' }}>
                                                    Pagado</option>
                                                <option value="Pendiente"
                                                    {{ old('estado_compra', $compra->estado_compra) == 'Pendiente' ? 'selected' : '' }}>
                                                    Pendiente</option>
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
                                <div class="col-md-4 mb-1 ">
                                    <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                        data-target="#crearMotoModal"><i class="fa-solid fa-cart-shopping"></i> Agregar
                                        moto</button>
                                </div>
                            </div>


                            <table class="table table-bordered table-striped table-sm table-responsive" id="tabla-motos">
                                <thead class="bg-warning text-dark">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 10%">Marca</th>
                                        <th class="text-center" style="width: 10%">Modelo</th>
                                        {{-- <th class="text-center" style="width: 10%">Cilindrada</th> --}}
                                        <th class="text-center" style="width: 10%">Color</th>
                                        <th class="text-center" style="width: 5%">Año</th>
                                        <th class="text-center" style="width: 15%">Precio Compra</th>
                                        <th class="text-center" style="width: 10%">Condicion</th>
                                        <th class="text-center" style="width: 5%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalCompra = 0; @endphp
                                    @foreach ($compra->motos as $moto)
                                        <tr data-id="{{ $moto->id }}"
                                            data-imagen="{{ $moto->imagen_moto ? asset($moto->imagen_moto) : '' }}"
                                            data-cilindrada="{{ $moto->cilindrada_moto }}"
                                            data-nr-motor="{{ $moto->nr_motor }}" data-nr-chasis="{{ $moto->nr_chasis }}"
                                            data-certificado="{{ $moto->nr_certificado }}"
                                            data-dnrpa="{{ $moto->dnrpa }}" data-km_moto="{{ $moto->km_moto }}"
                                            data-id_nacionalidad="{{ $moto->id_nacionalidad }}"
                                            data-nacionalidad="{{ $moto->nacionalidad->pais ?? 'N/D' }}"
                                            data-precio_venta="{{ $moto->precio_venta }}"
                                            data-condicion="{{ $moto->condicion }}">
                                            <td style="text-align: center">{{ $contador++ }}</td>
                                            <td class="marca-moto" style="text-align: center">
                                                {{ $moto->marca->nombre_marca }}</td>
                                            <td class="modelo-moto" style="text-align: center">
                                                {{ $moto->modelo_moto }}</td>
                                            {{--  <td class="dominio-moto" style="text-align: center">
                                                        {{ $moto->dominio }}</td> --}}
                                            <td class="color-moto" style="text-align: center">
                                                {{ $moto->color_moto }}</td>
                                            <td class="anio-moto" style="text-align: center">
                                                {{ $moto->anio_moto }}</td>
                                            <td class="precio_compra-moto" style="text-align: center">
                                                ${{ number_format($moto->precio_compra, 2, ',', '.') }}</td>
                                            @php $totalCompra += $moto->precio_compra; @endphp
                                            {{--  <td>{{ $moto->cilindrada_moto }}cc</td> --}}
                                            <td class="text-center" style="vertical-align: middle">
                                                @php
                                                    $colores = [
                                                        'vendida' => 'danger',
                                                        'en_stock' => 'success',
                                                        'garantia' => 'warning',
                                                        'devuelta' => 'secondary',
                                                    ];
                                                    $color = $colores[$moto->condicion] ?? 'light';
                                                @endphp
                                                <span class="badge bg-{{ $color }}">
                                                    {{ ucfirst(str_replace('_', ' ', $moto->condicion)) }}
                                                </span>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <!-- Ver -->
                                                    <button style="text-align: center" type="button"
                                                        class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#VerMotoModal"
                                                        onclick="verMoto({{ $moto->id }})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Editar -->
                                                    <a href="{{ route('compras.motos.edit', ['compraId' => $compra->id, 'motoId' => $moto->id]) }}"
                                                        class="btn btn-warning btn-sm ">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!-- Eliminar -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        style="border-radius: 0px 4px 4px 0px"
                                                        onclick="eliminarMoto(this)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <h3 class="fw-bold">
                                        TOTAL:
                                        <span id="total_compra" class="ms-2">
                                            ${{ number_format($totalCompra, 2, ',', '.') }}
                                        </span>
                                        <input type="hidden" name="total_compra" value={{ $totalCompra }}>
                                    </h3>
                                </div>
                            </div>


                    </div>

                    <!-- Botones de acción -->
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning me-2">
                            <i class="fa-solid fa-file-arrow-up"></i> Actualizar compra
                        </button>
                        <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary mx-1"><i
                                class="fas fa-times"></i>
                            Cancelar
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal seleccionar proveedor -->
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
                    <table id="mitabla2"
                        class="table table-striped table-bordered table-hover table-sm">
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
                            @foreach ($proveedores as $proveedore)
                                <tr>
                                    <td style="text-align: center;vertical-align:middle;">{{ $contador++ }}
                                    </td>
                                    <td style="text-align: center;vertical-align:middle;">
                                        <button type="button" class="btn btn-info seleccionar-btn-proveedor"
                                            data-id="{{ $proveedore->id }}"
                                            data-nombre_proveedor="{{ $proveedore->nombre_proveedor }}">Seleccionar</button>
                                    </td>
                                    <td style="vertical-align:middle;">{{ $proveedore->nombre_proveedor }}
                                    </td>
                                    <td style="vertical-align:middle;">{{ $proveedore->cuit }}</td>
                                    <td style="vertical-align:middle;">{{ $proveedore->telefono }}</td>
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
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
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
                                    <div class="card card-info">
                                        <div
                                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                            <!-- Datos de Moto -->
                                            <div class="row">
                                                <input type="hidden" id="compra_id" value="{{ $compra->id }}">
                                                <input type="hidden" id="fecha_compra"
                                                    value="{{ $compra->fecha_compra }}">
                                                <!-- Primera Columna: Datos -->
                                                <div class="col-md-9">
                                                    <!-- Fila 1 -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Marca</label> <b style="color: red;">*</b>
                                                            <select class="form-control" name="id_marca" id="id_marca">
                                                                <option value="">Seleccione una marca
                                                                </option>
                                                                @foreach ($marcas as $marca)
                                                                    <option value="{{ $marca->id }}"
                                                                        {{ old('id_marca') }}>
                                                                        {{ $marca->nombre_marca }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Modelo</label> <b style="color: red;">*</b>
                                                            <input type="text"
                                                                value="{{ is_array(old('modelo_moto')) ? implode(', ', old('modelo_moto')) : old('modelo_moto') }}"
                                                                name="modelo_moto" id="modelo_moto" class="form-control"
                                                                placeholder="Modelo">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Dominio</label><b style="color: red;"></b>
                                                            <input type="text" name="dominio" id="dominio"
                                                                class="form-control" placeholder="Dominio">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Cilindrada</label><b style="color: red;">*</b>
                                                            <input type="number" min="0" name="cilindrada_moto"
                                                                id="cilindrada_moto" class="form-control"
                                                                placeholder="Cilindrada">
                                                        </div>
                                                    </div>

                                                    <!-- Fila 2 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-2">
                                                            <label>Color</label><b style="color: red;">*</b>
                                                            <input type="text" name="color_moto" id="color_moto"
                                                                class="form-control" placeholder="Color">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nacionalidad</label><b style="color: red;">*</b>
                                                            <select class="form-control" name="id_nacionalidad"
                                                                id="id_nacionalidad">
                                                                <option value="">Seleccione una Nacionalidad
                                                                </option>
                                                                @foreach ($nacionalidades as $nacionalidad)
                                                                    <option value="{{ $nacionalidad->id }}"
                                                                        data-nombre_nacionalidad="{{ $nacionalidad->pais }}">
                                                                        {{ $nacionalidad->pais }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Año</label><b style="color: red;">*</b>
                                                            <input type="number" min="0" name="anio_moto"
                                                                id="anio_moto" class="form-control" placeholder="Año">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Km</label><b style="color: red;">*</b>
                                                            <input type="number" min="0" name="km_moto"
                                                                id="km_moto" class="form-control"
                                                                placeholder="Kilometraje">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check mt-4">
                                                                <input class="form-check-input" name="es_usada"
                                                                    id="es_usada" type="checkbox">
                                                                <label class="form-check-label">¿Es usada?</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila 3 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>Nro. Motor</label><b style="color: red;">*</b>
                                                            <input type="text" name="nr_motor" id="nr_motor"
                                                                class="form-control" placeholder="Nro. Motor">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                            <input type="text" name="nr_chasis" id="nr_chasis"
                                                                class="form-control" placeholder="Nro. Chasis">
                                                        </div>
                                                    </div>

                                                    <!-- Fila 4 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>D.N.R.P.A</label><b style="color: red;"></b>
                                                            <input type="text" name="dnrpa" id="dnrpa"
                                                                class="form-control" placeholder="Nro. DNRPA">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Certificado</label><b style="color: red;"></b>
                                                            <input type="text" class="form-control"
                                                                name="nr_certificado" id="nr_certificado"
                                                                placeholder="Nro. Certificado">
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
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Precio venta</label>
                                                            <input type="text" class="form-control"
                                                            id="precioVentaFormatted" placeholder="Precio venta">
                                                            <!-- Input hidden (valor limpio para BD) -->
                                                            <input type="hidden" name="precio_venta" id="precio_venta">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Deposito</label><b style="color: red;">*</b>
                                                            <select class="form-control" id="id_deposito"
                                                                name="id_deposito">
                                                                <option value="">Seleccione un Deposito
                                                                </option>
                                                                @foreach ($depositos as $deposito)
                                                                    <option value="{{ $deposito->id }}">
                                                                        {{ $deposito->nombre_deposito }}</option>
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
                                                            <input type="file" id="imagen_moto" name="imagen_moto"
                                                                accept=".jpg, .jpeg, .png" class="form-control">
                                                            @error('imagen_moto')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                            <br>
                                                            <center>
                                                                <output id="list">
                                                                    <img id="preview-moto"
                                                                        src="{{ asset('storage/motos/default.png') }}"
                                                                        width="70%"
                                                                        alt="Vista previa"
                                                                        style="border:1px solid #ccc; border-radius:8px; object-fit:cover;">
                                                                </output>
                                                            </center>
                                                        </div>
                                                        <!-- Contenedor para previsualización -->
                                                        <div id="preview-container" class="mt-2"></div>
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
                </div> <!-- .modal-body -->
            </div> <!-- .modal-content -->
        </div> <!-- .modal-dialog -->
    </div>

    <!-- Modal Ver Moto -->
    <div class="modal fade" id="VerMotoModal" tabindex="-1" role="dialog" aria-labelledby="VerMotoModalLabel"
        aria-hidden="true">
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
    @if (
            $errors->has('km_moto') ||
                $errors->has('anio_moto') ||
                $errors->has('id_nacionalidad') ||
                $errors->has('color_moto') ||
                $errors->has('cilindrada_moto') ||
                $errors->has('modelo_moto') ||
                $errors->has('id_marca') ||
                $errors->has('dominio') ||
                $errors->has('nr_motor') ||
                $errors->has('nr_chasis'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    $('#crearMotoModal').modal('show');
                });
            </script>
    @endif
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
            $(this).find('#preview-moto').attr('src', '{{ asset("storage/motos/default.png") }}');
        });
    </script>
    <script>
        // ============================
        // Formatear precios con hidden
        // ============================
        document.getElementById('precioCompraFormatted').addEventListener('input', function(e) {
            // Eliminar todo lo que no sea dígito
            let value = e.target.value.replace(/\D/g, '');

            if (value) {
                // Mostrar con separadores de miles y dos decimales
                let formatted = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(value / 100); // dividir entre 100 para manejar decimales

                e.target.value = formatted;

                // Guardar valor limpio en hidden (con punto decimal)
                document.getElementById('precio_compra').value = (value / 100).toFixed(2);
            } else {
                e.target.value = '';
                document.getElementById('precio_compra').value = '';
            }
        });
        document.getElementById('precioVentaFormatted').addEventListener('input', function(e) {
            // Eliminar todo lo que no sea dígito
            let value = e.target.value.replace(/\D/g, '');

            if (value) {
                // Mostrar con separadores de miles y dos decimales
                let formatted = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(value / 100); // dividir entre 100 para manejar decimales

                e.target.value = formatted;

                // Guardar valor limpio en hidden (con punto decimal)
                document.getElementById('precio_venta').value = (value / 100).toFixed(2);
            } else {
                e.target.value = '';
                document.getElementById('precio_venta').value = '';
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Asignar el total que viene desde la BD
            let totalDesdeBD = @json($compra->total_compra);
            document.getElementById("precio_total_input").value = totalDesdeBD;
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

            // Imagen
            const imagenInput = document.getElementById('imagen_moto');
            if (imagenInput.files.length > 0) {
                formData.append('imagen_moto', imagenInput.files[0]);
            }

            // CSRF token
            formData.append('_token', '{{ csrf_token() }}');

            // Enviar AJAX
            $.ajax({
                url: '{{ route('admin.compras.motos.create') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhrFields: {
                    withCredentials: true
                },
                success: function(res) {
                    if (res.success) {
                        // Cerrar modal
                        $('#crearMotoModal').modal('hide');

                        // Recargar página directamente
                        location.reload();

                        // Limpiar errores y formulario
                        $('.text-error').remove();
                        $('#formAgregarMoto')[0].reset();
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
            const imagenUrl = fila.dataset.imagen?.trim();
            const cilindrada = fila.dataset.cilindrada || '';
            const nrMotor = fila.dataset.nrMotor || '';
            const nrChasis = fila.dataset.nrChasis || '';
            const certificado = fila.dataset.certificado || 'N/A';
            const dnrpa = fila.dataset.dnrpa || 'N/A';
            const km_moto = fila.dataset.km_moto || '';
            const nacionalidad = fila.dataset.nacionalidad || 'N/D';
            const condicion = fila.dataset.condicion || 'N/D';

            const defaultImagen = '/storage/motos/default.png';
            const urlImagen = (imagenUrl && imagenUrl !== '') ? imagenUrl : defaultImagen;
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
                        <img src="${urlImagen}" class="img-fluid img-thumbnail mt-2" style="max-width: 200px;">
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
                title: '¿Desea eliminar esta moto?',
                text: 'Si es la última, también se eliminará la compra.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: "{{ url('/admin/compras/motos') }}/" + motoId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Moto Eliminada',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                }).then(() => {
                                    if (response.compraEliminada) {
                                        // Si también se eliminó la compra, volver al index
                                        window.location.href =
                                            "{{ route('admin.compras.index') }}";
                                    } else {
                                        // Solo recargo si todavía existe la compra
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire('No permitido', response.message, 'warning');
                            }
                        },
                        error: function(xhr) {
                            let mensaje = 'Error en la petición de eliminación';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                mensaje = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                title: 'No permitido',
                                text: mensaje,
                                icon: 'error', // icono de alerta
                                confirmButtonText: 'Cerrar',
                                confirmButtonColor: '#FF4500', // color del botón
                                background: '#FFF0F5', // color de fondo del alert
                                color: '#800000', // color del texto
                            });

                            console.error(xhr);
                        }

                    });

                }
            });
        }
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
        $('#formAgregarProveedor').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('proveedores.crearProveedorCompra') }}', // tu ruta definida
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

@stop
