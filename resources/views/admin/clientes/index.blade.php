@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h2>Listado de Clientes
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Clientes Registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{url('admin/clientes/create')}}">
                            <i class="fas fa-plus"></i> Nuevo Cliente
                        </a>
                    </div>
                </div>
                <div class="col-md-10 mx-auto mt-4">
                    <div class="card">
                        <div class="card-body">
                            <table id="mitabla" class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 10%">#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>CUIT</th>
                                        <th>DNI</th>
                                        <th>Celular</th>
                                        <th class="text-center" style="width: 40%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td class="text-center">{{ $contador++ }}</td>
                                            <td>{{ $cliente->nombre_cliente }}</td>
                                            <td>{{ $cliente->apellido_cliente }}</td>
                                            <td>{{ $cliente->cuit_cliente }}</td>
                                            <td>{{ $cliente->dni_cliente }}</td>
                                            <td>{{ $cliente->celular_cliente }}</td>

                                            <td class="text-center">
                                                <a href="{{ url('/admin/clientes', $cliente->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver</a>
                                                <a href="{{ url('/admin/clientes/' . $cliente->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                                <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $cliente->id }})"
                                                    id="miFormulario{{ $cliente->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Eliminar
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
