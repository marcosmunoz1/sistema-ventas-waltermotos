@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Compras/<b>Cargar-Compra</b></h2>
    <hr>
@endsection

@section('content')
<form action="{{ url('/admin/compras/cargar-compra') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <div class="card-title">Datos de Compra </div>
                </div>
                    <div class="card-body">

                         <div class="row">
                            <div class="col-md-5">
                                <label for="proveedor">Proveedor</label>
                                <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal2"><i class="fas fa-search"></i> Buscar</button>
                                         <div style="margin-right: 10px"></div>
                                        <a href="{{ url('/admin/proveedores/crear-proveedor') }}" type="button"
                                        class="btn btn-success"><i class="fas fa-plus"></i></a>
                                        
                                        <div class="modal fade" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de
                                                        Proveedores</h1>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table id="mitabla2"
                                                        class="table table-striped table-bordered table-hover table-sm table-responsive">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col" style="text-align: center ">Nro
                                                                </th>
                                                                <th scope="col" style="text-align: center ">
                                                                    Acción</th>

                                                                <th scope="col" style="text-align: center ">
                                                                    Nombre proveedor</th>
                                                                <th scope="col" style="text-align: center ">Celular</th>
                                                                <th scope="col" style="text-align: center ">Correo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $contador = 1; ?>
                                                            @foreach ($proveedores as $proveedor)
                                                                <tr>
                                                                    <td
                                                                        style="text-align: center;vertical-align: middle ">
                                                                        {{ $contador++ }}</td>
                                                                    <td
                                                                        style="text-align: center;vertical-align: middle ">
                                                                        <button type="button" class="btn btn-info seleccionar-btn-proveedor" data-id="{{ $proveedor->id }}" data-nombre_proveedor="{{ $proveedor->nombre_proveedor }}">Seleccionar</button>
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        {{ $proveedor->nombre_proveedor }}</td>
                                                                        <td style="text-align: center">
                                                                            {{ $proveedor->celular }}</td>
                                                                        <td style="text-align: center">
                                                                            {{ $proveedor->email }}</td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                   <a class="btn btn-success" href="{{url('admin/proveedores/create')}}"> <i class="fas fa-save"></i> Agregar proveedor</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal"><i class="fas fa-cancel"></i> Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="nombre_proveedor" disabled>
                                        <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor" hidden>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Factura</label>
                                    <input type="text" class="form-control" name="numero_factura" placeholder="Número de factura">
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="text" class="form-control" name="numero_remito" placeholder="Número de remito">
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha compra:</label>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input type="text" name="fecha_compra" class="form-control datetimepicker-input" data-target="#reservationdate">
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                         </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <div class="card-title">Detalle de moto </div>
                </div>
                    <div class="card-body">
                         <div class="row">
                            <div class="col-md-12 mx-auto mt-4">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#crearMotoModal">
                                    <i class="fas fa-plus"></i> Agregar moto
                                </a>
                              </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tablaProveedores" class="table table-striped table-responsive" >
                                            <thead class="table">
                                                <tr>
                                                    <th class="text-center" style="width: 5%">#</th>
                                                    <th class="text-center" style="width: 10%">Marca</th>
                                                    <th class="text-center" style="width: 15%">Modelo</th>
                                                    <th class="text-center" style="width: 15%">Color</th>
                                                    <th class="text-center" style="width: 15%">Año</th>
                                                    <th class="text-center" style="color:red 5%">Nacionalidad</th>
                                                    <th class="text-center" style="color:red 5%">Nr_motor</th>
                                                    <th class="text-center" style="color:red 5%">Nr_chasis</th>
                                                    <th class="text-center" style="color:red 5%">Precio_unitario</th>
                                                    <th class="text-center" style="width: 20%">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla_moto_temporal">

                                                <tr>
                                                    <td colspan="5" class="text-center">No hay motos agregadas</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                         </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-6 " style="justify-items: end">
            <p><b>Suma de compra:</b></p>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Guardar compra</button>
          </div>
    </div>
    <br>
</form>

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
                                                                <select class="form-control" name="marca" id="marca" required>
                                                                    @foreach ($marcas as $marca )
                                                                    <option value="{{$marca->nombre_marca}}">{{$marca->nombre_marca}}</option>
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
                                                                <select class="form-control" name="nacion" id="nacion">
                                                                @foreach ($nacionalidades as $nacionalidad )
                                                                <option value="{{$nacionalidad->pais}}">{{$nacionalidad->pais}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Año</label>
                                                                <input type="number" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label>
                                                                <input type="number" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check mt-4">
                                                                    <input class="form-check-input" name="es_usada" id="es_usada" type="checkbox">
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
                                                                <input type="text" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label>
                                                                <input type="text" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <label>Precio compra</label>
                                                                <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio compra">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Precio venta</label>
                                                                <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio venta">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deposito</label>
                                                                <select class="form-control" id="deposito">
                                                                    @foreach ($depositos as $deposito )
                                                                    <option value="{{$deposito->id}}">{{$deposito->nombre_deposito}}</option>
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
                                                                <input type="file" id="file" name="imagen_moto"
                                                                    accept=".jpg, jpeg, png" class="form-control">
                                                                @error('imagen')
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
                                                                    document.getElementById('file').addEventListener('change', archivo, false);
                                                            </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                        <div class="modal-footer">
                            <button type="button" onclick="agregarMotoDesdeModal()" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar moto</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancelar</button>
                        </div>

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
        $(document).ready(function () {
            $(document).on('click', '.seleccionar-btn-proveedor', function () {
                var id = $(this).data('id');
                var nombre_proveedor = $(this).data('nombre_proveedor');

                $('#nombre_proveedor').val(nombre_proveedor);
                $('#id_proveedor').val(id);

                $('#exampleModal2').modal('hide'); // Cierra correctamente el modal

                $('#exampleModal2').on('hidden.bs.modal', function () {
                    $('#nombre_proveedor').focus();
                });
            });
        });
        </script>
        <script>
            $(document).ready(function() {
                // Inicializar DataTable
                $('#tablaProductos').DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información.",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "lengthMenu": "Mostrar _MENU_ Productos",
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

            });
        </script>
        <script>
          function agregarMotoDesdeModal() {
                let formData = new FormData();

                formData.append('marca', $('#marca').val());
                formData.append('modelo', $('#modelo_moto').val());
                formData.append('dominio ', $('#dominio').val());
                formData.append('cilindrada ', $('#cilindrada_moto').val());
                formData.append('color', $('#color_moto').val());
                formData.append('nacion', $('#nacion').val());
                formData.append('anio_moto', $('#anio_moto').val());
                formData.append('km', $('#km_moto').val());
                formData.append('es_usada', $('#es_usada').is(':checked') ? 1 : 0);
                formData.append('nr', $('#nr_motor').val());
                formData.append('nr_chasis', $('#nr_chasis').val());
                formData.append('dnrpa', $('#dnrpa').val());
                formData.append('certificado', $('#nr_certificado').val());
                formData.append('precio_compra', $('#precio_compra').val());
                formData.append('precio_venta', $('#precio_venta').val());
                formData.append('deposito', $('#deposito').val());

                const fileInput = document.getElementById('file');
                if (fileInput.files.length > 0) {
                    formData.append('imagen', fileInput.files[0]);
                }



                    $.ajax({
                        url: "{{ url('admin/agregar-moto') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.success) {
                                alert('Moto guardada exitosamente');
                                actualizarTablaTemporal(response.motos);
                            } else {
                                alert('Error al guardar la moto');
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            alert('Error al procesar la solicitud');
                        }
                    });

            }

            function actualizarTablaTemporal(motos) {
                let tabla = document.getElementById("tabla_moto_temporal");

                if (!tabla) {
                    console.error("Error: No se encontró el elemento con ID 'tabla_moto_temporal'");
                    return;
                }

                // Limpiar la tabla antes de actualizarla
                tabla.innerHTML = "";

                // Verificar si hay motos para mostrar
                if (motos.length === 0) {
                    tabla.innerHTML = `<tr><td colspan="5" class="text-center">No hay motos agregadas</td></tr>`;
                    return;
                }

                // Crear filas y agregarlas a la tabla
                motos.forEach(moto => {
                    let fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${moto.motoId}</td>
                        <td>${moto.marca}</td>
                        <td>${moto.modelo}</td>
                        <td>${moto.color}</td>
                        <td>${moto.anio_moto}</td>
                        <td>${moto.nacion}</td>
                        <td>${moto.nr}</td>
                        <td>${moto.nr_chasis}</td>
                        <td>${moto.precio_compra}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarMoto(${moto.motoId})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                    tabla.appendChild(fila);
                });
    }

        </script>
        <script>
              function eliminarMoto(motoId) {
                    $.ajax({
                        url: "{{ url('admin/eliminar-moto') }}",
                        method: "POST",
                        data: { motoId: motoId },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert("Moto eliminada correctamente");
                                // Actualizamos la tabla con los datos que devuelve el servidor
                                actualizarTablaTemporal(response.motos);
                            } else {
                                alert("Error al eliminar la moto: " + response.message);
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert("Error al procesar la solicitud");
                        }
                    });
                }
        </script>


    @endsection
