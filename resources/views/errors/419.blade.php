@extends('layouts.app')

@section('title', 'Sesion Caducada')

@section('content')

    <div class="text-center">
        <h1 class="text-info" style="font-size: 100px;">419</h1>
        <h3>La página expiró.</h3>
        <p>Debes volver a iniciar sesion para continuar.</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Iniciar sesión
        </a>
    </div>

@endsection
