@extends('layouts.app')

@section('title', 'Agregar Permiso')

@section('content_header')

@stop

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-outline card-success mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Permisos/<b>Nuevo Premiso</b> </h2>
                    </div>
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div
                        class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">

                        <div class="card card-info">
                            <form action="{{ url('/admin/permisos/crear-permiso') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del Permiso</label>
                                        <input type="text"name="name" class="form-control" required
                                            value="{{ old('name') }}" placeholder="Ingrese un nombre">
                                        @error('name')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{--  <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                                        Registrar
                                    </button>
                                    <a href="{{ url('admin/roles') }}" class="btn btn-secondary float-right">
                                        <i class="fas fa-cancel"></i> Cancelar
                                    </a>
                                </div> --}}
                                <!-- Botones de acción -->
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Registrar
                                    </button>
                                    <a href="{{ url('admin/permisos') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')


@stop
