@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Admin/Permisos/<b>Editar-Permiso</b></h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifique los Datos</h3>
                    {{-- <div class="card-tools">
                        <a href="{{url('admin/roles/crear-rol')}}" class="btn btn-success"><i class="fas fa-save"></i>  Agregar Rol</a>
                    </div> --}}
                </div>
                <div class="col-md-4 mx-auto d-flex justify-content-center">
                    <div class="card-body">
                        <div class="card card-info">
                            <form action="{{ url('/admin/permisos',$permiso->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre del Rol</label>
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
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')


@stop
