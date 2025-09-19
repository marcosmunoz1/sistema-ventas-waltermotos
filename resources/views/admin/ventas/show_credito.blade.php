@extends('layouts.app')

@section('title', 'Detalle Venta')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Ver-Detalle de Credito</b></h2>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="detalleTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="cliente-tab" data-toggle="tab" href="#cliente"
                                        role="tab"><i class="fas fa-user-tie"></i> Cliente</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="moto-tab" data-toggle="tab" href="#moto" role="tab"><i
                                            class="fas fa-motorcycle"></i> Moto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="credito-tab" data-toggle="tab" href="#credito" role="tab">
                                        <i class="fas fa-file-invoice-dollar mr-1"></i> Crédito
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3">
                                {{-- CLIENTE --}}
                                <div class="tab-pane fade show active" id="cliente" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h6><strong>Cliente: </strong> {{ $cliente->apellido_cliente }},
                                                    {{ $cliente->nombre_cliente }}
                                                </h6>
                                                <h6><strong>Email: </strong> {{ $cliente->email_cliente }}</h6>
                                                <h6><strong>CUIT: </strong> {{ $cliente->cuit_cliente }}</h6>
                                                <h6><strong>DNI: </strong> {{ $cliente->dni_cliente }}</h6>
                                                <h6><strong>Fecha Nacimienot: </strong>
                                                    {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}</h6>
                                                <h6><strong>Telefono: </strong> {{ $cliente->celular_cliente }}</h6>
                                                <h6><strong>Estado Civil: </strong> {{ $cliente->estado_civil_cliente }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="mx-2 mt-2">
                                                    @if ($cliente->conyugue)
                                                        <h6><strong>Conyugue:</strong>
                                                            {{ $cliente->conyugue->apellido_conyugue }},
                                                            {{ $cliente->conyugue->nombre_conyugue }}
                                                        </h6>
                                                        <h6><strong>DNI:</strong> {{ $cliente->conyugue->dni_conyugue }}
                                                        </h6>
                                                        <h6><strong>Fecha Nacimiento:</strong>
                                                            {{ \Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('d-m-Y') }}
                                                        </h6>
                                                        <h6><strong>Teléfono:</strong>
                                                            {{ $cliente->conyugue->celular_conyugue }}</h6>
                                                    @else
                                                        <h6><strong>Conyugue:</strong> No registrado</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- MOTO --}}
                                <div class="tab-pane fade" id="moto" role="tabpanel">
                                    <div class="card-body">
                                        <div class="mx-2 mt-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <h6><strong>Marmca:</strong> {{ $moto->marca->nombre_marca }}</h6>
                                                    <h6><strong>Modelo:</strong> {{ $moto->modelo_moto }}</h6>
                                                    <h6><strong>Año:</strong> {{ $moto->anio_moto }}</h6>
                                                    <h6><strong>Dominio:</strong> {{ $moto->dominio }}</span></h6>
                                                </div>
                                                <div class="col-4">
                                                    <h6><strong>Color:</strong> {{ $moto->color_moto }}</span></h6>
                                                    <h6><strong>Cilindradas:</strong> {{ $moto->cilindrada_moto }}cc</span>
                                                    </h6>
                                                    <h6><strong>Nacionalidad:</strong> {{ $moto->nacionalidad->pais }}
                                                    </h6>
                                                    <h6><strong>Km:</strong> {{ $moto->km_moto }}km. </h6>
                                                </div>
                                                <div class="col-5">
                                                    <h6><strong>DNRPA:</strong> {{ $moto->dnrpa }}</span> </h6>
                                                    <h6><strong>Nro. Certificado:</strong>
                                                        {{ $moto->nr_certificado }}</span></h6>
                                                    <h6><strong>Nro. Motor:</strong> {{ $moto->nr_motor }}</span> </h6>
                                                    <h6><strong>Nro. Chasis:</strong> {{ $moto->nr_chasis }}</span> </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- CREDITO --}}
                                <div class="tab-pane fade" id="credito" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped" id="miTabla">
                                                        <thead class="table-info">
                                                            <tr>
                                                                <th class="text-center" style="width: 5%">Cuota</th>
                                                                <th class="text-center" style="width: 5%">Vencimiento</th>
                                                                <th class="text-center" style="width: 15%">Fecha Pago</th>
                                                                <th class="text-center" style="width: 5%">Valor</th>
                                                                <th class="text-center" style="width: 5%">Interes x Mora
                                                                </th>
                                                                <th class="text-center" style="width: 5%">Estado</th>

                                                            </tr>
                                                        </thead>
                                                        <?php $contador = 1; ?>
                                                        <tbody>
                                                            @foreach ($credito->detalles as $detalle)
                                                                <tr>

                                                                    <td class="text-center" style="vertical-align: middle">
                                                                        {{ $detalle->numero_cuota }}</td>
                                                                    <td class="text-center" style="vertical-align: middle">
                                                                        {{ \Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d-m-Y') }}
                                                                    <td class="text-center" style="vertical-align: middle">
                                                                        @if ($detalle->fecha_pago)
                                                                            {{ \Carbon\Carbon::parse($detalle->fecha_pago)->format('d-m-Y') }}
                                                                        @else
                                                                            Impaga
                                                                        @endif

                                                                    </td>
                                                                    <td class="text-success text-center"
                                                                        style="vertical-align: middle">
                                                                        ${{ number_format($detalle->valor_cuota, 2, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-success text-center"
                                                                        style="vertical-align: middle">
                                                                        ${{ number_format($detalle->interes_mora, 2, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle">
                                                                        <span
                                                                            class="badge {{ $detalle->estado_cuota == 'Pendiente' ? 'bg-danger' : 'bg-success' }}">
                                                                            {{ $venta->estado_venta }}
                                                                        </span>
                                                                    </td>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body mt-2">
                                                <div class="d-flex"><label>Fecha: </label>
                                                    <p class="mb-0 mx-2">
                                                        {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex"><label>Total de Venta: </label>
                                                    <p class="mb-0 mx-2"> $
                                                        {{ number_format($venta->precio_venta, 2, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex"><label>Entrega: </label>
                                                    <p class="mb-0 mx-2"> $
                                                        {{ number_format($credito->entrega, 2, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex"><label>Total Financiado</label>
                                                    <p class="mb-0 mx-2"> $
                                                        {{ number_format($credito->valor_financiado, 2, ',', '.') }}</p>
                                                </div>
                                                <div class="d-flex"><label>Interés de Credito</label>
                                                    <p class="mb-0 mx-2">
                                                        {{ $credito->interes }} %</p>
                                                </div>
                                                <div class="d-flex"><label>Interés por Mora</label>
                                                    <p class="mb-0 mx-2">$
                                                        {{ $credito->total_interes }} %</p>
                                                </div>
                                                <div class="d-flex"><label>Cuotas:</label>
                                                    <p class="mb-0 mx-2">{{ $credito->cantidad_cuotas }} </p>
                                                </div>
                                                <div class="d-flex"><label>Total Cancelado</label>
                                                    <p class="mb-0 mx-2 text-green">$
                                                        {{ number_format($venta->total_pago, 2, ',', '.') }}</p>
                                                </div>
                                                <div class="d-flex"><label>Saldo de Crédito</label>
                                                    <p class="mb-0 mx-2 text-red">$
                                                        {{ number_format($credito->saldo_credito, 2, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Botones de acción -->
    <div class="card-footer text-right">
        <a href="{{ url('admin/ventas') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
@endsection

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
@endsection

@section('js')
    {{-- Aquí puedes agregar scripts adicionales --}}


    <script>
        $('#miTabla').DataTable({
            searching: false,
            lengthChange: false,
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
