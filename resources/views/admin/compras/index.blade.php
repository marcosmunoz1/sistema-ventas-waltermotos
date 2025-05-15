@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h2 class="brand-text font-weight-light "><b>Listado de Compras</b>
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Compras registradas</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/compras/crear-compra') }}" class="btn btn-primary"> <i
                            class="fas fa-plus"></i> Nueva Compra</a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tablaCompras">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 10%">Proveedor</th>
                                        <th class="text-center" style="width: 10%">Celular</th>
                                        <th class="text-center" style="width: 10%">Fecha</th>
                                        <th class="text-center" style="width: 10%">N.Factura</th>
                                        <th class="text-center" style="width: 10%">Total</th>
                                        <th class="text-center" style="width: 15%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                            <td class="text-center"style="vertical-align: middle">
                                                {{ $compra->proveedor->nombre_proveedor}}</td>
                                                <td class="text-center"style="vertical-align: middle"> {{ $compra->proveedor->celular }}
                                                <td class="text-center"style="vertical-align: middle"> {{ \App\Helpers\Helpers::cambiaFormatoFecha(($compra->fecha_compra))}}</td>
                                                </td>
                                            </td>
                                            <td class="text-center"style="vertical-align: middle"> {{ $compra->numero_factura }}
                                            </td>
                                            <td class="text-center"style="vertical-align: middle;color:red;">${{number_format($compra->total_compra, 2, ',', '.')  }}</td>


                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{ url('/admin/compras', $compra->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ url('/admin/compras/' . $compra->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('/admin/compras', $compra->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $compra->id }})"
                                                    id="miFormulario{{ $compra->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
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
    </div>

@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endsection

@section('js')

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar esta Compra?',
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
        $('#tablaCompras').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "lengthMenu": "Mostrar _MENU_ Compras",
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
@endsection
