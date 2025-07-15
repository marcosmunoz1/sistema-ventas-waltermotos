@extends('adminlte::page')

@section('title', 'Agregar Cliente')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Clientes/<b>Crear-Cliente</b></h2>
    <hr>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Datos</h3>
            </div>

            <div class="col-md-12 mx-auto mt-4">
                <div class="card card-info">
                    <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                        <form action="{{ url('/admin/clientes/create') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_cliente">Nombre</label>
                                        <input type="text" name="nombre_cliente" class="form-control" required value="{{ old('nombre_cliente') }}" placeholder="Ingrese nombre del cliente">
                                        @error('nombre_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellido_cliente">Apellido</label>
                                        <input type="text" name="apellido_cliente" class="form-control" required value="{{ old('apellido_cliente') }}" placeholder="Ingrese apellido del cliente">
                                        @error('apellido_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cuit_cliente">CUIT</label>
                                        <input type="text" name="cuit_cliente" class="form-control" required value="{{ old('cuit_cliente') }}" placeholder="Ingrese CUIT del cliente">
                                        @error('cuit_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dni_cliente">DNI</label>
                                        <input type="text" name="dni_cliente" class="form-control" required value="{{ old('dni_cliente') }}" placeholder="Ingrese DNI del cliente">
                                        @error('dni_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento_cliente">Fecha de nacimiento</label>
                                        <input type="date" name="fecha_nacimiento_cliente" class="form-control" required value="{{ old('fecha_nacimiento_cliente') }}">
                                        @error('fecha_nacimiento_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="celular_cliente">Celular</label>
                                        <input type="text" name="celular_cliente" class="form-control" required value="{{ old('celular_cliente') }}" placeholder="Ingrese celular del cliente">
                                        @error('celular_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" name="email_cliente" class="form-control" required value="{{ old('email_cliente') }}" placeholder="Ingrese un correo electrónico">
                                        @error('email_cliente')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label>Estado civil</label>
                                    <select id="estado_civil_cliente" class="form-control" required name="estado_civil_cliente">
                                        @foreach ($valores as $valor)
                                            <option value="{{ $valor->value }}"
                                                {{old('estado_civil_cliente') == $valor->value ? 'selected' : '' }}>
                                                {{ ucfirst($valor->value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="calle">Calle</label>
                                        <input type="text" name="calle" class="form-control" required value="{{ old('calle') }}" placeholder="Ingrese la calle y numero del cliente">
                                        @error('calle')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" name="ciudad" class="form-control" required value="{{ old('ciudad') }}" placeholder="Ingrese la ciudad del cliente">
                                        @error('ciudad')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" name="provincia" class="form-control" required value="{{ old('provincia') }}" placeholder="Ingrese la provincia del cliente">
                                        @error('provincia')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="profesion">Profesión</label>
                                        <input type="text" name="profesion" class="form-control" required value="{{ old('profesion') }}" placeholder="Ingrese la profesion del cliente">
                                        @error('profesion')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botón para abrir el modal -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 ml-2" id="btnConyugue" style="display: none;" data-toggle="modal" data-target="#modalConyugue">
                                        Agregar cónyuge
                                    </button>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalConyugue" tabindex="-1" role="dialog" aria-labelledby="modalConyugueLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title" id="modalConyugueLabel">Datos del cónyuge</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div id="errorConyugue" class="alert alert-danger d-none">
                                                    Debe completar todos los datos del cónyuge para poder registrar al cliente.
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="nombre_conyugue">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre_conyugue" name="nombre_conyugue" value="{{ old('nombre_conyugue') }}" placeholder="Ingresar nombre del conyugue">
                                                    @error('nombre_conyugue')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="apellido_conyugue">Apellido</label>
                                                    <input type="text" class="form-control" id="apellido_conyugue" name="apellido_conyugue" value="{{ old('apellido_conyugue') }}" placeholder="Ingresar apellido del conyugue">
                                                    @error('apellido_conyugue')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="dni_conyugue">DNI</label>
                                                    <input type="text" class="form-control" id="dni_conyugue" name="dni_conyugue" value="{{ old('dni_conyugue') }}" placeholder="Ingresar DNI del conyugue">
                                                    @error('dni_conyugue')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="fecha_nacimiento_conyugue">Fecha de nacimiento</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento_conyugue" value="{{ old('fecha_nacimiento_conyugue') }}" name="fecha_nacimiento_conyugue">
                                                    @error('fecha_nacimiento_conyugue')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="celular_conyugue">Celular</label>
                                                <input type="text" class="form-control" id="celular_conyugue" name="celular_conyugue" value="{{ old('celular_conyugue') }}" placeholder="Ingresar celular del conyugue">
                                                @error('celular_conyugue')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Registrar
                                </button>
                                <a href="{{ url('admin/clientes') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>

                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.card-outline -->
    </div> <!-- /.col -->
</div> <!-- /.row -->
@if (session('error_conyugue'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#modalConyugue').modal('show');
    });
</script>

<div class="alert alert-danger mt-2">
    {{ session('error_conyugue') }}
</div>
@endif
@endsection

@section('css')
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectEstado = document.getElementById('estado_civil_cliente');
            const btnConyugue = document.getElementById('btnConyugue');

            selectEstado.addEventListener('change', function () {
                if (this.value === 'Casado' || this.value === 'En Concubinato') {
                    btnConyugue.style.display = 'inline-block';
                } else {
                    btnConyugue.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectEstado = document.getElementById('estado_civil_cliente');
            const btnConyugue = document.getElementById('btnConyugue');

            selectEstado.addEventListener('change', function () {
                if (this.value === 'Casado' || this.value === 'En Concubinato') {
                    btnConyugue.style.display = 'inline-block';
                } else {
                    btnConyugue.style.display = 'none';
                }
            });

            @if (session('error_conyugue'))
                $('#modalConyugue').modal('show');
            @endif
        });
    </script>
@endsection
