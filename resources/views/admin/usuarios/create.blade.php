@extends('adminlte::page')

@section('title', 'Agregar Usuario')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Usuarios/<b>Crear-Usuario</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="col-md-4 mx-auto mt-4">
                    <div class="card card-info">
                        <div class="card-body">
                            <form action="{{ url('/admin/usuarios/crear-usuario') }}" method="post">
                                @csrf

                                <!-- Primera fila: Nombre de Usuario y Nombre del Rol -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombre de Usuario</label>
                                            <input type="text" name="name" class="form-control" required
                                                value="{{ old('name') }}" placeholder="Ingrese un nombre de usuario">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Rol</label>
                                            <select name="role" id="role" class="form-control">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Segunda fila: Correo -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input type="email" name="email" class="form-control" required
                                                value="{{ old('email') }}" placeholder="Ingrese un correo electrónico">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tercera fila: Contraseña -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" name="password" class="form-control" required
                                                placeholder="Ingrese su contraseña">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirme su contraseña</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required placeholder="Repita su contraseña">
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Registrar
                                    </button>
                                    <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>

                            </form> <!-- Cierre correcto del formulario -->
                        </div>
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
