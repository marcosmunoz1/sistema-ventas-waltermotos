@extends('adminlte::page')

@section('content_header')
    <h1><b>Clientes/Datos del cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <p>{{ $cliente->nombre_cliente }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Apellido</label>
                                    <p>{{ $cliente->apellido_cliente }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">CUIT</label>
                                    <p>{{ $cliente->cuit_cliente }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">DNI</label>
                                    <p>{{ $cliente->dni_cliente }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Fecha de nacimiento</label>
                                    <p>{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento_cliente)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Celular</label>
                                    <p>{{ $cliente->celular_cliente }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Estado civil</label>
                                    <p>{{ $cliente->estado_civil_cliente }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <p>{{ $cliente->email_cliente }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Calle</label>
                                    <p>{{ $cliente->calle }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Ciudad</label>
                                    <p>{{ $cliente->ciudad }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Provincia</label>
                                    <p>{{ $cliente->provincia }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Profesión</label>
                                    <p>{{ $cliente->profesion }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($cliente->conyugue)
                            <h4>Datos del Cónyuge</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <p>{{ $cliente->conyugue->nombre_conyugue }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Apellido</label>
                                        <p>{{ $cliente->conyugue->apellido_conyugue }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">DNI</label>
                                        <p>{{ $cliente->conyugue->dni_conyugue }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Fecha de nacimiento</label>
                                        <p>{{ \Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Celular</label>
                                        <p>{{ $cliente->conyugue->celular_conyugue }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p><em>Este cliente no tiene cónyuge registrado.</em></p>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/clientes') }}" class="btn btn-secondary">Volver</a>
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

@stop
