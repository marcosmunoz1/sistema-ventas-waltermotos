@extends('adminlte::page')

@section('title', 'Detalle Credito')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Ver-Detalle de Credito</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
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
                                            <th class="text-center" style="width: 5%">Interes x Mora</th>
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
                                                <td class="text-success text-center" style="vertical-align: middle">
                                                    ${{ number_format($detalle->valor_cuota, 2, ',', '.') }}
                                                </td>
                                                <td class="text-success text-center" style="vertical-align: middle">
                                                    ${{ number_format($detalle->interes_mora, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge {{ $detalle->estado_cuota == 'Pendiente' ? 'bg-danger' : 'bg-success' }}">
                                                        {{ $detalle->estado_cuota }}
                                                    </span>
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
                                    {{ \Carbon\Carbon::parse($credito->venta->fecha_venta)->format('d-m-Y') }}
                                </p>
                            </div>
                            <div class="d-flex"><label>Total de Venta: </label>
                                <p class="mb-0 mx-2"> $
                                    {{ number_format($credito->venta->precio_venta, 2, ',', '.') }}
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
                            <div class="d-flex"><label>Interés de Credito:</label>
                                <p class="mb-0 mx-2">{{ $credito->interes }} %</p>
                            </div>
                            <div class="d-flex"><label>Cuotas:</label>
                                <p class="mb-0 mx-2">{{ $credito->cantidad_cuotas }} </p>
                            </div>
                            <div class="d-flex"><label>Interés por Mora:</label>
                                <p class="mb-0 mx-2 text-warning">$
                                    {{ number_format($credito->total_interes, 2, ',', '.') }}</p>
                                    
                            </div>
                            <div class="d-flex"><label>Total Cancelado</label>
                                <p class="mb-0 mx-2 text-green">$
                                    {{ number_format($credito->venta->total_pago, 2, ',', '.') }}</p>
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
    <!-- Botones de acción -->
    <div class="card-footer text-right">
        <a href="{{ url('admin/creditos') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>


@endsection

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
    <style>
        .input-group-text {
            width: 50%;
            display: inline-block;
            text-align: right;
        }
    </style>

@endsection

@section('js')
    {{-- Aquí puedes agregar scripts adicionales --}}

@endsection
