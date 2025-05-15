@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Compras/<b>Cargar Compra</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <div class="card-title">Datos de Compra </div>
                </div>

                <form action="{{ url('/admin/compras/cargar-compra') }}" id="form_compra" method="POST"  enctype="multipart/form-data">
                 @csrf
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
                                                <div class="modal-header  text-white" style="background-color: #252652">
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
                                                                <th scope="col" style="text-align: center ">Cuit</th>
                                                                <th scope="col" style="text-align: center ">Telefono</th>
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
                                                                            {{$proveedor->cuit}}
                                                                        </td>
                                                                        <td style="text-align: center">
                                                                            {{$proveedor->telefono}}
                                                                        </td>
                                                                        <td style="text-align: center">
                                                                            {{ $proveedor->email }}</td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                <a class="btn btn-success" href="{{url('admin/proveedores/crear-proveedor')}}"> <i class="fas fa-save"></i> Agregar proveedor</a>
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
                                    <input type="number" class="form-control" id="numero_factura" name="numero_factura" placeholder="Número de factura" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="number" class="form-control" id="numero_remito" name="numero_remito" placeholder="Número de remito" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha compra</label>

                                        <input type="date" name="fecha_compra" id="fecha_compra" class="form-control datetimepicker-input" data-target="#reservationdate" required>

                                    </div>
                                </div>
                            </div>
                            <input type="text" id="total_compra" name="total_compra" hidden>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="card card-outline card-secondary">
                                    <div class="card-header">
                                        <div class="card-title">Detalles de moto </div>
                                    </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mx-auto mt-4">
                                                    <a class="btn btn-success" id="btn-agregar-moto" data-toggle="modal" data-target="#crearMotoModal">
                                                        <i class="fas fa-plus"></i> Agregar moto
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                                      <table id="tabla-motos" class="table table-bordered table-nowrap">
                                                        <thead class="thead-light">
                                                          <tr>
                                                            <th class="text-center sticky-column">#</th>
                                                            <th class="text-center">Marca</th>
                                                            <th class="text-center">Modelo</th>
                                                            <th class="text-center d-none d-sm-table-cell">Color</th>
                                                            <th class="text-center d-none d-md-table-cell">Año</th>
                                                            <th class="text-center d-none d-lg-table-cell">Nacionalidad</th>
                                                            <th class="text-center d-none d-xl-table-cell">Nr_motor</th>
                                                            <th class="text-center d-none d-xl-table-cell">Nr_chasis</th>
                                                            <th class="text-center d-none d-md-table-cell">Imagen</th>
                                                            <th class="text-center sticky-column">Acciones</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody id="tabla-motos-body">
                                                          <!-- Filas se generarán dinámicamente -->
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

                    </div>
                    <div class="card-body" style="justify-items: end">
                        <h4>
                            <b>Suma de compra:</b><b id="mostrarVariable"></b>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" >
                                <i class="fas fa-save"></i> Registrar
                            </button>
                            <a href="{{ url('admin/compras') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>

                    </div>

                </form>
                </div>
            </div>
        </div>

         <!-- Modal para agregar o editar el detalle de la moto -->
    <div class="modal" id="crearMotoModal" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #252652">
                    <h5 class="modal-title" id="modalMotoTitle"><i class="fa-solid fa-motorcycle"></i><span id="modalActionText">Agregar</span> detalle de la moto</h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline">
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
                                                                    <option value="">Seleccione una marca</option>
                                                                @foreach ($marcas as $marca )
                                                                    <option value="{{$marca->id}}" data-nombre_marca="{{ $marca->nombre_marca }}">{{$marca->nombre_marca}}</option>
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
                                                                <label>Color</label><b style="color: red;">*</b>
                                                                <input type="text" name="color_moto" id="color_moto" class="form-control"  placeholder="Color" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nacionalidad</label><b style="color: red;">*</b>
                                                                <select class="form-control" name="id_nacionalidad" id="id_nacionalidad" required>
                                                                    <option value="">Seleccione una Nacionalidad</option>
                                                                @foreach ($nacionalidades as $nacionalidad )
                                                                <option value="{{$nacionalidad->id}}" data-nombre_nacionalidad="{{ $nacionalidad->pais }}">{{$nacionalidad->pais}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Año</label><b style="color: red;">*</b>
                                                                <input type="number" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label><b style="color: red;">*</b>
                                                                <input type="number" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje" required>
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
                                                                <label>D.N.R.P.A</label><b style="color: red;">*</b>
                                                                <input type="text" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label><b style="color: red;">*</b>
                                                                <input type="text" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <label>Precio compra</label><b style="color: red;">*</b>
                                                                <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio compra" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Precio venta</label><b style="color: red;">*</b>
                                                                <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio venta" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deposito</label><b style="color: red;">*</b>
                                                                <select class="form-control" id="id_deposito" name="id_deposito" required>
                                                                    <option value="">Seleccione un Deposito</option>
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
                                                                <input type="file" id="imagen_moto" name="imagen_moto[]"
                                                                    accept=".jpg, .jpeg, .png" class="form-control" multiple>
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
                                                            <!-- Contenedor para previsualización (añade esto en tu modal) -->
                                                             <div id="preview-container" class="mt-2"></div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" onclick="agregarMotoATabla()" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar moto</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancelar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    @endsection

    @section('css')
    <style>
        /* Estilo para botón deshabilitado */
#btn-agregar-moto:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    background-color: #6c757d !important;
    border-color: #6c757d !important;
}

/* Clase adicional para más énfasis */
.btn-disabled {
    position: relative;
}
.btn-disabled::after {
    content: "✖";
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
}
@media (max-width: 767px) {
  .responsive-table {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  /* Estilos para la tabla responsive */
.table-nowrap {
  white-space: nowrap;
}

.sticky-column {
  position: sticky;
  left: 0;
  background-color: #f8f9fa;
  z-index: 1;
}

/* Ajustar tamaño de columnas en móviles */
@media (max-width: 360px) {
  .table-responsive {
    border: 0;
  }

  #tabla-motos {
    width: auto;
    min-width: 600px; /* Ancho mínimo para mantener estructura */
  }

  .table td, .table th {
    padding: 0.5rem;
    font-size: 0.85rem;
  }

  /* Ocultar columnas menos importantes en móviles */
  .d-priority-1 {
    display: none;
  }
}
}
</style>

    @endsection

    @section('js')
        {{-- Aquí puedes agregar scripts adicionales --}}
        <script>
            $('#mitabla2').DataTable({
              "pageLength":20,
              "language":{
                  "emptyTable": "No hay información",
                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                  "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                  "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                  "infoPostFix": "",
                  "thousands": ",",
                  "lengthMenu": "Mostrar _MENU_ Proveedores",
                  "loadingRecords": "Cargando...",
                  "processings": "Procesando",
                  "search": "Buscador",
                  "zeroRecords": "Sin resultados encontrados",
                  "paginate": {
                      "first": "Primero",
                      "last": "Ultimo",
                      "next": "Siguiente",
                      "previous": "Anterior"
                  }
              },
          });
         </script>
        <script>
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
        </script>
        <script>
           $('#id_marca').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var marcaId = selectedOption.val(); // ID de la marca (para el value)
                    var marcaNombre = selectedOption.data('nombre_marca'); // Nombre de la marca (para mostrar)

                    // Guarda el nombre en una variable global o pásalo a donde necesites
                    window.marcaNombreSeleccionada = marcaNombre; // Opcional (solución rápida)
                });
              $('#id_nacionalidad').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var nacionalidadId = selectedOption.val(); // ID de la marca (para el value)
                    var nacionalidadNombre = selectedOption.data('pais'); // Nombre de la marca (para mostrar)

                    // Guarda el nombre en una variable global o pásalo a donde necesites
                    window.nacionalidadNombreSeleccionada = nacionalidadNombre; // Opcional (solución rápida)
                });
        </script>
        <script>
             document.getElementById('boton-subir-imagen').addEventListener('click', function() {
                const previewDiv = document.createElement('div');
                        previewDiv.className = 'd-inline-block m-1';
                    document.getElementById('imagen_moto').click();
        });

        document.getElementById('imagen_moto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-imagen');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" width="150" class="img-thumbnail">
                        <p class="small">${file.name}</p>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
        </script>
        <script>
            function agregarMotoATabla() {

             // Verificar si ya hay una moto en la tabla
             const tablaBody = document.getElementById('tabla-motos-body');
             if (tablaBody && tablaBody.querySelectorAll('tr').length > 0) {
                 alert('Solo puedes tener una moto a la vez. Limpia la tabla primero.');
                 return;
             }

            // Primero validar campos
             if (!validarCampos()) {
                 // Mostrar primer error si la validación falla
                 const primerError = document.querySelector('.is-invalid, .campo-invalido');
                 if (primerError) {
                     primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                 }
                 return; // Detener la ejecución si la validación falla
             }

             if (!tablaBody) {
                     console.error('Error: No se encontró el elemento #tabla-motos-body');
                     alert('Error interno. Recarga la página e intenta nuevamente.');
                     return;
                 }

                 let contador = 1;
                 let id_marca = document.getElementById('id_marca').value;
                 var marcaNombre = $('#id_marca').find('option:selected').data('nombre_marca');
                 let modelo_moto = document.getElementById('modelo_moto').value;
                 let dominio = document.getElementById('dominio').value;
                 let cilindrada_moto = document.getElementById('cilindrada_moto').value;
                 let km_moto = document.getElementById('km_moto').value;
                 let es_usada = document.getElementById('es_usada').checked ? '1' : '0';
                 let dnrpa = document.getElementById('dnrpa').value;
                 let nr_certificado = document.getElementById('nr_certificado').value;
                 let precio_venta = parseFloat(document.getElementById('precio_venta').value);
                 let id_deposito = document.getElementById('id_deposito').value;
                 let color_moto = document.getElementById('color_moto').value;
                 let anio_moto =   document.getElementById('anio_moto').value;
                 let id_nacionalidad =   document.getElementById('id_nacionalidad').value;
                 var nacionalidadNombre = $('#id_nacionalidad').find('option:selected').data('nombre_nacionalidad');
                 let nr_motor =   document.getElementById('nr_motor').value;
                 let nr_chasis =   document.getElementById('nr_chasis').value;
                 let precio_compra = parseFloat(document.getElementById('precio_compra').value);
                const nuevoTotal = calcularTotalCompra() + parseFloat(precio_compra);
                actualizarVariable(nuevoTotal); 
                /* // Manejo CORRECTO de la imagen
                 const imagenInput = document.getElementById('imagen_moto');
                 let imagenNombre = 'sin_imagen.jpg';
                 let imagenURL = 'ruta/a/imagen_por_defecto.jpg';

                 if (imagenInput.files && imagenInput.files[0]) {
                     imagenNombre = imagenInput.files[0].name;
                     imagenURL = URL.createObjectURL(imagenInput.files[0]);
                 } */
                // Manejo CORREGIDO de la imagen
                const imagenInput = document.getElementById('imagen_moto');
                let imagenHTML = '';
                let fileInputHTML = '';

                if (imagenInput.files && imagenInput.files[0]) {
                    const imagenFile = imagenInput.files[0];
                    const imagenURL = URL.createObjectURL(imagenFile);

                    imagenHTML = `<img src="${imagenURL}" width="50" class="img-thumbnail">`;

                    // Crear un nuevo input file para el envío
                    fileInputHTML = `
                        <input type="file" name="imagen_moto[]" class="d-none"
                            data-file-name="${imagenFile.name}" multiple>
                    `;
                } else {
                    imagenHTML = '<span class="text-muted">Sin imagen</span>';
                }



                  // 1. Crear fila
                 const fila = document.createElement('tr');
                 fila.innerHTML = `
                         <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="contador[]" class="form-control" value="${contador}" min="1" required readonly>
                             <input type="hidden" name="dominio[]" class="form-control" value="${dominio}" min="1" required readonly>
                             <input type="hidden" name="cilindrada_moto[]" class="form-control" value="${cilindrada_moto}" min="1" required readonly>
                             <input type="hidden" name="km_moto[]" class="form-control" value="${km_moto}" min="1" required readonly>
                             <input type="hidden" name="es_usada[]" class="form-control" value="${es_usada}" min="1" required readonly>
                             <input type="hidden" name="dnrpa[]" class="form-control" value="${dnrpa}" min="1" required readonly>
                             <input type="hidden" name="nr_certificado[]" class="form-control" value="${nr_certificado}" min="1" required readonly>
                             <input type="hidden" name="precio_venta[]" class="form-control" value="${precio_venta}" min="1" required readonly>
                             <input type="hidden" name="id_deposito[]" class="form-control" value="${id_deposito}" min="1" required readonly>
                             <input type="hidden" name="precio_compra[]" class="form-control" value="${precio_compra}" min="1" required readonly>
                             ${contador}
                         </td>
                         <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="id_marca[]" class="form-control" value="${id_marca}" min="1" required readonly>
                             ${marcaNombre}
                         </td>
                          <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="modelo_moto[]" class="form-control" value="${modelo_moto}" min="1" required readonly>
                             ${modelo_moto}
                         </td>
                          <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="color_moto[]" class="form-control" value="${color_moto}" min="1" required readonly >
                             ${color_moto}
                         </td>
                          <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="anio_moto[]" class="form-control" value="${anio_moto}" min="1" required readonly >
                             ${anio_moto}
                         </td>
                          <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="id_nacionalidad[]" class="form-control" value="${id_nacionalidad}" min="1" required readonly >
                             ${nacionalidadNombre}
                         </td>
                         <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="nr_motor[]" class="form-control" value="${nr_motor}" min="1" required readonly >
                             ${nr_motor}
                         </td>
                          <td class="text-center" style="vertical-align: middle;">
                             <input type="hidden" name="nr_chasis[]" class="form-control" value="${nr_chasis}" min="1" required readonly >
                             ${nr_chasis}
                        <td class="text-center" style="vertical-align: middle;">
                            ${imagenHTML}
                            ${fileInputHTML}
                        </td>
                         <td class="text-center" style="vertical-align: middle;">
                             <button type="button" class="btn btn-danger btn-sm" onclick="limpiarTabla()">
                                 <i class="fas fa-trash"></i>
                             </button>
                         </td>
                 `;

                 // Transferir el archivo al nuevo input
                if (imagenInput.files && imagenInput.files[0]) {
                    const newFileInput = fila.querySelector('input[name="imagen_moto[]"]');
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(imagenInput.files[0]);
                    newFileInput.files = dataTransfer.files;
                }


                   // 4. Agregar fila
                  tablaBody.appendChild(fila);




                 // 3. Resetear solo los campos del modal (no el formulario completo)
              /*    $('#modalMoto').find('input').not('[type="hidden"]').val(''); */
                 $('#crearMotoModal').find('input').not('[type="hidden"]').val('');
                 $('#crearMotoModal').find('select').val('');
                 document.getElementById('es_usada').checked = false;

                   // 2. Agregar DIRECTAMENTE al formulario (no solo a la tabla)
                   const form = document.getElementById('formulario-compra');


                 $('#crearMotoModal').modal('hide'); // Cierra correctamente el modal

                 actualizarEstadoBotonAgregar();

                 return true;
             }
        </script>


       <script>

        // Función de validación (externa para poder usarla separadamente)
    function validarCampos() {
        let valido = true;
        const camposObligatorios = [
            'id_marca', 'modelo_moto', 'dominio', 'cilindrada_moto',
            'nr_motor', 'nr_chasis', 'precio_compra', 'precio_venta',
            'anio_moto', 'id_deposito', 'color_moto', 'km_moto', 'id_nacionalidad', 'dnrpa',
            'nr_certificado', 'id_deposito'
        ];

        camposObligatorios.forEach(id => {
            const campo = document.getElementById(id);
            if (!campo) return;

            const grupo = campo.closest('.form-group') || campo.closest('[class^="col-"]');

            if (campo.type === 'checkbox') {
                // Validación para checkbox
                if (!campo.checked) {
                    mostrarError(grupo, 'Este campo es requerido');
                    valido = false;
                } else {
                    limpiarError(grupo);
                }
            } else {
                // Validación para otros campos
                if (!campo.value.trim()) {
                    mostrarError(grupo, 'Este campo es requerido');
                    valido = false;
                } else {
                    limpiarError(grupo);
                }
            }
        });

        return valido;
    }

// Funciones auxiliares para mostrar/limpiar errores
function mostrarError(grupo, mensaje) {
    if (!grupo) return;

    grupo.classList.add('campo-invalido');
    grupo.querySelector('.invalid-feedback')?.remove();

    const mensajeError = document.createElement('div');
    mensajeError.className = 'invalid-feedback d-block';
    mensajeError.textContent = mensaje;
    grupo.appendChild(mensajeError);
}

function limpiarError(grupo) {
    if (!grupo) return;

    grupo.classList.remove('campo-invalido');
    grupo.querySelector('.invalid-feedback')?.remove();
}

      </script>
      <script>
     function actualizarVariable(nuevoValor) {
    // Formatear si es número
    const valorFormateado = typeof nuevoValor === 'number'
        ? nuevoValor.toFixed(2)
        : nuevoValor;

    // Actualizar UI
    const elementos = [
        {id: "mostrarVariable", prop: "textContent"},
        {id: "total_compra", prop: "value"}
    ];

    elementos.forEach(item => {
        const el = document.getElementById(item.id);
        if (el) el[item.prop] = valorFormateado;
    });
    }
      </script>
      <script>
         function limpiarTabla() {
                        const tablaBody = document.getElementById('tabla-motos-body');
                if (tablaBody) {
                    tablaBody.innerHTML = '';

                    // Actualizar el total a 0 cuando se limpia la tabla
                    actualizarVariable(0);

                    // Actualizar estado inmediatamente
                    actualizarEstadoBotonAgregar();

                    // Reiniciar completamente el tooltip
                    const btnAgregar = document.getElementById('btn-agregar-moto');
                    if (btnAgregar) {
                        $(btnAgregar).tooltip('dispose');
                        btnAgregar.removeAttribute('data-original-title');
                    }

                    console.log('Tabla limpiada y estado actualizado'); // Para depuración
                }
            }
      </script>
      <script>
       function actualizarEstadoBotonAgregar() {
        const tablaBody = document.getElementById('tabla-motos-body');
        const btnAgregar = document.getElementById('btn-agregar-moto');

        if (!tablaBody || !btnAgregar) return;

        const tieneMotos = tablaBody.querySelector('tr') !== null;
        btnAgregar.disabled = tieneMotos;

        btnAgregar.onclick = function(e) {
            if (btnAgregar.disabled) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Acción no permitida',
                    text: 'Debe limpiar la tabla primero antes de agregar otra moto',
                    confirmButtonText: 'Entendido'
                });
            }
        };
            }

        </script>
        <script>
            function calcularTotalCompra() {
            const filas = document.querySelectorAll('#tabla-motos-body tr');
            let total = 0;

            filas.forEach(fila => {
                const inputPrecio = fila.querySelector('input[name="precio_compra[]"]');
                if (inputPrecio) {
                    total += parseFloat(inputPrecio.value) || 0;
                }
            });

            return total;
        }
        </script>
    @endsection
