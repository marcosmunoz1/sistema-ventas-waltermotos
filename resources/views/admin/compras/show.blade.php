         <!-- Modal editar el detalle de la moto -->
    <div class="modal" id="VerMotoModal" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header bg-warning text-white d-flex justify-content-center" >
                    <h4 class="modal-title text-center">
                        <i class="fa-solid fa-motorcycle"></i>
                        <span id="modalActionText">Editar</span> detalle de la moto  <i class="fa-solid fa-motorcycle"></i>
                    </h4>
                    <button type="button" class="close position-absolute" style="right: 20px" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline">
                                <div class="col-md-12 mx-auto mt-2">
                                    <div class="card card-info">
                                        <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                                                <!-- Datos de Moto -->
                                                <div class="row">
                                                    <!-- Primera Columna: Datos -->
                                                    <div class="col-md-9">
                                                        <!-- Fila 1 -->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Marca</label> <b style="color: red;">*</b>
                                                                <select class="form-control" name="id_marca" id="id_marca" required>
                                                                    <option value="">Seleccione una marca</option>
                                                                @foreach ($marcas as $marca )
                                                                    <option value="{{$marca->id}}" data-nombre_marca="{{ $marca->nombre_marca }}"
                                                                        {{ $marca->id == $motos->id_marca ? 'selected' : '' }}>{{$marca->nombre_marca}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Modelo</label> <b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->modelo_moto}}" name="modelo_moto" id="modelo_moto" class="form-control"
                                                                    placeholder="Modelo" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Dominio</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->dominio}}" name="dominio" id="dominio" class="form-control" required
                                                                    placeholder="Dominio">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                                <input type="number" value="{{$motos->cilindrada_moto}}" name="cilindrada_moto" id="cilindrada_moto" class="form-control" id="cilindrada"
                                                                    placeholder="Cilindrada" required>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 2 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-2">
                                                                <label>Color</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->color_moto}}" name="color_moto" id="color_moto" class="form-control"  placeholder="Color" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nacionalidad</label><b style="color: red;">*</b>
                                                                <select class="form-control" name="id_nacionalidad" id="id_nacionalidad" required>
                                                                    <option value="">Seleccione una Nacionalidad</option>
                                                                @foreach ($nacionalidades as $nacionalidad )
                                                                <option value="{{$nacionalidad->id}}" data-nombre_nacionalidad="{{ $nacionalidad->pais }}"
                                                                     {{ $nacionalidad->id == $motos->id_nacionalidad ? 'selected' : '' }}>{{$nacionalidad->pais}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Año</label><b style="color: red;">*</b>
                                                                <input type="number" value="{{$motos->anio_moto}}" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label><b style="color: red;">*</b>
                                                                <input type="number" value="{{$motos->km_moto}}" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check mt-4">
                                                                    <input class="form-check-input" value="{{$motos->es_usada}}" name="es_usada" id="es_usada" type="checkbox">
                                                                    <label class="form-check-label">¿Es usada?</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 3 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->nr_motor}}" name="nr_motor" id="nr_motor" class="form-control"  placeholder="Nro. Motor" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->nr_chasis}}" name="nr_chasis" id="nr_chasis" class="form-control" placeholder="Nro. Chasis" required>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 4 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label>D.N.R.P.A</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->dnrpa}}" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label><b style="color: red;">*</b>
                                                                <input type="text" value="{{$motos->nr_certificado}}" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                 <div class="mb-3">
                                                                        <label>Precio de Compra</label><b style="color: red;">*</b>
                                                                        <div class="input-group">
                                                                                <span class="input-group-text text-success">$</span>
                                                                            <input type="number" value="{{$motos->precio_compra}}" class="form-control text-success" name="precio_compra" id="precio_compra" required>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Precio de Venta</label><b style="color: red;">*</b>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text text-danger">$</span>
                                                                        <input type="number" name="precio_venta" value="{{$motos->precio_venta}}" id="precio_venta"
                                                                            class="form-control text-danger"
                                                                            value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deposito</label><b style="color: red;">*</b>
                                                                <select class="form-control" id="id_deposito" name="id_deposito" required>
                                                                    <option value="">Seleccione un Deposito</option>
                                                                    @foreach ($depositos as $deposito )
                                                                    <option value="{{$deposito->id}}"
                                                                        {{ $deposito->id == $motos->id_deposito ? 'selected' : '' }} required>
                                                                        {{$deposito->nombre_deposito}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Segunda Columna: Imagen -->
                                                   <div class="col-md-3">
                                                        <div class="text-center">
                                                            <div class="form-group">
                                                                <label for="imagen_moto">Imagen</label>
                                                                <input type="file" id="imagen_moto" name="imagen_moto"
                                                                    accept=".jpg, .jpeg, .png" class="form-control">
                                                                @error('imagen_moto')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <br>
                                                                <div id="image-container" class="mt-2">
                                                                    @if($motos->imagen_moto)
                                                                        <img src="{{ asset($motos->imagen_moto) }}" width="150" class="img-thumbnail mb-2">
                                                                        {{-- <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('eliminar_imagen').value = '1'">
                                                                            <i class="fas fa-trash"></i> Eliminar
                                                                        </button> --}}
                                                                    @else
                                                                        <div class="no-image-placeholder">
                                                                            <i class="fas fa-image fa-3x text-muted"></i>
                                                                            <p class="text-muted mt-2">No hay imagen</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" onclick="agregarMotoATabla()" class="btn btn-primary">
                                <i class="fas fa-save"></i> Editar moto</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancelar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
