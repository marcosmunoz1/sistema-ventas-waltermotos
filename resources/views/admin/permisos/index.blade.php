@extends('layouts.app')

@section('title', 'Permisos')

@section('content_header')

@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-primary mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Listado de Permisos</h2>
                            <a href="{{ url('admin/permisos/crear-permiso') }}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i>
                                Nuevo
                                Permiso</a>
                        </div>
                    </div>
                    <div class="col-md-8 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-sm table-hover" id="tablaProductos">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center" style="width: 10%">#</th>
                                            <th style="width: 50%">Nombre del Permiso</th>
                                            <th class="text-center" style="width: 40%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php $contador = 1; ?>
                                    <tbody>
                                        @foreach ($permisos as $permiso)
                                            <tr>
                                                <td class="text-center">{{ $contador++ }}</td>
                                                <td>{{ $permiso->name }}</th>
                                                <td class="text-center">
                                                    <a href="{{ url('/admin/permisos', $permiso->id) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver</a>
                                                    <a href="{{ url('/admin/permisos/' . $permiso->id . '/edit') }}"
                                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>
                                                        Editar</a>
                                                    <form action="{{ url('/admin/permisos', $permiso->id) }}" method="post"
                                                        class="d-inline-block"
                                                        onsubmit="preguntar(event, {{ $permiso->id }})"
                                                        id="miFormulario{{ $permiso->id }}">
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
                    title: '¿Desea eliminar este Permiso? ',
                    text: 'Todos los usuarios con este rol se veran afectados',
                    icon: 'warning',
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


            $('#tablaProductos').DataTable({
                "pageLength": 10,
                "language": {
                    "emptyTable": "No hay información.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Permisos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Permisos",
                    "infoFiltered": "(Filtrado de _MAX_ total Permisos)",
                    "lengthMenu": "Mostrar _MENU_ Permisos",
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
