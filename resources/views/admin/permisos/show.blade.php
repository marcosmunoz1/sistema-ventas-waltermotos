@extends('layouts.app')

@section('title', 'Ver Permiso')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Permisos/<b>Ver Premiso</b> </h2>
                    </div>
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">

                    <div class="card card-body mt-4 card-info">
                        <div
                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">

                            <div class="d-flex mb-3">
                                <label for="name" class="mr-2">Nombre del Permiso:</label>
                                <p class="mb-0">{{ $permiso->name }}</p>
                            </div>

                            <div class="card-footer">
                                <a href="{{ url('admin/permisos') }}" class="btn btn-secondary float-right">
                                    <i class="fa-solid fa-arrow-left"></i> Volver
                                </a>
                            </div>

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
