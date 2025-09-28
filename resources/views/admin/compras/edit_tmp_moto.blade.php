@extends('layouts.app')

@section('title', 'Editar Moto')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Admin/Compras/<b>Editar-Moto</b></h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifique los Datos</h3>
                    {{-- <div class="card-tools">
                        <a href="{{url('admin/roles/crear-rol')}}" class="btn btn-success"><i class="fas fa-save"></i>  Agregar Rol</a>
                    </div> --}}
                </div>
               <form action="{{ route('compras.temporales.motos.update', ['motoId' => $moto->id]) }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12 mx-auto mt-2">
                        <div class="card card-info">
                            <div class="card-body">

                                <!-- Datos de Moto -->
                                <div class="row">
                                    <!-- Primera Columna -->
                                    <div class="col-md-9">
                                        <!-- Fila 1 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Marca</label><b style="color: red;">*</b>
                                                    <select class="form-control" name="id_marca" id="id_marca">
                                                        <option value="">Seleccione una marca</option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{ $marca->id }}"
                                                                {{ old('id_marca', $moto->id_marca ?? '') == $marca->id ? 'selected' : '' }}>
                                                                {{ $marca->nombre_marca }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Modelo</label><b style="color: red;">*</b>
                                                <input type="text" name="modelo_moto" class="form-control"
                                                    value="{{ $moto->modelo_moto }}" placeholder="Modelo" required>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Dominio</label>
                                                <input name="dominio" type="text" class="form-control"
                                                    value="{{ $moto->dominio }}" placeholder="Dominio">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                <input type="number" name="cilindrada_moto" class="form-control"
                                                    value="{{ $moto->cilindrada_moto }}" placeholder="Cilindradas cc." required>
                                            </div>
                                        </div>

                                        <!-- Fila 2 -->
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label>Color</label>
                                                <input name="color_moto" type="text" class="form-control"
                                                    placeholder="Color" value="{{ $moto->color_moto }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nacionalidad</label><b style="color: red;">*</b>
                                                <select name="id_nacionalidad" class="form-control" required>
                                                    @foreach ($nacionalidades as $nacionalidad)
                                                        <option value="{{ $nacionalidad->id }}"
                                                            {{ $nacionalidad->id == $moto->id_nacionalidad ? 'selected' : '' }}>
                                                            {{ $nacionalidad->pais }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Año</label>
                                                <input name="anio_moto" type="number" class="form-control"
                                                    value="{{ $moto->anio_moto }}" placeholder="Año">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Km</label>
                                                <input name="km_moto" type="number" class="form-control"
                                                    value="{{ $moto->km_moto }}" placeholder="Kilometraje">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" name="es_usada"
                                                        {{ $moto->es_usada == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">¿Es usada?</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fila 3 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                <input name="nr_motor" type="text" class="form-control"
                                                    value="{{ $moto->nr_motor }}" placeholder="Nro. Motor" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                <input name="nr_chasis" type="text" class="form-control"
                                                    value="{{ $moto->nr_chasis }}" placeholder="Nro. Chasis" required>
                                            </div>
                                        </div>

                                        <!-- Fila 4 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>D.N.R.P.A</label>
                                                <input name="dnrpa" type="text" class="form-control"
                                                    value="{{ $moto->dnrpa }}" placeholder="Nro. DNRPA">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Certificado</label>
                                                <input name="nr_certificado" type="text" class="form-control"
                                                    value="{{ $moto->nr_certificado }}" placeholder="Nro. Certificado">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Segunda Columna: Imagen -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <input type="file" id="file" name="imagen_moto" accept=".jpg,.jpeg,.png" class="form-control">
                                                <br>
                                                <center>
                                                    <output id="list">
                                                        <img src="{{ asset($moto->imagen_moto) }}" width="100%" alt="">
                                                    </output>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila precios -->
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label>Precio de Compra</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-success">$</span>
                                            <input name="precio_compra" type="text" class="form-control text-success"
                                                value="{{ number_format($moto->precio_compra, 2, ',', '.') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Precio de Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-danger">$</span>
                                            <input name="precio_venta" type="text" class="form-control text-danger"
                                                value="{{ number_format($moto->precio_venta, 2, ',', '.') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Depósito</label>
                                        <select name="id_deposito" class="form-control" required>
                                            @foreach ($depositos as $deposito)
                                                <option value="{{ $deposito->id }}"
                                                    {{ $deposito->id == $moto->id_deposito ? 'selected' : '' }}>
                                                    {{ $deposito->nombre_deposito }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-file-arrow-up"></i> Actualizar
                            </button>
                             <a href="{{ route('admin.compras.create') }}" class="btn btn-secondary mx-1"><i
                                class="fas fa-times"></i>
                                Cancelar
                              </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

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
@stop
