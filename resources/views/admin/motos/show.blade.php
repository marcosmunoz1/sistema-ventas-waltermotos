@extends('layouts.app')

@section('title', 'Ver Moto')

@section('content_header')


@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Motos/<b>Ver Moto</b> </h2>
                    </div>
                </div>

                <div class="col-md-12 mx-auto">
                    <div class="col-md-12 mx-auto mt-2">
                        <div class="card card-info">
                            <div
                                class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                <h5 class="text-center text-info"><i class="fas fa-motorcycle"></i> Datos de la Moto</h5>
                                <!-- Datos de Moto -->
                                <div class="row">
                                    <!-- Primera Columna: Datos -->
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Marca</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $moto->marca->nombre_marca }}" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Modelo</label>
                                                <input type="text" class="form-control" value="{{ $moto->modelo_moto }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Dominio</label>
                                                <input type="text" class="form-control" value="{{ $moto->dominio }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Cilindrada</label>
                                                <input type="number" class="form-control"
                                                    value="{{ $moto->cilindrada_moto }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3">
                                                <label>Color</label>
                                                <input type="text" class="form-control" value="{{ $moto->color_moto }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Nacionalidad</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $moto->nacionalidad->pais }}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Año</label>
                                                <input type="number" class="form-control" value="{{ $moto->anio_moto }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Km</label>
                                                <input type="number" class="form-control" value="{{ $moto->km_moto }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Moto</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $moto->es_usada == 1 ? 'Usada' : 'Nueva' }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Nro. Motor</label>
                                                <input type="text" class="form-control" value="{{ $moto->nr_motor }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nro. Chasis</label>
                                                <input type="text" class="form-control" value="{{ $moto->nr_chasis }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>D.N.R.P.A</label>
                                                <input type="text" class="form-control" value="{{ $moto->dnrpa }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Certificado</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $moto->nr_certificado }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <center>
                                                    <output id="list">
                                                        <img src="{{ asset($moto->imagen_moto) }}" width="100%"
                                                            alt="">
                                                    </output>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="text-center text-info mt-2"><i class="fas fa fa-truck"></i> Datos del Compra
                                    </h5>
                                    <div
                                        class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Proveedor</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ $proveedor->nombre_proveedor }}" disabled>
                                                    <button class="btn btn-outline-info" type="button" id="btnVerProveedor"
                                                        data-nombre="{{ $proveedor->nombre_proveedor }}"
                                                        data-email="{{ $proveedor->email }}"
                                                        data-telefono="{{ $proveedor->telefono }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Fecha de Ingreso</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $moto->fecha_compra_moto }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Precio de Compra</label>
                                                    <input type="text" class="form-control text-success"
                                                        value="{{ '$' . number_format($moto->precio_compra, 0, ',', '.') }}"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Número de Remito</label>
                                                    <input type="number" class="form-control"
                                                        value="{{ $moto->compra->numero_remito }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nro. de Factura</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            value="{{ $moto->compra->numero_factura }}" disabled>
                                                        <button class="btn btn-outline-info" type="button"
                                                            id="btnVerCompra"
                                                            data-fecha="{{ $moto->compra->fecha_compra }}"
                                                            data-factura="{{ $moto->compra->numero_factura }}"
                                                            data-remito="{{ $moto->compra->numero_remito }}"
                                                            data-total="{{ '$' . number_format($moto->compra->total_compra, 0, ',', '.') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($venta)
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="text-center text-info mt-2"><i class="fas fa fa-cash-register"></i>
                                            Datos
                                            de Venta</h5>
                                        <div
                                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="nroFactura" class="form-label">Cliente</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                value="{{ $venta->cliente->apellido_cliente }}, {{ $venta->cliente->nombre_cliente }}"
                                                                disabled>
                                                            <button class="btn btn-outline-info" type="button"
                                                                id="btnVerCliente"
                                                                data-nombre-cliente="{{ $venta->cliente->apellido_cliente }}, {{ $venta->cliente->nombre_cliente }}"
                                                                data-cuit-cliente="{{ $venta->cliente->cuit_cliente }}"
                                                                data-dni-cliente="{{ $venta->cliente->dni_cliente }}"
                                                                data-nacido-cliente="{{ \Carbon\Carbon::parse($venta->cliente->fecha_nacimiento_cliente)->format('d-m-Y') }}"
                                                                data-email-cliente="{{ $venta->cliente->email_cliente }}"
                                                                data-celular-cliente="{{ $venta->cliente->celular_cliente }}"
                                                                data-estadoCivil-cliente="{{ $venta->cliente->estado_civil_cliente }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="fechaIngreso" class="form-label">Fecha de
                                                            Egreso</label>
                                                        <input type="date" class="form-control"
                                                            value="{{ $venta->fecha_venta }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="precioVenta" class="form-label">Precio de
                                                            Venta</label>
                                                        <input type="text" class="form-control text-danger"
                                                            value="{{ '$' . number_format($moto->precio_venta, 0, ',', '.') }}"
                                                            disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="precioCompra" class="form-label">Número de
                                                            Remito</label>
                                                        <input type="number" class="form-control" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nroFactura" class="form-label">Nro. de Factura</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                value="{{ $venta->id_venta }}" disabled>
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="btnVerFactura">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="text-center text-info mt-2"><i class="fas fa fa-cash-register"></i>
                                            Datos
                                            de Venta</h5>
                                        <div
                                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-info" role="alert">
                                                        <i class="fas fa-info-circle"></i>
                                                        Datos de venta no disponibles. La motocicleta aún no fue vendida.
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                            @endif
                        </div>


                    </div>

                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('admin/motos') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="modalProveedorLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="modalProveedorLabel">Información del Proveedor</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre:</strong> <span id="nombreProveedor"></span></p>
                        <p><strong>Email:</strong> <span id="emailProveedor"></span></p>
                        <p><strong>Teléfono:</strong> <span id="telefonoProveedor"></span></p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal de Compra -->
        <div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="modalCompraLabel">Información de la Compra</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Fecha:</strong> <span id="fechaCompra"></span></p>
                        <p><strong>Factura:</strong> <span id="facturaCompra"></span></p>
                        <p><strong>Remito:</strong> <span id="remitoCompra"></span></p>
                        <p><strong>Total:</strong> <span id="totalCompra"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalProveedorLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="modalProveedorLabel">Información del Cliente</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre:</strong> <span id="nombreCliente"></span></p>
                        <p><strong>DNI:</strong> <span id="dniCliente"></span></p>
                        <p><strong>CUIT:</strong> <span id="cuitCliente"></span></p>
                        <p><strong>Nacido:</strong> <span id="nacidoCliente"></span></p>
                        <p><strong>Teléfono:</strong> <span id="celularCliente"></span></p>
                        <p><strong>e-Mail:</strong> <span id="emailCliente"></span></p>
                        <p><strong>Estado Civil:</strong> <span id="estadoCivilCliente"></span></p>
                    </div>

                </div>
            </div>
        </div>

    @endsection

    @section('css')
        {{-- Estilos personalizados --}}
    @endsection

    @section('js')
        {{-- Scripts adicionales --}}
        <script>
            document.getElementById('btnVerProveedor').addEventListener('click', function() {
                const nombre = this.getAttribute('data-nombre');
                const email = this.getAttribute('data-email');
                const telefono = this.getAttribute('data-telefono');

                document.getElementById('nombreProveedor').textContent = nombre;
                document.getElementById('emailProveedor').textContent = email;
                document.getElementById('telefonoProveedor').textContent = telefono;

                var myModal = new bootstrap.Modal(document.getElementById('modalProveedor'));
                myModal.show();
            });

            document.getElementById('btnVerCliente').addEventListener('click', function() {
                const nombre = this.getAttribute('data-nombre-cliente');
                const dni = this.getAttribute('data-dni-cliente');
                const cuit = this.getAttribute('data-cuit-cliente');
                const nacido = this.getAttribute('data-nacido-cliente');
                const email = this.getAttribute('data-email-cliente');
                const estadoCivil = this.getAttribute('data-estadoCivil-cliente');
                const celular = this.getAttribute('data-celular-cliente');

                document.getElementById('nombreCliente').textContent = nombre;
                document.getElementById('dniCliente').textContent = dni;
                document.getElementById('cuitCliente').textContent = cuit;
                document.getElementById('nacidoCliente').textContent = nacido;
                document.getElementById('emailCliente').textContent = email;
                document.getElementById('estadoCivilCliente').textContent = estadoCivil;
                document.getElementById('celularCliente').textContent = celular;

                var myModal = new bootstrap.Modal(document.getElementById('modalCliente'));
                myModal.show();
            });

            document.getElementById('btnVerCompra').addEventListener('click', function() {
                const fecha = this.getAttribute('data-fecha');
                const factura = this.getAttribute('data-factura');
                const remito = this.getAttribute('data-remito');
                const total = this.getAttribute('data-total');

                // Asignar los valores al modal
                document.getElementById('fechaCompra').textContent = fecha;
                document.getElementById('facturaCompra').textContent = factura;
                document.getElementById('remitoCompra').textContent = remito;
                document.getElementById('totalCompra').textContent = total;

                // Mostrar el modal
                var myModal = new bootstrap.Modal(document.getElementById('modalCompra'));
                myModal.show();
            });
        </script>
    @endsection
