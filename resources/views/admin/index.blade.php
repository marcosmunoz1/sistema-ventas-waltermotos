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
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Resumen mensual de los montos de ventas</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Resumen de la cantidad de ventas mensuales</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
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

    <?php
    $meses = array_fill(1, 12, 0);
    $suma_ventas = array_fill(1, 12, 0);
    
    foreach ($ventas as $venta) {
        $fecha = strtotime($venta['fecha_venta']);
        // Verifica que strtotime() haya devuelto una fecha válida
        if ($fecha !== false) {
            $mes = date('m', $fecha);
            $meses[(int) $mes]++;
            $suma_ventas[(int) $mes] += $venta['total_pago'];
        } else {
            // Maneja el caso en que la fecha no sea válida (si es necesario)
            echo 'Fecha inválida: ' . $venta['fecha_venta'] . '<br>';
        }
    }
    $reporte_cantidad = implode(',', $meses);
    $reporte_ventas = implode(',', $suma_ventas);
    ?>

    <script>
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiempre', 'Octubre',
            'Noviembre', 'Diciembre'
        ];
        var datos = [{{ $reporte_cantidad }}];
        const ctx2 = document.getElementById('myChart')

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Total cantidad de ventas',
                    data: datos,
                    borderWidtch: 1

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
    <script>
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiempre', 'Octubre',
            'Noviembre', 'Diciembre'
        ]
        var datos = [{{ $reporte_ventas }}]
        const ctx = document.getElementById('myChart2')

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Monto Total de ventas',
                    data: datos,
                    borderWidtch: 1

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
@endpush
