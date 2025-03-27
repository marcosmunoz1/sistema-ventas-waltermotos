@extends('adminlte::page')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')

{{-- Content body: main page content --}}
@section('content_header')
    <h1><b>Proveedores</b></h1>
    <hr>
@stop

@section('content')

@stop

{{-- Push extra CSS --}}

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush
