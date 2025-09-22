@extends('adminlte::page')
@extends('layouts.app')
@section('title', 'Abregar Moto') 

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Motos/<b>Agregar-Moto</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h5 class="text-center text-success"><i class="fas fa-motorcycle"></i> Datos de la Moto</h5>
                </div>

                <div class="col-md-12 mx-auto mt-2">
                    <div class="card card-info">
                        <div
                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                            <form action="{{ url('/admin/motos/crear-moto') }}" method="post">
                                @csrf
                                <!-- Datos de Moto -->
                                <div class="row">
                                    <!-- Primera Columna: Datos -->
                                    <div class="col-md-9">
                                        <!-- Fila 1 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Marca</label> <b style="color: red;">*</b>
                                                <select class="form-control" required>
                                                    <option selected disabled>Seleccionar</option>
                                                    <option value="Honda">Honda</option>
                                                    <option value="Yamaha">Yamaha</option>
                                                    <option value="Suzuki">Suzuki</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Modelo</label> <b style="color: red;">*</b>
                                                <input type="text" class="form-control" placeholder="Modelo" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Dominio</label><b style="color: red;">*</b>
                                                <input type="text" class="form-control" required placeholder="Dominio">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                <input type="number" class="form-control" id="cilindrada"
                                                    placeholder="Cilindrada" required>
                                            </div>
                                        </div>
                                        <!-- Fila 2 -->
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label>Color</label>
                                                <input type="text" class="form-control" placeholder="Color">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nacionalidad</label>
                                                <select class="form-control">
                                                    <option selected disabled>Seleccionar nacionalidad
                                                    </option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Brasil">Brasil</option>
                                                    <option value="Japón">Japón</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Año</label>
                                                <input type="number" class="form-control" placeholder="Año">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Km</label>
                                                <input type="number" class="form-control" placeholder="Kilometraje">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="esUsada">
                                                    <label class="form-check-label">¿Es usada?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fila 3 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                <input type="text" class="form-control" placeholder="Nro. Motor"
                                                    required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                <input type="text" class="form-control" placeholder="Nro. Chasis"
                                                    required>
                                            </div>
                                        </div>
                                        <!-- Fila 4 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>D.N.R.P.A</label>
                                                <input type="text" class="form-control" placeholder="Nro. DNRPA">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Certificado</label>
                                                <input type="text" class="form-control" placeholder="Nro. Certificado">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Segunda Columna: Imagen -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <input type="file" id="file" name="imagen" accept=".jpg, jpeg, png"
                                                    class="form-control">
                                                @error('imagen')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                                <br>
                                                <center><output id="list"></output></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>



                    <div class="row">
                        <!-- Datos de Compra -->
                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="text-center text-success mt-2"><i class="fas fa fa-truck"></i> Datos del Compra
                                </h5>
                                <div
                                    class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                    <div class="row">
                                        <!-- Primera Columna -->
                                        <div class="col-md-12 mb-3">
                                            <label for="nroFactura" class="form-label">Proveedor</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="nroFactura"
                                                    placeholder="Proveedor">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="btnVerFactura">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Segunda Columna -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fechaIngreso" class="form-label">Fecha de Ingreso
                                                    *</label>
                                                <input type="date" class="form-control" id="fechaIngreso" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="precioCompra" class="form-label">Precio de Compra
                                                    *</label>
                                                <input type="number" class="form-control" id="precioCompra" required>
                                            </div>
                                        </div>
                                        <!-- tercera Columna -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="precioCompra" class="form-label">Número de Remito
                                                    *</label>
                                                <input type="number" class="form-control" id="precioCompra" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="nroFactura" class="form-label">Nro. de
                                                        Factura</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="nroFactura"
                                                            placeholder="Nro. de Factura">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="btnVerFactura">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Datos de Venta -->
                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="text-center text-success mt-2"><i class="fas fa fa-cash-register"></i> Datos
                                    del Venta</h5>
                                <div
                                    class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }} ">
                                    <div class="row">
                                        <!-- Primera Columna -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="nroFactura" class="form-label">Cliente</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nroFactura"
                                                        placeholder="Cliente">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="btnVerFactura">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Segunda Columna -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fechaIngreso" class="form-label">Fecha de Egreso
                                                    *</label>
                                                <input type="date" class="form-control" id="fechaIngreso" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="precioCompra" class="form-label">Precio de Venta
                                                    *</label>
                                                <input type="number" class="form-control" id="precioCompra" required>
                                            </div>
                                        </div>
                                        <!-- tercera Columna -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="precioCompra" class="form-label">Número de Remito
                                                    *</label>
                                                <input type="number" class="form-control" id="precioCompra" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nroFactura" class="form-label">Nro. de
                                                    Factura</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nroFactura"
                                                        placeholder="Nro. de Factura">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="btnVerFactura">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
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
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Registrar
                        </button>
                        <a href="{{ url('admin/motos') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>

                    </form> <!-- Cierre correcto del formulario -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
@endsection

@section('js')
    {{-- Aquí puedes agregar scripts adicionales --}}

    <script>
        document.getElementById('file').addEventListener('change', archivo, false);

        function archivo(evt) {
            var files = evt.target.files; // FileList object
            var list = document.getElementById("list");
            list.innerHTML = ''; // Limpiamos el contenedor

            for (var i = 0, f; f = files[i]; i++) {
                // Solo admitimos imágenes
                if (!f.type.match('image.*')) {
                    console.log('Archivo no permitido:', f.type);
                    continue;
                }

                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        list.innerHTML = [
                            '<img class="thumb thumbnail" src="', e.target.result,
                            '"width="100%" title="', escape(theFile.name), '"/>'
                        ].join('');

                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
    </script>
@endsection
