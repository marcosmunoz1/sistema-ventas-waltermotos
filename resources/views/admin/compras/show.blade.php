@extends('layouts.app')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-info mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Compras/<b>Detalle de Compra</b> </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" class="form-control"
                                        value="{{ $compra->proveedor->nombre_proveedor }}" id="nombre_proveedor" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Factura</label>
                                    <input type="text" value="{{ $compra->numero_factura }}" class="form-control"
                                        id="numero_factura" name="numero_factura" placeholder="Nr. de factura" disabled>
                                    @error('numero_factura')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="text" value="{{ $compra->numero_remito }}" class="form-control"
                                        id="numero_remito" name="numero_remito" placeholder="Nr. de remito" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha compra</label>
                                    <input type="date" value="{{ $compra->fecha_compra }}" name="fecha_compra"
                                        id="fecha_compra" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado_compra">Estado</label>
                                    <select class="form-control" name="estado_compra" disabled>
                                        <option value="">-- Seleccionar estado --</option>
                                        <option value="Pagado" {{ $compra->estado_compra == 'Pagado' ? 'selected' : '' }}>
                                            Pagado</option>
                                        <option value="Pendiente"
                                            {{ $compra->estado_compra == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    </select>
                                    @error('estado_compra')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm" id="tabla-motos">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="width: 5%">#</th>
                                            <th class="text-center" style="width: 10%">Marca</th>
                                            <th class="text-center" style="width: 10%">Modelo</th>
                                            {{-- <th class="text-center" style="width: 10%">Cilindrada</th> --}}
                                            <th class="text-center" style="width: 10%">Color</th>
                                            <th class="text-center" style="width: 5%">Año</th>
                                            <th class="text-center" style="width: 15%">Precio Compra</th>
                                            <th class="text-center" style="width: 10%">Condicion</th>
                                            <th class="text-center" style="width: 5%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 1; ?>
                                        @foreach ($compra->motos as $moto)
                                            <tr data-id="{{ $moto->id }}" data-imagen="{{ asset($moto->imagen_moto) }}"
                                                data-cilindrada="{{ $moto->cilindrada_moto }}"
                                                data-nr-motor="{{ $moto->nr_motor }}"
                                                data-nr-chasis="{{ $moto->nr_chasis }}"
                                                data-certificado="{{ $moto->nr_certificado }}"
                                                data-dnrpa="{{ $moto->dnrpa }}" data-km_moto="{{ $moto->km_moto }}"
                                                data-id_nacionalidad="{{ $moto->id_nacionalidad }}"
                                                data-nacionalidad="{{ $moto->nacionalidad->pais ?? 'N/D' }}"
                                                data-precio_venta="{{ $moto->precio_venta }}"
                                                data-condicion="{{ $moto->condicion }}">
                                                <td style="text-align: center">{{ $contador++ }}</td>
                                                <td class="marca-moto" style="text-align: center">
                                                    {{ $moto->marca->nombre_marca }}</td>
                                                <td class="modelo-moto" style="text-align: center">{{ $moto->modelo_moto }}
                                                </td>
                                                {{--    <td class="dominio-moto" style="text-align: center">{{ $moto->dominio }}
                                                </td> --}}
                                                <td class="color-moto" style="text-align: center">{{ $moto->color_moto }}
                                                </td>
                                                <td class="anio-moto" style="text-align: center">{{ $moto->anio_moto }}
                                                </td>
                                                <td class="precio_compra-moto" style="text-align: center">
                                                    ${{ number_format($moto->precio_compra, 2, ',', '.') }}</td>
                                                {{--  <td style="text-align: center">{{ $moto->cilindrada_moto }}cc</td> --}}
                                                <td class="text-center" style="vertical-align: middle">
                                                    @php
                                                        $colores = [
                                                            'vendida' => 'danger',
                                                            'en_stock' => 'success',
                                                            'garantia' => 'warning',
                                                            'devuelta' => 'secondary',
                                                        ];
                                                        $color = $colores[$moto->condicion] ?? 'light';
                                                    @endphp
                                                    <span class="badge bg-{{ $color }}">
                                                        {{ ucfirst(str_replace('_', ' ', $moto->condicion)) }}
                                                    </span>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <button style="text-align: center" type="button"
                                                        class="btn btn-info btn-sm" data-toggle="modal" title="Ver moto"
                                                        data-target="#VerMotoModal"
                                                        onclick="verMoto({{ $moto->id }})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <h3 class="fw-bold text-secondary">
                                    TOTAL:
                                    <span id="total_compra" class="ms-2">
                                        ${{ number_format($compra->total_compra, 2, ',', '.') }}
                                    </span>
                                </h3>
                            </div>
                        </div>

                    </div>

                    <!-- Botones de acción -->
                    <div class="card-footer text-right">
                        <a href="{{ url('/admin/compras/' . $compra->id . '/edit') }}" class="btn btn-warning"><i
                                class="fas fa-pencil"></i> Editar Compra</a>
                        @if (request('from') === 'motos')
                            <a href="{{ url('admin/motos') }}" class="btn btn-secondary"> <i
                                    class="fas fa-arrow-left"></i>Volver</a>
                        @else
                            <a href="{{ url('admin/compras') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ver Moto -->
    <div class="modal fade" id="VerMotoModal" tabindex="-1" role="dialog" aria-labelledby="VerMotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="VerMotoModalLabel">Detalles de la Moto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenido-ver-moto">
                    <!-- Aquí se inyecta el contenido dinámico -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal ver moto -->
@stop
@section('css')
@stop

@section('js')
    <script>
        function verMoto(id) {
            const fila = document.querySelector(`tr[data-id='${id}']`);
            if (!fila) {
                console.error("No se encontró la fila de la moto ID: " + id);
                return;
            }

            const marca = fila.querySelector('.marca-moto')?.innerText || 'N/A';
            const modelo = fila.querySelector('.modelo-moto')?.innerText || 'N/A';
            const color = fila.querySelector('.color-moto')?.innerText || 'N/A';
            const dominio = fila.querySelector('.dominio-moto')?.innerText || 'N/A';
            const anio = fila.querySelector('.anio-moto')?.innerText || 'N/A';
            const precio_compra = fila.querySelector('.precio_compra-moto')?.innerText || 'N/A';
            const precio_venta = fila.dataset.precio_venta || 'N/A';
            const imagenUrl = fila.dataset.imagen;
            const cilindrada = fila.dataset.cilindrada || '';
            const nrMotor = fila.dataset.nrMotor || '';
            const nrChasis = fila.dataset.nrChasis || '';
            const certificado = fila.dataset.certificado || 'N/A';
            const dnrpa = fila.dataset.dnrpa || 'N/A';
            const km_moto = fila.dataset.km_moto || '';
            const condicion = fila.dataset.condicion || '';
            const nacionalidad = fila.dataset.nacionalidad || 'N/D';

            const mapCondiciones = {
                vendida: "Vendida",
                en_stock: "En stock",
                garantia: "Garantía",
                devuelta: "Devuelta"
            };

            // Si existe en el diccionario, usa el valor, si no, deja el original con espacios bonitos
            let condicionFormateada = mapCondiciones[condicion] ||
                condicion.replace(/_/g, " ").replace(/\b\w/g, c => c.toUpperCase());
            const contenido = `
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Marca:</strong> ${marca}</p>
                        <p><strong>Modelo:</strong> ${modelo}</p>
                        <p><strong>Color:</strong> ${color}</p>
                        <p><strong>Dominio:</strong> ${dominio}</p>
                        <p><strong>Año:</strong> ${anio}</p>
                        <p><strong>Precio compra:</strong> ${precio_compra}</p>
                        <p><strong>Nacionalidad:</strong> ${nacionalidad}</p>

                    </div>
                    <div class="col-md-4">
                        <p><strong>Precio venta:</strong> $${precio_venta}</p>
                        <p><strong>Cilindrada:</strong> ${cilindrada}cc</p>
                        <p><strong>Nr de motor:</strong> ${nrMotor}</p>
                        <p><strong>Nr de chasis:</strong> ${nrChasis}</p>
                        <p><strong>Certificado:</strong> ${certificado}</p>
                        <p><strong>DNRPA:</strong> ${dnrpa}</p>
                        <p><strong>Condición:</strong> ${condicionFormateada}</p>
                    </div>
                    <div class="col-md-4">
                        ${imagenUrl ? `<img src="${imagenUrl}" class="img-fluid img-thumbnail mt-2" style="max-width: 200px;">` : '<p><em>Sin imagen</em></p>'}
                    </div>
                </div>

            `;

            document.getElementById('contenido-ver-moto').innerHTML = contenido;
        }
    </script>
@stop
