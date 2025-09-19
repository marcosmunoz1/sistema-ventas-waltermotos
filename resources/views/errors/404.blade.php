@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content_header')

@stop

@section('content')
    <div class="text-center">
        <h1 class="text-danger" style="font-size: 100px;">404</h1>
        <h3>La página que buscas no existe</h3>
        <p>Es posible que el enlace esté roto o que la página haya sido eliminada.</p>
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        <a href="{{ route('home') }}" class="btn btn-primary">Ir al inicio</a>
    </div>
@stop
