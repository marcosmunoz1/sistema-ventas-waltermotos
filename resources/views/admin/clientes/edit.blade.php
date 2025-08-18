@extends('adminlte::page')

@section('content_header')
    <h1><b>Clientes/Modificación de los datos del cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" value="{{ $cliente->nombre_cliente }}" name="nombre_cliente" required>
                                    @error('nombre_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Apellido</label>
                                    <input type="text" class="form-control" value="{{ $cliente->apellido_cliente }}" name="apellido_cliente" required>
                                    @error('apellido_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">CUIT</label>
                                    <input type="text" class="form-control" value="{{ $cliente->cuit_cliente }}" name="cuit_cliente" required>
                                    @error('cuit_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">DNI</label>
                                    <input type="text" class="form-control" value="{{ $cliente->dni_cliente }}" name="dni_cliente" required>
                                    @error('dni_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento_cliente" class="form-control"
                                        value="{{ old('fecha_nacimiento_cliente', \Carbon\Carbon::parse($cliente->fecha_nacimiento_cliente)->format('Y-m-d')) }}" required>
                                    @error('fecha_nacimiento_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Celular</label>
                                    <input type="text" class="form-control" value="{{ $cliente->celular_cliente }}" name="celular_cliente" required>
                                    @error('celular_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" value="{{ $cliente->email_cliente }}" name="email_cliente" required>
                                    @error('email_cliente')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado_civil_cliente">Estado civil</label>
                                    <select name="estado_civil_cliente" id="estado_civil_cliente" class="form-control" required>
                                        @foreach ($valores as $valor)
                                            <option value="{{ $valor->value }}" {{ $cliente->estado_civil_cliente === $valor->value ? 'selected' : '' }}>
                                                {{ ucfirst($valor->value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Calle</label>
                                    <input type="text" class="form-control" value="{{ $cliente->calle }}" name="calle" required>
                                    @error('calle')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Ciudad</label>
                                    <input type="text" class="form-control" value="{{ $cliente->ciudad }}" name="ciudad" required>
                                    @error('ciudad')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Provincia</label>
                                    <input type="text" class="form-control" value="{{ $cliente->provincia }}" name="provincia" required>
                                    @error('provincia')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Profesión</label>
                                    <input type="text" class="form-control" value="{{ $cliente->profesion }}" name="profesion" required>
                                    @error('profesion')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Bloque del cónyuge -->
                        <div id="form_conyugue" style="display: none;">
                            <h4>Datos del Cónyuge</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" value="{{ $cliente->conyugue->nombre_conyugue ?? '' }}" name="nombre_conyugue">
                                        @error('nombre_conyugue')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Apellido</label>
                                        <input type="text" class="form-control" value="{{ $cliente->conyugue->apellido_conyugue ?? '' }}" name="apellido_conyugue">
                                        @error('apellido_conyugue')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">DNI</label>
                                        <input type="text" class="form-control" value="{{ $cliente->conyugue->dni_conyugue ?? '' }}" name="dni_conyugue">
                                        @error('dni_conyugue')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Fecha de nacimiento</label>
                                        <input type="date" name="fecha_nacimiento_conyugue" class="form-control"
                                            value="{{ isset($cliente->conyugue->fecha_nacimiento_conyugue) ? \Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('Y-m-d') : '' }}">
                                        @error('fecha_nacimiento_conyugue')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Celular</label>
                                        <input type="text" class="form-control" value="{{ $cliente->conyugue->celular_conyugue ?? '' }}" name="celular_conyugue">
                                        @error('celular_conyugue')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ url('admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estadoCivilSelect = document.getElementById('estado_civil_cliente');
            const formConyugue = document.getElementById('form_conyugue');

            function toggleFormConyugue() {
                if (estadoCivilSelect.value === 'Casado' || estadoCivilSelect.value === 'En Concubinato') {
                    formConyugue.style.display = 'block';
                } else {
                    formConyugue.style.display = 'none';
                }
            }

            estadoCivilSelect.addEventListener('change', toggleFormConyugue);
            toggleFormConyugue(); // Ejecutar al cargar
        });
    </script>
@stop
