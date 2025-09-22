@extends('layouts.app')

@section('title', 'Editar Permiso')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Permisos/<b>Editar Premiso</b> </h2>
                    </div>
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div
                        class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">

                        <div class="card card-info">
                            <form action="{{ url('/admin/permisos', $permiso->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del permiso</label>
                                        <input type="text"name="name" class="form-control" required
                                            value="{{ $permiso->name }}" placeholder="Ingrese un nombre de rol">
                                        @error('name')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-file-arrow-up"></i>
                                        Actualizar
                                    </button>
                                    <a href="{{ url('admin/permisos') }}" class="btn btn-secondary">
                                        <i class="fas fa-cancel"></i> Cancelar
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
