@extends('adminlte::page')

@section('title', 'Cobrar Cuotas')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Credito/<b>Cobrar-Cuotas</b></h2>
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
                                            <th class="text-center" style="width: 5%">Estado</th>
                                            <th class="text-center" style="width: 5%">Cobrar</th>


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
                                                        {{ \Carbon\Carbon::parse(detalle->fecha_pago)->format('d-m-Y') }}
                                                    @else
                                                        Impaga
                                                    @endif
                                                    {{ $detalle->fecha_pago }}
                                                </td>
                                                <td class="text-success text-center" style="vertical-align: middle">
                                                    ${{ number_format($detalle->valor_cuota, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <span
                                                        class="badge {{ $detalle->estado_cuota == 'Pendiente' ? 'bg-danger' : 'bg-success' }}">
                                                        {{ $credito->venta->estado_venta }}
                                                    </span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <input type="checkbox" class="fila-check" value="{{ $detalle->id }}"
                                                        data-numero-cuota="{{ $detalle->numero_cuota }}"
                                                        data-valor-cuota="{{ $detalle->valor_cuota }}">
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-footer text-center">
                            <h5 class="text-center text-success"><i class="fa-solid fa-hand-holding-dollar"></i>
                                Pago de Cuotas
                            </h5>
                        </div>
                        <div class="form">
                            <input type="hidden" name="cuotasSeleccionadas" id="cuotasSeleccionadas">


                            <div class="mx-2 mt-2 mb-2">
                                <!-- Campo Fecha -->
                                <div class="">
                                    <div class="input-group">
                                        <span class="input-group-text">Fecha:</span>
                                        <input type="date" id="fecha" name="fecha"
                                            value="{{ old('fecha', date('Y-m-d')) }}" class="form-control" required>
                                        @error('fecha')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Monto a pagar -->
                                <div class="">
                                    <div class="input-group">
                                        <span class="input-group-text">Valor a Cancelar: $</span>
                                        <input type="number" id="precioTotal" name="precioTotal"
                                            class="form-control text-danger" readonly>
                                    </div>
                                    @error('precioTotal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Corresponde a Cuotas:</span>
                                    <input type="text" id="cuotas" name="cuotas" class="form-control" readonly>
                                </div>
                                
                                
                                <div class="input-group">
                                    <span class="input-group-text">Interes:</span>
                                    <input type="number" id="interes" name="interes" class="form-control">
                                    <span class="input-group-text"
                                        style="width: 120px; display: inline-block;  text-align: left;">%</span>
                                </div>
                                <hr>
                                <div class="input-group">
                                    <span class="input-group-text">TOTAL:</span>
                                    <input type="number" id="total" name="total" class="form-control">
                                </div>

                               <!-- Botones de acción -->
                               <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Cobrar
                                </button>
                               
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
    <script>
        const checkboxes = document.querySelectorAll('.fila-check');
        const totalInput = document.getElementById('precioTotal');
        const inputCuotas = document.getElementById('cuotasSeleccionadas');
        const cuotasInput = document.getElementById('cuotas');
        const interesInput = document.getElementById('interes');
        const totalConInteresInput = document.getElementById('total');
    
        let cuotasSeleccionadas = [];
    
        // Función para calcular total con interés
        function actualizarTotalConInteres() {
            const subtotal = parseFloat(totalInput.value) || 0;
            const interes = parseFloat(interesInput.value) || 0;
            const totalFinal = subtotal + (subtotal * interes / 100);
            totalConInteresInput.value = totalFinal.toFixed(2);
        }
    
        // Escuchar cambios en el campo de interés
        interesInput.addEventListener('input', actualizarTotalConInteres);
    
        // Escuchar cambios en los checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const id = this.value;
                const numero_cuota = this.dataset.numeroCuota;
                const valor_cuota = parseFloat(this.dataset.valorCuota);
    
                if (this.checked) {
                    // Agregar cuota seleccionada
                    cuotasSeleccionadas.push({
                        id,
                        numero_cuota,
                        valor_cuota
                    });
                } else {
                    // Eliminar cuota desmarcada
                    cuotasSeleccionadas = cuotasSeleccionadas.filter(cuota => cuota.id !== id);
                }
    
                // Calcular total sin interés
                const total = cuotasSeleccionadas.reduce((sum, cuota) => sum + cuota.valor_cuota, 0);
                totalInput.value = total.toFixed(2);
    
                // Mostrar número de cuotas seleccionadas (ej: "1, 2, 5")
                const numeros = cuotasSeleccionadas.map(cuota => cuota.numero_cuota);
                cuotasInput.value = numeros.join(', ');
    
                // Guardar selección en input hidden
                inputCuotas.value = JSON.stringify(cuotasSeleccionadas);
    
                // Actualizar total con interés
                actualizarTotalConInteres();
            });
        });
    </script>
    


@endsection
