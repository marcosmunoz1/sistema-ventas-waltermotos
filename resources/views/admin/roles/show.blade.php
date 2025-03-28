@extends('adminlte::page')

@section('title', 'Agregar Rol')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Admin/Roles/<b>Ver-Rol</b></h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                    {{-- <div class="card-tools">
                        <a href="{{url('admin/roles/crear-rol')}}" class="btn btn-success"><i class="fas fa-save"></i>  Agregar Rol</a>
                    </div> --}}
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div class="card-body">
                        <div class="card card-info">
                          
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del Rol</label>
                                        <p> {{ $rol->name }} </p>                             
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ url('admin/roles') }}" class="btn btn-secondary float-right">
                                        <i class="fa-solid fa-arrow-left"></i>  Volver
                                    </a>
                                </div>
                            
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
