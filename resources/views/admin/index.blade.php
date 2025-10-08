@extends('layouts.app')

{{-- Customize layout sections --}}



{{-- Content body: main page content --}}

@section('content')
    <div class="row mt-2">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-maroon  zoomP">
                <div class="inner">
                    <h3>Motos</h3>
                    <p>Registradas: {{ $cantidadMotos }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <a href="{{ url('/admin/motos') }}" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning zoomP">
                <div class="inner">
                    <h3>Créditos</h3>
                    <p>Registrados: {{ $cantidadCreditos }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <a href="{{ url('/admin/creditos') }}" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success zoomP">
                <div class="inner">
                    <h3>Ventas</h3>
                    <p>Registradas: {{ $cantidadVentas }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-cash-register"></i>
                </div>
                <a href="{{ url('/admin/ventas') }}" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info zoomP">
                <div class="inner">
                    <h3>Clientes</h3>
                    <p>Registrados: {{ $cantidadClientes }}</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <a href="{{ url('/admin/clientes') }}" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark zoomP">
                <div class="inner">
                    <h3>Proveedores</h3>
                    <p>Registrados: {{ $cantidadProveedores }}</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <a href="{{ url('/admin/proveedores') }}" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-light zoomP">
                <div class="inner">
                    <h3>Compras</h3>
                    <p>Registradas: {{ $cantidadCompras }}</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <a href="{{ url('/admin/compras') }}" class="small-box-footer text-dark">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary zoomP">
                <div class="inner">
                    <h3>Roles</h3>
                    <p>Registrados: {{ $cantidadRoles }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <a href="{{ url('/admin/roles') }}" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary zoomP">
                <div class="inner">
                    <h3>Usuarios</h3>
                    <p>Registrados: {{ $cantidadUsuarios }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ url('/admin/usuarios') }}" class="small-box-footer">
                    Ingresar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{--  <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning zoomP">
            <div class="inner">
                <h3>Marcas</h3>

                 <p>Registradas: {{ $cantidadMarcas}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="{{ url('/admin/categorias') }}" class="small-box-footer">
                Ingresar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div> --}}
    </div>
    @if ($morosos->isNotEmpty())
        <div class="alert alert-danger" role="alert">
            <h5 class="mb-3"><i class="fas fa-exclamation-triangle"></i> Clientes Morosos</h5>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Cuotas Vencidas</th>
                            <th class="text-center">Celular</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($morosos as $credito)
                            @php
                                $cliente = $credito->venta->cliente;
                                $cuotasVencidas = $credito->detalles
                                    ->filter(
                                        fn($detalle) => $detalle->estado_cuota === 'Pendiente' &&
                                            $detalle->fecha_vencimiento < now(),
                                    )
                                    ->count();
                            @endphp
                            <tr>
                                <td>{{ $cliente->apellido_cliente }} {{ $cliente->nombre_cliente }}</td>
                                <td class="text-center">{{ $cuotasVencidas }}</td>
                                <td class="text-center">{{ $cliente->celular_cliente }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.creditos.show', $credito->id) }}"
                                        class="btn btn-block btn-outline-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver crédito
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2 fs-3"></i>
            <div>
                <h5 class="mb-0">No hay clientes morosos</h5>
            </div>
        </div>
    @endif



    <div class="row">
        {{-- Monto total de ventas --}}
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ventas Mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartVentasMontos"></canvas>
                </div>
            </div>
        </div>

        {{-- Saldo total de creditos --}}
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Créditos Mensuales</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartCreditosMontos"></canvas>
                </div>
            </div>
        </div>
    </div>


@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
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

        // ====== CRÉDITOS ======
        $mesesCreditos = array_fill(1, 12, 0);
        $sumaCreditos = array_fill(1, 12, 0);

        foreach ($creditos as $credito) {
            $fecha = strtotime($credito['created_at']);
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

        // === Ventas ===
        const datosCantidadVentas = [{{ $reporteCantidadVentas }}];
        const datosMontosVentas = [{{ $reporteMontosVentas }}];

        // === Créditos ===
        const datosCantidadCreditos = [{{ $reporteCantidadCreditos }}];
        const datosMontosCreditos = [{{ $reporteMontosCreditos }}];

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


        // ---- Gráfico: Monto Total Financiado ----
        new Chart(document.getElementById('chartCreditosMontos'), {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Saldo Total Financiado ($)',
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
@endpush
