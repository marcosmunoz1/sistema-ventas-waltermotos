@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1><b>Proveedores/Creación de Proveedor</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                 <h3 class="card-title">ingrese los datos</h3>
               </div>
                <div class="card-body" style="display: block;">
                    <form action="{{url('admin/proveedores/cargar-proveedor')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_proveedor">Nombre del proveedor</label> <b>*</b>
                                    <input type="text" value="{{old('nombre_proveedor')}}" class="form-control" name="nombre_proveedor" required>
                                    @error('nombre_proveedor')
                                     <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cuit">Cuit</label> <b>*</b>
                                    <input type="text" value="{{old('direction')}}" class="form-control" name="cuit" required>
                                    @error('cuit')
                                     <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label> <b>*</b>
                                    <input type="text" value="{{old('telefono')}}" class="form-control" name="telefono" required>
                                    @error('telefono')
                                     <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label> <b>*</b>
                                    <input type="email" value="{{old('email')}}" class="form-control" name="email" required>
                                    @error('email')
                                     <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular</label> <b>*</b>
                                    <input type="text" value="{{old('celular')}}" class="form-control" name="celular" required>
                                    @error('celular')
                                     <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a class="btn btn-success" href="{{url('admin/proveedores')}}">Volver</a>
                                   <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Registrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
