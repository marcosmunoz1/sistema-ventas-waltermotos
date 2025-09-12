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
                    <h5 class="text-center text-success"><i class="fas fa-id-card"></i> Datos Personales </h5>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_cliente">Nombre</label>
                                <input type="text" name="nombre_cliente" class="form-control" disabled
                                    value="{{$cliente->nombre_cliente }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_cliente">Apellido</label>
                                <input type="text" name="apellido_cliente" class="form-control" disabled
                                    value="{{$cliente->apellido_cliente }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_nacimiento_cliente">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento_cliente" class="form-control" disabled
                                     value="{{$cliente->fecha_nacimiento_cliente}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cuit_cliente">CUIT</label>
                                <input type="text" name="cuit_cliente" class="form-control" disabled
                                    value="{{$cliente->cuit_cliente}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dni_cliente">DNI</label>
                                <input type="text" name="dni_cliente" class="form-control" disabled
                                    value="{{$cliente->dni_cliente}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="profesion">Profesión</label>
                                <input type="text" name="profesion" class="form-control" disabled
                                    value="{{$cliente->profesion}}">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <label>Estado civil</label>
                            <select id="estado_civil_cliente" class="form-control" disabled name="estado_civil_cliente">
                                @foreach ($valores as $valor)
                                    <option value="{{ $valor->value }}"
                                        {{ $cliente->estado_civil_cliente == $valor->value ? 'selected' : '' }}>
                                        {{ ucfirst($valor->value) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-body">
                                <h5 class="text-center text-success mt-2"><i class="fas fa-phone-alt"></i> Datos
                                    De
                                    Contacto
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="celular_cliente">Celular</label>
                                            <input type="text" name="celular_cliente" class="form-control"
                                                disabled value="{{$cliente->celular_cliente}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" name="email_cliente" class="form-control" disabled
                                            value="{{$cliente->email_cliente}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-body">
                                <h5 class="text-center text-success mt-2"><i class="fas fa-map-marker-alt"></i>
                                    Datos De Direccion
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" name="calle" class="form-control"
                                                disabled value="{{$cliente->calle}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" name="ciudad" class="form-control"
                                                disabled value="{{$cliente->ciudad}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" name="provincia" class="form-control"
                                                disabled value="{{$cliente->provincia}}">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                        <hr>
                        @if($cliente->conyugue)
                            <div class="row">
                                <div class="card card-body border-success shadow-sm">
                                    <h5 class="text-center text-success mb-3">
                                        <i class="fas fa-user-friends"></i> Datos del Cónyuge
                                    </h5>

                                    <div id="camposConyugue">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre_conyugue">Nombre</label>
                                                <input type="text" class="form-control" id="nombre_conyugue" name="nombre_conyugue" disabled
                                                    value="{{$cliente->conyugue->nombre_conyugue}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="apellido_conyugue">Apellido</label>
                                                <input type="text" class="form-control" id="apellido_conyugue" name="apellido_conyugue" disabled
                                                    value="{{$cliente->conyugue->apellido_conyugue}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dni_conyugue">DNI</label>
                                                <input type="text" class="form-control" id="dni_conyugue" name="dni_conyugue" disabled
                                                    value="{{$cliente->conyugue->dni_conyugue}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="fecha_nacimiento_conyugue">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento_conyugue" disabled
                                                    value="{{$cliente->conyugue->fecha_nacimiento_conyugue}}" name="fecha_nacimiento_conyugue">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="celular_conyugue">Celular</label>
                                            <input type="text" class="form-control" id="celular_conyugue" name="celular_conyugue" disabled
                                                value="{{$cliente->conyugue->celular_conyugue}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p><em>Este cliente no tiene cónyuge registrado.</em></p>
                        @endif
                        <div class="row">
                            <div class="col-md-1 ml-auto">
                                <a href="{{ url('admin/clientes') }}" class="btn btn-secondary">Volver</a>
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
