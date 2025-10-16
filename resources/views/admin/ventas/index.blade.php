@extends('layouts.app')

@section('title', 'Ventas')

@section('content_header')

@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Ventas</h2>
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
                                <tbody class="table-bordered">
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td class="text-center"style="vertical-align: middle">
                                                {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}

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
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ url('/admin/ventas/' . $venta->id_venta) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                    {{--  <a href="{{ url('/admin/ventas/' . $venta->id_venta . '/edit') }}"
                                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> --}}
                                                    <a href="{{ url('/admin/ventas/reporte/' . $venta->id_venta) }}"
                                                        class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>
                                                    <form action="{{ url('/admin/ventas', $venta->id_venta) }}"
                                                        method="post" class="d-inline-block"
                                                        onsubmit="preguntar(event, {{ $venta->id_venta }})"
                                                        id="miFormulario{{ $venta->id_venta }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            style="border-radius: 0px 4px 4px 0px"
                                                            @if ($venta->estado_venta === 'Pagado') disabled
                                                                 title="No se puede eliminar una venta cobrada" @endif>
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
    </div>

    <div class="card mt-3 shadow-sm border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-calculator"></i> Resumen General de Ventas</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3">
                    <h6 class="text-muted">Total de Ventas</h6>
                    <h4 class="fw-bold text-success">${{ number_format($totalVenta, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Total Pagos</h6>
                    <h4 class="fw-bold text-danger">${{ number_format($totalPago, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Total Intereses</h6>
                    <h4 class="fw-bold ">${{ number_format($totalInteres, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Saldo Total</h6>
                    <h4 class="fw-bold text-primary">
                        ${{ number_format($totalVenta + $totalInteres - $totalPago , 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        {{-- Monto total de ventas --}}
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Monto total de ventas por mes</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartVentasMontos"></canvas>
                </div>
            </div>
        </div>

        {{-- Cantidad de ventas --}}
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de ventas mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartVentasCantidad"></canvas>
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

    @php
        // ====== VENTAS ======
        $mesesVentas = array_fill(1, 12, 0);
        $sumaVentas = array_fill(1, 12, 0);

        foreach ($ventas as $venta) {
            $fecha = strtotime($venta['fecha_venta']);
            if ($fecha !== false) {
                $mes = (int) date('m', $fecha);
                $mesesVentas[$mes]++;
                $sumaVentas[$mes] += $venta['total_pago'];
            }
        }

        $reporteCantidadVentas = implode(',', $mesesVentas);
        $reporteMontosVentas = implode(',', $sumaVentas);
    @endphp


    <script>
        const meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        // === Ventas ===
        const datosCantidadVentas = [{{ $reporteCantidadVentas }}];
        const datosMontosVentas = [{{ $reporteMontosVentas }}];

      

        // ---- Gráfico: Cantidad de Ventas ----
        new Chart(document.getElementById('chartVentasCantidad'), {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de Ventas',
                    data: datosCantidadVentas,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // ---- Gráfico: Monto Total de Ventas ----
        new Chart(document.getElementById('chartVentasMontos'), {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Monto Total de Ventas ($)',
                    data: datosMontosVentas,
                    fill: true,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: v => '$' + v.toLocaleString('es-AR')
                        }
                    }
                }
            }
        });

       

      
    </script>
@endsection
