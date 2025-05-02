@extends('adminlte::page')

@section('title', 'Creditos')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Listado de Creditos
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de Creditos</h3>
                    {{--  <div class="card-tools">
                        <a href="{{ url('admin/ventas/crear-venta') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Nueva Venta</a>
                    </div> --}}
                </div>
                <div class="col-md-12 mx-auto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="miTabla">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 3%">#</th>
                                        <th class="text-center" style="width: 10%">Fecha</th>
                                        <th class="text-center" style="width: 5%">Venta</th>
                                        <th class="text-center" style="width: 15%">Cliente</th>
                                        <th class="text-center" style="width: 5%">Cuotas</th>
                                        <th class="text-center" style="width: 5%">Valor Financiado</th>
                                        <th class="text-center" style="width: 5%">Saldo</th>
                                        <th class="text-center" style="width: 5%">Int. x Mora</th>
                                        <th class="text-center" style="width: 5%">TOTAL</th>
                                        <th class="text-center" style="width: 2%">Estado</th>
                                        <th class="text-center" style="width: 15%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($creditos as $credito)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                            <td class="text-center"style="vertical-align: middle">
                                                {{ $credito->venta->fecha_venta }}
                                            </td>
                                            <td class="text-center"style="vertical-align: middle">
                                                {{ $credito->venta->id_venta }}
                                            <td style="vertical-align: middle">
                                                {{ $credito->venta->cliente->apellido_cliente }},
                                                {{ $credito->venta->cliente->nombre_cliente }} </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $credito->cantidad_cuotas }}</td>
                                            <td class="text-success text-right" style="vertical-align: middle">
                                                ${{ number_format($credito->valor_financiado, 2, ',', '.') }}</td>
                                            <td class="text-danger text-right" style="vertical-align: middle">
                                                ${{ number_format($credito->saldo_credito, 2, ',', '.') }}</td>
                                            <td class="text-right" style="vertical-align: middle">
                                                ${{ number_format($credito->total_interes, 2, ',', '.') }}</td>
                                            <td class="text-right text-primary" style="vertical-align: middle">
                                                ${{ number_format($tota = $credito->valor_financiado + $credito->total_interes - $credito->saldo_credito, 2, ',', '.') }}
                                            <td class="text-center" style="vertical-align: middle">
                                                <span
                                                    class="badge {{ $credito->estado_credito == 'Pagado' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $credito->estado_credito }}
                                                </span>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{ url('/admin/creditos/' . $credito->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ url('/admin/creditos/' . $credito->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('/admin/creditos/' . $credito->id . '/cobrar-cuotas') }}"
                                                    class="btn btn-sm btn-secondary"><i
                                                        class="fas fa-cash-register"></i></a>
                                                <form action="{{ url('/admin/creditos', $credito->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $credito->id }})"
                                                    id="miFormulario{{ $credito->id }}">
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
                title: '¿Desea eliminar este Credito?',
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Creditos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Creditos",
                "infoFiltered": "(Filtrado de _MAX_ total Creditos)",
                "lengthMenu": "Mostrar _MENU_ Creditos",
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
