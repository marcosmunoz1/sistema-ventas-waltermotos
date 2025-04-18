@extends('adminlte::page')

@section('title', 'Detalle Venta')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Ventas/<b>Ver-Detalle de Venta</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-user"></i> Cliente </h6>
                        </div>
                        <div class="card-body">
                            <h6><strong>Cliente: </strong> {{ $cliente->apellido_cliente }},
                                {{ $cliente->nombre_cliente }}
                            </h6>
                            <h6><strong>Email: </strong> {{ $cliente->email_cliente }}</h6>
                            <h6><strong>CUIT: </strong> {{ $cliente->cuit_cliente }}</h6>
                            <h6><strong>DNI: </strong> {{ $cliente->dni_cliente }}</h6>
                            <h6><strong>Fecha Nacimienot: </strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}</h6>
                            <h6><strong>Telefono: </strong> {{ $cliente->celular_cliente }}</h6>
                            <h6><strong>Estado Civil: </strong> {{ $cliente->estado_civil_cliente }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-user-friends"></i> Conyuge </h6>
                        </div>
                        <div class="card-body">
                            <div class="mx-2 mt-2">
                                <h6><strong>Conyugue:</strong>
                                    {{ $cliente->conyugue->apellido_conyugue }},
                                    {{ $cliente->conyugue->nombre_conyugue }}
                                </h6>
                                <h6><strong>DNI:</strong> {{ $cliente->conyugue->dni_conyugue }}</h6>
                                <h6><strong>Fecha Nacimiento:</strong>
                                    {{ \Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('d-m-Y') }}
                                </h6>                  
                                <h6><strong>Teléfono:</strong>
                                    {{ $cliente->conyugue->celular_conyugue }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-file-invoice-dollar"></i>
                                Valores </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <label>Fecha: </label>
                                <p class="mb-0 mx-2">{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}
                                </p>
                            </div>
                            <div class="d-flex">
                                <label>Total: </label>
                                <p class="mb-0 mx-2"> $ {{ number_format($venta->precio_venta, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h6 class="text-center text-info"><i class="fas fa-motorcycle"></i>
                                Moto </h6>
                        </div>
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
                                        <h6><strong>Cilindradas:</strong> {{ $moto->cilindrada_moto }}cc</span> </h6>
                                        <h6><strong>Nacionalidad:</strong> {{ $moto->nacionalidad->pais }} </h6>
                                        <h6><strong>Km:</strong> {{ $moto->km_moto }}km. </h6>
                                    </div>
                                    <div class="col-5">
                                        <h6><strong>DNRPA:</strong> {{ $moto->dnrpa }}</span> </h6>
                                        <h6><strong>Nro. Certificado:</strong> {{ $moto->nr_certificado }}</span></h6>
                                        <h6><strong>Nro. Motor:</strong> {{ $moto->nr_motor }}</span> </h6>
                                        <h6><strong>Nro. Chasis:</strong> {{ $moto->nr_chasis }}</span> </h6>
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
        </div>
    </div>
@endsection

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
@endsection

@section('js')
    {{-- Aquí puedes agregar scripts adicionales --}}

@endsection
