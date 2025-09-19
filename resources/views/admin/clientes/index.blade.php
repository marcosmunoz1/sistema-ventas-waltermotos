@extends('layouts.app')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Clientes</h2>
                        <a class="btn btn-primary" href="{{ url('admin/clientes/create') }}">
                            <i class="fas fa-plus"></i> Nuevo Cliente
                        </a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto ">

                    <div class="card-body">
                        <table id="mitabla" class="table table-striped table-hover table-sm">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" style="width: 10%">#</th>
                                    <th class="text-center" style="width: 15%">Nombre</th>
                                    <th class="text-center" style="width: 10%">Apellido</th>
                                    <th class="text-center" style="width: 10%">CUIT</th>
                                    <th class="text-center" style="width: 10%">DNI</th>
                                    <th class="text-center" style="width: 10%">Celular</th>
                                    <th class="text-center" style="width: 10%">Acciones</th>
                                </tr>
                            </thead>
                            <?php $contador = 1; ?>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td class="text-center">{{ $contador++ }}</td>
                                        <td style="vertical-align: middle">{{ $cliente->nombre_cliente }}</td>
                                        <td style="vertical-align: middle">{{ $cliente->apellido_cliente }}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            {{ $cliente->cuit_cliente }}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            {{ $cliente->dni_cliente }}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            {{ $cliente->celular_cliente }}</td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('/admin/clientes', $cliente->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ url('/admin/clientes/' . $cliente->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $cliente->id }})"
                                                    id="miFormulario{{ $cliente->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        style="border-radius: 0px 4px 4px 0px">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar este Cliente? ',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonColor: '#270a0a',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('miFormulario' + id);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>
    <script>
        $('#mitabla').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "lengthMenu": "Mostrar _MENU_ Clientes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>

@stop
