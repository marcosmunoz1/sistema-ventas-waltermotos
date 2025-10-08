@extends('layouts.app')

@section('title', 'Créditos')

@section('content_header')

@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-primary mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Lista de Creditos </h2>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-striped table-sm" id="miTabla">
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
                                    <tbody class="table-bordered">
                                        @php
                                            $granTotal = 0;
                                            $granInteres = 0;
                                        @endphp
                                        @foreach ($creditos as $credito)
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle">{{ $contador++ }}
                                                </td>
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

                                                @php
                                                    $granInteres += $credito->total_interes;
                                                    $total =
                                                        $credito->valor_financiado +
                                                        $credito->total_interes -
                                                        $credito->saldo_credito;
                                                    $granTotal += $total;
                                                @endphp

                                                <td class="text-right text-primary" style="vertical-align: middle">
                                                    ${{ number_format($total, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge {{ $credito->estado_credito == 'Pagado' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $credito->estado_credito }}
                                                    </span>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ url('/admin/creditos/' . $credito->id) }}"
                                                            class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>

                                                        <form
                                                            action="{{ url('/admin/creditos/' . $credito->id . '/cobrar-cuotas') }}"
                                                            method="get" class="d-inline-block">
                                                            <button type="submit" class="btn btn-sm btn-success"
                                                                style="border-radius: 0px 4px 4px 0px"
                                                                @if ($credito->estado_credito === 'Pagado') disabled title="El crédito ya está pagado" @endif>
                                                                <i class="fas fa-cash-register"></i>
                                                            </button>
                                                        </form>



                                                        <form action="{{ url('/admin/creditos', $credito->id) }}"
                                                            method="post" class="d-inline-block"
                                                            onsubmit="preguntar(event, {{ $credito->id }})"
                                                            id="miFormulario{{ $credito->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                style="border-radius: 0px 4px 4px 0px"
                                                                @if ($credito->estado_credito === 'Pagado') disabled
                                                                 title="No se puede eliminar un crédito pagado" @endif>
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
    </div>


    <div class="card mt-3 shadow-sm border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-calculator"></i> Resumen General de Créditos</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3">
                    <h6 class="text-muted">Total Financiado</h6>
                    <h4 class="fw-bold text-success">${{ number_format($totalFinanciado, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Saldo Pendiente</h6>
                    <h4 class="fw-bold text-danger">${{ number_format($totalSaldo, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Interes Total</h6>
                    <h4 class="fw-bold ">${{ number_format( $granInteres, 2, ',', '.') }}</h4>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted">Total Cancelado c/interes</h6>
                    <h4 class="fw-bold text-primary">${{ number_format($granTotal, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>



    <div class="row">

        {{-- Saldo total de creditos --}}
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Saldo total de Créditos</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartCreditosMontos"></canvas>
                </div>
            </div>
        </div>

        {{-- Cantidad de créditos --}}
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de créditos mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartCreditosCantidad"></canvas>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('css')
    <style>
        .nav-tabs .nav-link {
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            background-color: #f8f9fa;
            border-bottom-color: #f8f9fa;
        }
    </style>
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


    @php
        $mesesCreditos = array_fill(1, 12, 0);
        $sumaCreditos = array_fill(1, 12, 0);

        foreach ($creditos as $credito) {
            $fecha = strtotime($credito->fecha_credito ?? $credito->created_at);
            if ($fecha !== false) {
                $mes = (int) date('m', $fecha);
                $mesesCreditos[$mes]++;
                $sumaCreditos[$mes] += $credito['saldo_credito'];
            }
        }

        $reporteCantidadCreditos = implode(',', $mesesCreditos);
        $reporteMontosCreditos = implode(',', $sumaCreditos);
    @endphp

    <script>
        const meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        const datosCantidadCreditos = [{{ $reporteCantidadCreditos }}];
        const datosMontosCreditos = [{{ $reporteMontosCreditos }}];

        // ---- Gráfico: Cantidad de Créditos ----
        new Chart(document.getElementById('chartCreditosCantidad'), {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de Créditos',
                    data: datosCantidadCreditos,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
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

        // ---- Gráfico: Monto Total Financiado ----
        new Chart(document.getElementById('chartCreditosMontos'), {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Monto Total Financiado ($)',
                    data: datosMontosCreditos,
                    fill: true,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
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
