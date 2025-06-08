@extends('adminlte::page')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- Roles card -->
        <div class="small-box bg-info zoomP">
            <div class="inner">
                <h3>Roles</h3>

                <p>Registrados: {{ $cantidadRoles }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
            <a href="{{ url('/admin/roles') }}" class="small-box-footer">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card Usuarios -->
        <div class="small-box bg-success zoomP">
            <div class="inner">
                <h3>Usuarios</h3>

                <p>Registrados: {{ $cantidadUsuarios }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('/admin/usuarios') }}" class="small-box-footer">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning zoomP">
            <div class="inner">
                <h3>Marcas</h3>

                <p>Registradas: {{ $cantidadMarcas}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="{{ url('/admin/categorias') }}" class="small-box-footer">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger zoomP">
            <div class="inner">
                <h3>Motos</h3>

                <p>Registradas: {{ $cantidadMotos}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-list"></i>
            </div>
            <a href="{{ url('/admin/motos') }}" class="small-box-footer">
                Ingresar <i class="fas fa-motorcycle"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-dark zoomP">
            <div class="inner">
                <h3>Proveedores</h3>

                <p>Registradas: {{ $cantidadProveedores}}</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <a href="{{ url('/admin/proveedores') }}" class="small-box-footer">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box text-bg-light zoomP">
            <div class="inner">
                <h3>Compras</h3>

                <p>Registradas: {{ $cantidadCompras}}</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <a href="{{ url('/admin/compras') }}" class="small-box-footer text-dark">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info zoomP">
            <div class="inner">
                <h3>Clientes</h3>

                <p>Registradas: {{ $cantidadClientes}}</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <a href="{{ url('/admin/clientes') }}" class="small-box-footer text-dark">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success zoomP">
            <div class="inner">
                <h3>Ventas</h3>

                <p>Registradas: {{ $cantidadVentas}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-cash-register"></i>
            </div>
            <a href="{{ url('/admin/ventas') }}" class="small-box-footer text-dark">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning zoomP">
            <div class="inner">
                <h3>Creditos</h3>

                <p>Registrados: {{ $cantidadCreditos}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-money"></i>
            </div>
            <a href="{{ url('/admin/creditos') }}" class="small-box-footer text-dark">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush