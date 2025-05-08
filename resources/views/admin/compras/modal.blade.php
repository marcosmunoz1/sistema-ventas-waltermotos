      <!-- Modal para agregar detalle de la moto -->
      <div class="modal" id="crearMotoModal" tabindex="-1" aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-file-alt"></i> Agregar detalle de la moto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-success">
                                {{-- <div class="card-header">
                                    <h5 class="text-center text-success"><i class="fas fa-motorcycle"></i> Datos de la Moto</h5>
                                </div> --}}

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
                                                                <label>Marca</label> <b style="color: red;">*</b>
                                                                <select class="form-control" name="id_marca" id="id_marca" required>
                                                                    @foreach ($marcas as $marca )
                                                                    <option value="{{$marca->id}}">{{$marca->nombre_marca}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Modelo</label> <b style="color: red;">*</b>
                                                                <input type="text" name="modelo_moto" id="modelo_moto" class="form-control"
                                                                    placeholder="Modelo" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Dominio</label><b style="color: red;">*</b>
                                                                <input type="text" name="dominio" id="dominio" class="form-control" required
                                                                    placeholder="Dominio">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Cilindrada</label><b style="color: red;">*</b>
                                                                <input type="number" name="cilindrada_moto" id="cilindrada_moto" class="form-control" id="cilindrada"
                                                                    placeholder="Cilindrada" required>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 2 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-2">
                                                                <label>Color</label>
                                                                <input type="text" name="color_moto" id="color_moto" class="form-control"  placeholder="Color">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nacionalidad</label>
                                                                <select class="form-control" name="id_nacionalidad" id="id_nacionalidad">
                                                                @foreach ($nacionalidades as $nacionalidad )
                                                                <option value="{{$nacionalidad->id}}">{{$nacionalidad->pais}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Año</label>
                                                                <input type="number" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label>
                                                                <input type="number" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check mt-4">
                                                                    <input class="form-check-input" name="es_usada" id="es_usada" type="checkbox" required>
                                                                    <label class="form-check-label">¿Es usada?</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 3 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label>Nro. Motor</label><b style="color: red;">*</b>
                                                                <input type="text" name="nr_motor" id="nr_motor" class="form-control"  placeholder="Nro. Motor" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Nro. Chasis</label><b style="color: red;">*</b>
                                                                <input type="text" name="nr_chasis" id="nr_chasis" class="form-control" placeholder="Nro. Chasis" required>
                                                            </div>
                                                        </div>
                                                        <!-- Fila 4 -->
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label>D.N.R.P.A</label>
                                                                <input type="text" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label>
                                                                <input type="text" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <label>Precio compra</label>
                                                                <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio compra" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Precio venta</label>
                                                                <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio venta" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>Deposito</label>
                                                            <select class="form-control" id="id_deposito" name="id_deposito" required>
                                                                @foreach ($depositos as $deposito )
                                                                <option value="{{$deposito->id}}" required>{{$deposito->nombre_deposito}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        </div>
                                                    </div>

                                                    <!-- Segunda Columna: Imagen -->
                                                    <div class="col-md-3">
                                                        <div class="text-center">
                                                            <div class="form-group">
                                                                <label for="imagen">Imagen</label>
                                                                <input type="file" id="imagen_moto" name="imagen_moto"
                                                                    accept=".jpg, jpeg, png" class="form-control">
                                                                @error('imagen_moto')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                                <br>
                                                                <center><output id="list"></output></center>
                                                                <script>
                                                                    function archivo(evt){
                                                                    var files = evt.target.files; //file List objet
                                                                    //Obtenemos la imagen del campo "file"
                                                                    for(var i = 0, f; f = files[i]; i++ ){
                                                                        //solo admitimos imagenes
                                                                        if(!f.type.match('image.*')){
                                                                            continue;
                                                                        }
                                                                        var reader = new FileReader();
                                                                        reader.onload = (function (theFile){
                                                                            return function (e) {
                                                                                //insertamos la imagen
                                                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbail" src="',e.target.result,'" width="70%" title="',escape(theFile.name),'"/>'].join('');
                                                                            };
                                                                        })(f);
                                                                        reader.readAsDataURL(f);

                                                                    }

                                                                    }
                                                                    document.getElementById('imagen_moto').addEventListener('change', archivo, false);
                                                            </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-agregar-moto" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar moto</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancelar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
