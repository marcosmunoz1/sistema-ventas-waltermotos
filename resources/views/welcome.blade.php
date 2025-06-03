@extends('adminlte::page')

@section('title', 'Bienvenidos')

@section('content_header')
    <h1 style="font-family: Arial, sans-serif; text-align: center;">HOLA!!</h1>
@stop

@section('content')
    <div class="container" style="font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4;">
        <h1>¡Bienvenido al WalterMOTOS Sistema!</h1>
        <p>Necesitas iniciar sesión para acceder a las funcionalidades del sistema.</p>
        <a href="{{url('/login')}}" class="btn">Iniciar Sesión</a>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
    
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
           
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
@stop

@section('js')
    
@stop
