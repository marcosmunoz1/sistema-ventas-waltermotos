@extends('adminlte::page')

@section('content_header')
    <h2 class="brand-text font-weight-light">Compras/<b>Cargar Compra</b></h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Datos de compra</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.compras.store') }}" id="form_compra" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="proveedor">Proveedor</label>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModal_proveedor"><i class="fas fa-search"></i>
                                            Buscar</button>
                                        <div style="margin-right: 10px"></div>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modalAgregarProveedor">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="nombre_proveedor" disabled>
                                            <input type="text" class="form-control" id="id_proveedor" name="id_proveedor"
                                                hidden>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Factura</label>
<<<<<<< HEAD
                                        <input type="number" value="{{ old('numero_factura') }}" class="form-control"
                                            id="numero_factura" name="numero_factura" placeholder="Número de factura"
                                            required>
=======
                                        <input type="text" value="{{ old('numero_factura') }}" class="form-control"
                                            id="numero_factura" name="numero_factura" placeholder="Nr. de factura" required>
>>>>>>> origin/Marcos
                                        @error('numero_factura')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remito</label>
                                        <input type="text" value="{{ old('numero_remito') }}" class="form-control"
                                            id="numero_remito" name="numero_remito" placeholder="Nr. de remito" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha compra</label>
                                        <input type="date" value="{{ old('fecha_compra') }}" name="fecha_compra"
                                            id="fecha_compra" class="form-control datetimepicker-input"
                                            data-target="#reservationdate" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="estado_compra">Estado</label><b> *</b>
                                        <select class="form-control" name="estado_compra" required>
                                            <option value="">-- Seleccionar estado --</option>
                                            <option value="Pagado" {{ old('estado_compra') == 'Pagado' ? 'selected' : '' }}>
                                                Pagado</option>
                                            <option value="Pendiente"
                                                {{ old('estado_compra') == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                            </option>
                                        </select>
                                        @error('estado_compra')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
<<<<<<< HEAD
                        <div class="row">
                            <div class="col-md-4">
=======
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
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se insertan dinámicamente con JS -->
                                            </tbody>
                                        </table>
                                        <!-- Texto visible para el usuario -->
                                        <div class="text-right mt-2">
                                            <strong>Total de compra:</strong>
                                            <span id="total_compra_display">$ 0</span>
                                        </div>
                                    </div>
>>>>>>> origin/Marcos

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#crearMotoModal"><i class="fa-solid fa-cart-shopping"></i> Agregar
                                    moto</button>

                            </div>
                        </div>
                        <hr>
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se insertan dinámicamente con JS -->
                                    </tbody>
                                </table>
                                <!-- Texto visible para el usuario -->
                                <div class="text-right mt-2">
                                    <strong>Total de compra:</strong>
                                    <span id="total_compra_display">$ 0</span>
                                </div>
                            </div>

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
                        <div class="row">
                            <div class="card-body" style="justify-items: end">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Registrar
                                    </button>
                                    <a href="{{ url('admin/compras') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>
                            </div>
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
                    <div class="modal-header text-white d-flex justify-content-center" style="background-color: #252652">
                        <h4 class="modal-title text-center">
                            <i class="fa-solid fa-motorcycle"></i>
                            <span id="modalActionText">Agregar</span> detalle de la moto
                            <i class="fa-solid fa-motorcycle"></i>
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
                                                    <!-- Primera Columna: Datos -->
                                                    <div class="col-md-9">
                                                        <!-- Fila 1 -->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Marca</label> <b style="color: red;">*</b>
                                                                <select class="form-control" name="marca_moto"
                                                                    id="marca_moto">
                                                                    <option value="">Seleccione una
                                                                        marca
                                                                    </option>
                                                                    @foreach ($marcas as $marca)
                                                                        <option value="{{ $marca->nombre_marca }}"
                                                                            data-nombre_marca="{{ $marca->nombre_marca }}">
                                                                            {{ $marca->nombre_marca }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('marca_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Modelo</label> <b style="color: red;">*</b>
                                                                <input type="text"
                                                                    value="{{ is_array(old('modelo_moto')) ? implode(', ', old('modelo_moto')) : old('modelo_moto') }}"
                                                                    name="modelo_moto" id="modelo_moto"
                                                                    class="form-control" placeholder="Modelo">
                                                                @error('modelo_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Dominio</label><b style="color: red;"></b>
                                                                <input type="text" name="dominio" id="dominio"
                                                                    class="form-control" placeholder="Dominio">
                                                                @error('estado_compra')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                                <input type="number" min="0"
                                                                    name="cilindrada_moto" id="cilindrada_moto"
                                                                    class="form-control" placeholder="Cilindrada">
                                                                @error('cilindrada_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Fila 2 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-2">
                                                                <label>Color</label><b style="color: red;">*</b>
                                                                <input type="text" name="color_moto" id="color_moto"
                                                                    class="form-control" placeholder="Color">
                                                                @error('color_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nacionalidad</label><b style="color: red;">*</b>
                                                                <select class="form-control" name="id_nacionalidad"
                                                                    id="id_nacionalidad">
                                                                    <option value="">Seleccione una
                                                                        Nacionalidad
                                                                    </option>
                                                                    @foreach ($nacionalidades as $nacionalidad)
                                                                        <option value="{{ $nacionalidad->id }}"
                                                                            data-nombre_nacionalidad="{{ $nacionalidad->pais }}">
                                                                            {{ $nacionalidad->pais }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_nacionalidad')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Año</label><b style="color: red;">*</b>
                                                                <input type="number" min="0" name="anio_moto"
                                                                    id="anio_moto" class="form-control"
                                                                    placeholder="Año">
                                                                @error('anio_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label><b style="color: red;">*</b>
                                                                <input type="number" min="0" name="km_moto"
                                                                    id="km_moto" class="form-control"
                                                                    placeholder="Kilometraje">
                                                                @error('km_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
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
                                                                @error('nr_motor')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                                <input type="text" name="nr_chasis" id="nr_chasis"
                                                                    class="form-control" placeholder="Nro. Chasis">
                                                                @error('nr_chasis')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

<<<<<<< HEAD
                                                        <!-- Fila 4 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label>D.N.R.P.A</label><b style="color: red;"></b>
                                                                <input type="text" name="dnrpa" id="dnrpa"
                                                                    class="form-control" placeholder="Nro. DNRPA">
                                                                @error('dnrpa')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label><b style="color: red;"></b>
                                                                <input type="text" class="form-control"
                                                                    name="nr_certificado" id="nr_certificado"
                                                                    placeholder="Nro. Certificado">
                                                                @error('nr_certificado')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
=======
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
                      <!-- Modal seleccionar proveedor-->
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
>>>>>>> origin/Marcos

                                                        <!-- Fila 5 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <label>Precio compra</label><b style="color: red;">*</b>
                                                                <input type="text" class="form-control"
                                                                    name="precio_compra" id="precio_compra"
                                                                    placeholder="Precio compra">
                                                                @error('precio_compra')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Precio venta</label>
                                                                <input type="text" class="form-control"
                                                                    name="precio_venta" id="precio_venta"
                                                                    placeholder="Precio venta">
                                                                @error('precio_venta')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deposito</label><b style="color: red;">*</b>
                                                                <select class="form-control" id="id_deposito"
                                                                    name="id_deposito">
                                                                    <option value="">Seleccione un
                                                                        Deposito
                                                                    </option>
                                                                    @foreach ($depositos as $deposito)
                                                                        <option value="{{ $deposito->id }}">
                                                                            {{ $deposito->nombre_deposito }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_deposito')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Segunda Columna: Imagen -->
                                                    <div class="col-md-3">
                                                        <div class="text-center">
                                                            <div class="form-group">
                                                                <label for="imagen">Imagen</label>
                                                                <input type="file" id="imagen_moto"
                                                                    name="imagen_moto[]" accept=".jpg, .jpeg, .png"
                                                                    class="form-control" multiple>
                                                                @error('imagen_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                                <br>
                                                                <center><output id="list"></output>
                                                                </center>
                                                            </div>
                                                            <!-- Contenedor para previsualización -->
                                                            <div id="preview-container" class="mt-2">
                                                            </div>
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
        </div>

        <!-- Modal -->
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
                            class="table table-striped table-bordered table-hover table-sm table-responsive">
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
                                        <td style="text-align: center;vertical-align:middle;">
                                            {{ $contador++ }}
                                        </td>
                                        <td style="text-align: center;vertical-align:middle;">
                                            <button type="button" class="btn btn-info seleccionar-btn-proveedor"
                                                data-id="{{ $proveedore->id }}"
                                                data-nombre_proveedor="{{ $proveedore->nombre_proveedor }}">Seleccionar</button>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            {{ $proveedore->nombre_proveedor }}
                                        </td>
                                        <td style="vertical-align:middle;">{{ $proveedore->cuit }}</td>
                                        <td style="vertical-align:middle;">{{ $proveedore->telefono }}
                                        </td>
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
<<<<<<< HEAD

    <div class="modal fade" id="modalAgregarProveedor" tabindex="-1" role="dialog"
        aria-labelledby="modalProveedorLabel" aria-hidden="true">
=======
    <!--Modal agregar proveedor -->
    <div class="modal fade" id="modalAgregarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalProveedorLabel" aria-hidden="true">
>>>>>>> origin/Marcos
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
                                <img id="verImagen" src="" alt="Imagen de la moto" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

@section('css')
@stop

@section('js')
    @if ($errors->any())
        <script>
            // Muestra el modal si hay errores
            document.addEventListener("DOMContentLoaded", function() {
                $('#crearMotoModal').modal('show');
            });
        </script>
    @endif
    <script>
        $('#crearMotoModal').on('hidden.bs.modal', function () {
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
            $(this).find('#preview-imagen').attr('src', '').hide();
        });
<<<<<<< HEAD
    
        $('.seleccionar-btn-proveedor').click(function() {
=======




    </script>



    <script>

        $('.seleccionar-btn-proveedor').click(function(){
>>>>>>> origin/Marcos
            var id_proveedor = $(this).data('id');
            var nombre_proveedor = $(this).data('nombre_proveedor');
            $('#id_proveedor').val(id_proveedor);
            $('#nombre_proveedor').val(nombre_proveedor);
            $('#exampleModal_proveedor').modal('hide');
        });
    </script>

    <script>
        window.agregarMotoATabla = function() {
            event.preventDefault();
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
                url: '{{ route('tmp-compras.store') }}',
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
        function cargarMotosATabla() {
            $.ajax({
                url: '{{ route('tmp-compras.listar') }}',
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
                                <td>${moto.dominio ?? ''}</td>
                                <td>${moto.color_moto}</td>
                                <td>${moto.anio_moto}</td>
                                <td>$${moto.precio_compra ? parseFloat(moto.precio_compra).toLocaleString('es-AR') : '0'}</td>
                                <td>${moto.cilindrada_moto}cc</td>
                                <td style="text-align: center">
                                    <button class="btn btn-info btn-sm verMotoBtn"
                                        data-moto='${JSON.stringify(moto)}'>
                                        <i class="fas fa-eye"></i>
                                    </button>
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
                        url: "{{ url('/admin/tmp-compras') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
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
            $('.verMotoBtn').click(function(){
                let moto = $(this).data('moto'); // Viene del JSON.stringify()

                $('#verMarca').text(moto.marca_moto ?? 'No registrado');
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
                $('#verPrecioCompra').text(moto.precio_compra ? `$ ${parseFloat(moto.precio_compra).toLocaleString('es-AR')}` : 'No registrado');
                $('#verPrecioVenta').text(moto.precio_venta ? `$ ${parseFloat(moto.precio_venta).toLocaleString('es-AR')}` : 'No registrado');
                $('#verDeposito').text(moto.deposito ? moto.deposito.nombre_deposito : 'No registrado');
                console.log("Imagen de la moto:", moto.imagen_moto);

                // Imagen
                if (moto.imagen_moto) {
                    $('#verImagen')
                        .attr('src', '/' + moto.imagen_moto) // agregamos la barra inicial
                        .show();
                } else {
                    $('#verImagen').attr('src', '/img/placeholder.png').show();
                }

                $('#modalVerMoto').modal('show');
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
<<<<<<< HEAD
=======
        $('#formAgregarProveedor').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route("proveedores.crearProveedorCompra") }}', // tu ruta definida
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
                            $(`[name="${campo}"]`).after(`<small class="text-error" style="color:red">${mensaje}</small>`);
                        }
                    } else {
                        console.error(xhr.responseText);
                    }
                }
            });
            $('#modalAgregarProveedor').on('hidden.bs.modal', function () {
                $(this).find('input').val('');       // Limpia todos los inputs del modal
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


>>>>>>> origin/Marcos
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
