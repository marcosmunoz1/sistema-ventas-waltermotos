@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Listado de Ventas
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de Ventas</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/ventas/crear-venta') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Nueva Venta</a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="miTabla">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 10%">Fecha</th>
                                        <th class="text-center" style="width: 5%">Numero</th>
                                        <th class="text-center" style="width: 15%">Cliente</th>
                                        <th class="text-center" style="width: 5%">P. Venta</th>
                                        <th class="text-center" style="width: 5%">Interes Mora</th>
                                        <th class="text-center" style="width: 5%">Total Pagado</th>
                                        <th class="text-center" style="width: 5%">Forma</th>
                                        <th class="text-center" style="width: 5%">Estado</th>
                                        <th class="text-center" style="width: 10%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                            <td class="text-center"style="vertical-align: middle"> {{ $venta->fecha_venta }}
                                            </td>
                                            <td class="text-center"style="vertical-align: middle"> {{ $venta->id_venta }}
                                            <td style="vertical-align: middle">
                                                {{ $venta->cliente->apellido_cliente }},
                                                {{ $venta->cliente->nombre_cliente }} </td>
                                            <td class="text-success text-right" style="vertical-align: middle">
                                                ${{ number_format($venta->precio_venta, 2, ',', '.') }}</td>
                                                <td class="text-right" style="vertical-align: middle">
                                                    ${{ number_format($venta->total_interes, 2, ',', '.') }}</td>
                                            <td class="text-danger text-right" style="vertical-align: middle">
                                                ${{ number_format($venta->total_pago, 2, ',', '.') }}</td>
                                            <td class="text-center" style="vertical-align: middle">
                                                @php
                                                    $color = $venta->forma_pago === 'Contado' ? 'primary' : 'warning';
                                                @endphp
                                                <span
                                                    class="badge bg-{{ $color }}">{{ ucfirst($venta->forma_pago) }}</span>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle">
                                                <span
                                                    class="badge {{ $venta->estado_venta == 'Pagado' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $venta->estado_venta }}
                                                </span>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{ url('/admin/ventas/' . $venta->id_venta) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ url('/admin/ventas/' . $venta->id_venta . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('/admin/ventas', $venta->id_venta) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $venta->id_venta }})"
                                                    id="miFormulario{{ $venta->id_venta }}">
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
                title: '¿Desea eliminar esta Venta?',
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
        $('#miTabla').DataTable({
            ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                "lengthMenu": "Mostrar _MENU_ Ventas",
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
