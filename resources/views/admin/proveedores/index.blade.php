@extends('layouts.app')

@section('title', 'Proveedores')

@section('content_header')


@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Proveedores</h2>
                        <a href="{{ url('admin/proveedores/crear-proveedor') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Proveedor
                        </a>
                    </div>
                </div>

                <div class="col-md-12 mx-auto">
                    <div class="card-body">

                        <table id="tablaProveedores" class="table table-striped table-sm table-responsive">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%">#</th>
                                    <th class="text-center" style="width: 15%">Nombre</th>
                                    <th class="text-center" style="width: 15%">CUIT</th>
                                    <th class="text-center" style="width: 15%">Telefono</th>
                                    <th class="text-center" style="width: 15%">Celular</th>
                                    <th class="text-center" style="color:red 5%">Estado</th>
                                    <th class="text-center" style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <?php $contador = 1; ?>
                            <tbody>
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                        <td style="vertical-align: middle"> {{ $proveedor->nombre_proveedor }}</td>
                                        <td class="text-center" style="vertical-align: middle">{{ $proveedor->cuit }}</th>
                                        <td class="text-center" style="text-align: right; vertical-align: middle;">
                                            {{ $proveedor->telefono }}</td>
                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                            {{ $proveedor->celular }} </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <span
                                                class="badge {{ $proveedor->estado_proveedor == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $proveedor->estado_proveedor == 1 ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>

                                        <td class="text-center" style="vertical-align: middle">
                                            <div class="btn-group " role="group" aria-label="Basic example">
                                                <a href="{{ url('/admin/proveedores', $proveedor->id) }}"
                                                    class="btn btn-sm btn-info disabled"  aria-disabled="true"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-warning disabled" tabindex="-1"
                                                    aria-disabled="true">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('/admin/proveedores', $proveedor->id) }}"
                                                    method="post" class="d-inline-block"
                                                    onsubmit="preguntar(event, {{ $proveedor->id }})"
                                                    id="miFormulario{{ $proveedor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        style="border-radius: 0px 4px 4px 0px">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </div>
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
                title: '¿Desea eliminar este proveedor?',
                text: 'Los cambios seran permanentes',
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
    </script>

    <script>
        $('#tablaProveedores').DataTable({
            ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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
