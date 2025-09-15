@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light text-center">
    <img src="{{ asset('/storage/imagenes/logo-login.png') }}" alt="Logo" class="mb-4" style="max-width: 150px;">

    <h1 class="display-1 fw-bold text-danger">403</h1>
    <h2 class="fw-semibold text-dark">Acceso no autorizado</h2>
    <h4 class="text-muted">No tenés permisos para realizar esta acción.</h4>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>
@endsection
