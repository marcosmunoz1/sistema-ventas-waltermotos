@extends('adminlte::page')

@section('title', 'Ver Moto')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Motos/<b>Ver-Moto</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
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
                                        <!-- Fila 1 -->
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
                                        <!-- Fila 2 -->
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label>Color</label>
                                                <input type="text" class="form-control" value="{{ $moto->color_moto }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-4">
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
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="esUsada">
                                                    <label class="form-check-label">¿Es usada?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fila 3 -->
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
                                        <!-- Fila 4 -->
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

                                    <!-- Segunda Columna: Imagen -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                               
                                                <center><output id="list"></output></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <!-- Datos de Compra -->
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="text-center text-info mt-2"><i class="fas fa fa-truck"></i> Datos del Compra
                                    </h5>
                                    <div
                                        class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                        <div class="row">
                                            <!-- Primera Columna -->
                                            <div class="col-md-12 mb-3">
                                                <label for="nroFactura" class="form-label">Proveedor</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ $proveedor->nombre_proveedor }}" disabled>
                                                    <button class="btn btn-outline-info" type="button"
                                                        id="btnVerFactura">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Segunda Columna -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Fecha de Ingreso</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $moto->compra->fecha_compra }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Precio de Compra</label>
                                                    <input type="number" class="form-control"
                                                        value="{{ $moto->precio_compra }}" disabled>
                                                </div>
                                            </div>
                                            <!-- tercera Columna -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Número de Remito</label>
                                                    <input type="number" class="form-control"
                                                        value="{{ $moto->compra->numero_remito }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label>Nro. de Factura</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                value="{{ $moto->compra->numero_factura }}" disabled>
                                                            <button class="btn btn-outline-info" type="button"
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
                            </div>

                            <!-- Datos de Venta -->
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="text-center text-info mt-2"><i class="fas fa fa-cash-register"></i>
                                        Datos de Venta</h5>
                                    <div
                                        class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }} ">
                                        <div class="row">
                                            <!-- Primera Columna -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="nroFactura" class="form-label">Cliente</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"  disabled>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="btnVerFactura">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Segunda Columna -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="fechaIngreso" class="form-label">Fecha de Egreso
                                                        *</label>
                                                    <input type="date" class="form-control"  value="{{ $moto->compra->numero_remito }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="precioCompra" class="form-label">Precio de Venta
                                                        *</label>
                                                    <input type="number" class="form-control"  value="{{ $moto->compra->numero_remito }}" disabled>
                                                </div>
                                            </div>
                                            <!-- tercera Columna -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="precioCompra" class="form-label">Número de Remito
                                                        *</label>
                                                    <input type="number" class="form-control" value="{{ $moto->compra->numero_remito }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nroFactura" class="form-label">Nro. de
                                                        Factura</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"  value="{{ $moto->compra->numero_remito }}" disabled>
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
                        </div>


                    </div>


                    <!-- Botones de acción -->
                    <div class="card-footer text-right">
                        <a href="{{ url('admin/productos') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>


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
@endsection
