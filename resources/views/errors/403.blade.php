@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')

    <div class="text-center">
        <h1 class="text-yellow" style="font-size: 100px;">403</h1>
        <h3>Acceso no autorizado</h3>
        <p>No tenés permisos para realizar esta acción.</p>
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        <a href="{{ route('home') }}" class="btn btn-primary">Ir al inicio</a>
    </div>

@endsection
