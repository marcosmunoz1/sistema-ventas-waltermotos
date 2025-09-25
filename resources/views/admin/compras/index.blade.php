@extends('layouts.app')

@section('content_header')


@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Compras</h2>
                        <a href="{{ url('/admin/compras/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva
                            compra</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="mitabla" class="table table-striped table-bordered table-hover table-sm ">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align: center; width: 8%">#</th>
                                <th scope="col" style="text-align: center; width: 10%">Fecha</th>
                                <th scope="col" style="text-align: center; width: 25%">Proveedor</th>
                                <th scope="col" style="text-align: center; width: 10%">Remito</th>
                                <th scope="col" style="text-align: center; width: 10%">Factura</th>
                                <th scope="col" style="text-align: center; width: 10%">Precio total</th>
                                <th scope="col" style="text-align: center; width: 10%">Acciones</th>
                            </tr>
                        </thead>
                        <?php $contador = 1; ?>
                        <tbody>
                            @foreach ($compras as $compra)
                                <tr>
                                    <td style="text-align: center;vertical-align:middle;">{{ $contador++ }}</td>
                                    <td class="text-center" style="vertical-align:middle;">
                                        {{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d-m-Y') }}</td>
                                    <td style="vertical-align:middle;">{{ $compra->proveedor->nombre_proveedor }}</td>
                                    <td class="text-center" style="vertical-align:middle;">{{ $compra->numero_remito }}</td>
                                    <td class="text-center" style="vertical-align:middle;">{{ $compra->numero_factura }}
                                    </td>
                                    <td class="text-right text-danger" style="vertical-align:middle;">
                                        ${{ number_format($compra->total_compra, 2, ',', '.') }}</td>
                                    <td style="text-align: center;vertical-align:middle;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/compras', $compra->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/compras/' . $compra->id . '/edit') }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                                            <form action="{{ url('/admin/compras ', $compra->id) }}" method="post"
                                                id="formEliminarCompra{{ $compra->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    style="border-radius: 0px 4px 4px 0px"
                                                    onclick="preguntarEliminarCompra({{ $compra->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
    <script>
        $('#mitabla').DataTable({
            ordering: false,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Compras",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });


        function preguntarEliminarCompra(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará la compra y todas sus motos (que no estén vendidas).",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formEliminarCompra' + id).submit();
                }
            });
        }
    </script>
@stop
