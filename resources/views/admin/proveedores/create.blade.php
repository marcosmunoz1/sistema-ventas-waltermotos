@extends('layouts.app')

@section('title', 'Nuevo Proveedor')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Proveedores/<b>Nuevo Proveedor</b> </h2>
                    </div>
                </div>

                <div class="col-md-12 mx-auto">
                     <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                        <form action="{{ url('admin/proveedores/cargar-proveedor') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_proveedor">Nombre del proveedor</label> <b>*</b>
                                        <input type="text" value="{{ old('nombre_proveedor') }}" class="form-control"
                                            name="nombre_proveedor" required>
                                        @error('nombre_proveedor')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cuit">Cuit</label> <b>*</b>
                                        <input type="text" value="{{ old('direction') }}" class="form-control"
                                            name="cuit" required>
                                        @error('cuit')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label> <b>*</b>
                                        <input type="text" value="{{ old('telefono') }}" class="form-control"
                                            name="telefono" required>
                                        @error('telefono')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label> <b>*</b>
                                        <input type="email" value="{{ old('email') }}" class="form-control"
                                            name="email" required>
                                        @error('email')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular</label> <b>*</b>
                                        <input type="text" value="{{ old('celular') }}" class="form-control"
                                            name="celular" required>
                                        @error('celular')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>

                            </div>
                            <hr>
                           
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                    Registrar</button>
                                <a href="{{ url('admin/proveedores') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>
                        </form>
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
