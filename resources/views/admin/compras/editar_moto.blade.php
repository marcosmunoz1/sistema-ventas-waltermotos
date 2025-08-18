@extends('adminlte::page')

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
                <form action="{{ route('compras.motos.update', ['compraId' => $compra->id, 'motoId' => $moto->id]) }}" method="POST">                    @csrf
                    @method('PUT')
                    <div class="col-md-12 mx-auto mt-2">
                        <div class="card card-info">
                            <div
                                class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">

                                <!-- Datos de Moto -->
                                <div class="row">
                                    <!-- Primera Columna: Datos -->
                                    <div class="col-md-9">
                                        <!-- Fila 1 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Marca </label><b style="color: red;">*</b>
                                                    <select name="marca" id="" class="form-control" required>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{ $marca->nombre_marca }}"
                                                                {{ $marca->id == $moto->nombre_marca ? 'selected' : '' }}>
                                                                {{ $marca->nombre_marca }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Modelo</label> <b style="color: red;">*</b>
                                                <input type="text" name="modelo" class="form-control" required
                                                    value="{{ $moto->modelo_moto }}" placeholder="Modelo">
                                                @error('modelo')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label>Dominio</label><b style="color: red;">*</b>
                                                <input name="dominio" type="text" class="form-control" required
                                                    value="{{ $moto->dominio }}" placeholder="Dominio">
                                                @error('dominio')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                <input type="number" name="cilindrada" class="form-control" id="cilindrada"
                                                    required value="{{ $moto->cilindrada_moto }}"
                                                    placeholder="Cilindradas cc.">
                                                @error('cilindrada')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Fila 2 -->
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label>Color</label>
                                                <input name="color" type="text" class="form-control"
                                                    placeholder="Color" value="{{ $moto->color_moto }}">
                                                @error('color')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nacionalidad</label>
                                                <select name="nacionalidad" id="" class="form-control" required>
                                                    @foreach ($nacionalidades as $nacionalidad)
                                                        <option value="{{ $nacionalidad->id }}"
                                                            {{ $nacionalidad->id == $moto->id_nacionalidad ? 'selected' : '' }}>
                                                            {{ $nacionalidad->pais }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Año</label>
                                                <input name="anio" type="number" class="form-control" placeholder="Año"
                                                    value="{{ $moto->anio_moto }}">
                                                @error('anio')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label>Km</label>
                                                <input name="km" type="number" class="form-control"
                                                    placeholder="Kilometraje" value="{{ old('km', $moto->km_moto) }}">
                                                @error('km')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="esUsada"
                                                        {{ $moto->es_usada == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">¿Es usada?</label>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Fila 3 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                <input name="motor" type="text" class="form-control"
                                                    placeholder="Nro. Motor" value="{{ $moto->nr_motor }}">
                                                @error('motor')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                <input name="chasis" type="text" class="form-control"
                                                    placeholder="Nro. Chasis" required value="{{ $moto->nr_chasis }}">
                                                @error('chasis')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Fila 4 -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>D.N.R.P.A</label>
                                                <input name="dnrpa" type="text" class="form-control"
                                                    placeholder="Nro. DNRPA" value="{{ $moto->dnrpa }}">
                                                @error('dnrpa')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Certificado</label>
                                                <input name="certificado" type="text" class="form-control"
                                                    placeholder="Nro. Certificado" value="{{ $moto->nr_certificado }}">
                                                @error('certificado')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Segunda Columna: Imagen -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <input type="file" id="file" name="imagen"
                                                    accept=".jpg, jpeg, png" class="form-control">
                                                @error('imagen')
                                                    <small style="color: red;">{{ $message }}</small>
                                                @enderror
                                                <br>
                                                <center>
                                                    <output id="list">
                                                        <img src="{{ asset($moto->imagen_moto) }}"
                                                            width="100%" alt="">
                                                    </output>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fila 4 -->
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label>Precio de Compra</label>
                                            <div class="input-group">
                                                    <span class="input-group-text text-success">$</span>
                                                  <input type="text" class="form-control text-success"
                                                value="{{ number_format($moto->precio_compra, 2, ',', '.') }}" disabled>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label>Precio de Venta</label>
                                            <div class="input-group">
                                                <span class="input-group-text text-danger">$</span>
                                                <input name="precio_venta" type="text"
                                                    class="form-control text-danger"
                                                    value="{{ number_format($moto->precio_venta, 2, ',', '.') }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Deposito </label>
                                            <select name="deposito" id="" class="form-control" required>
                                                @foreach ($depositos as $deposito)
                                                    <option value="{{ $deposito->id }}"
                                                        {{ $deposito->id == $moto->id_deposito ? 'selected' : '' }}>
                                                        {{ $deposito->nombre_deposito }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning"><i class="fa-solid fa-file-arrow-up"></i>
                                Actualizar
                            </button>
                            <a href="{{ route('admin.compras.edit', $compra->id) }}" class="btn btn-secondary">Volver a la compra</a>
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
