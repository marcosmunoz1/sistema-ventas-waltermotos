@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Compras/<b>Editar Compra</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <div class="card-title">Datos de Compra </div>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/compras',$compra->id) }}" id="form_compra" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                        <input type="text" class="form-control" value="{{$compra->proveedor->nombre_proveedor}}" id="nombre_proveedor" disabled>
                                        <input type="hidden" class="form-control" value="{{$compra->proveedor->nombre_proveedor}}" id="id_proveedor" name="id_proveedor" hidden>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Factura</label>
                                    <input type="text" class="form-control" value="{{$compra->numero_factura}}" id="numero_factura" name="numero_factura" placeholder="Número de factura" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="text" class="form-control" value="{{$compra->numero_remito}}" id="numero_remito" name="numero_remito" placeholder="Número de remito">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha compra:</label>

                                        <input type="date" name="fecha_compra" value="{{$compra->fecha_compra}}" id="fecha_compra" class="form-control datetimepicker-input" data-target="#reservationdate" required>

                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <!-- Cantidad -->
                        <div class="row" >
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
                                                            <table id="tabla-motos" class="table table-striped table-responsive" >
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
                                                                <tbody id="tabla-motos-body">

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

                        <!-- Detalle de Productos -->

                        {{-- <div class="card-title ">Detalle de compra</div> --}}
                        <div class="card-body">


                            <!-- Botones de acción -->
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-success" >
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
                                                                <select class="form-control"  name="id_marca" id="id_marca" required>
                                                                @foreach ($marcas as $marca )
                                                                    <option value="{{$marca->id}}" >{{$marca->nombre_marca}}</option>
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
                                                                <input type="text" value="{{$motos->dominio}}"  name="dominio" id="dominio" class="form-control" required
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
                                                                <label>Color</label>
                                                                <input type="text"  value="{{$motos->color_moto}}" name="color_moto" id="color_moto" class="form-control"  placeholder="Color">
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
                                                                <input type="number"  value="{{$motos->anio_moto}}" name="anio_moto" id="anio_moto" class="form-control" placeholder="Año" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Km</label>
                                                                <input type="number"  value="{{$motos->km_moto}}" name="km_moto" id="km_moto" class="form-control" placeholder="Kilometraje" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check mt-4">
                                                                    <input class="form-check-input" value="{{$motos->es_usada}}"  name="es_usada" id="es_usada" type="checkbox" required>
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
                                                                <label>D.N.R.P.A</label>
                                                                <input type="text" value="{{$motos->dnrpa}}" name="dnrpa" id="dnrpa" class="form-control" placeholder="Nro. DNRPA" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Certificado</label>
                                                                <input type="text" value="{{$motos->nr_certificado}}" class="form-control" name="nr_certificado" id="nr_certificado" placeholder="Nro. Certificado" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <label>Precio compra</label>
                                                                <input type="text" value="{{$motos->precio_compra}}" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio compra" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Precio venta</label>
                                                                <input type="text" value="{{$motos->precio_venta}}" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio venta" required>
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

                        <div class="modal-footer">
                            <button type="button" id="btn-agregar-moto" class="btn btn-primary">
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
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-agregar-moto').addEventListener('click', agregarMotoATabla);

           function agregarMotoATabla() {

             const tablaBody = document.getElementById('tabla-motos-body') ||
            document.querySelector('table tbody');

                if (!tablaBody) {
                    console.error('Error: No se encontró el elemento #tabla-motos-body');
                    alert('Error interno. Recarga la página e intenta nuevamente.');
                    return;
                }

                let contador = 1;
                let id_marca = document.getElementById('id_marca').value;
                let modelo_moto = document.getElementById('modelo_moto').value;
                let dominio = document.getElementById('dominio').value;
                let cilindrada_moto = document.getElementById('cilindrada_moto').value;
                let km_moto = document.getElementById('km_moto').value;
                let es_usada = document.getElementById('es_usada').value;
                let dnrpa = document.getElementById('dnrpa').value;
                let nr_certificado = document.getElementById('nr_certificado').value;
                let precio_venta = parseFloat(document.getElementById('precio_venta').value);
                let id_deposito = document.getElementById('id_deposito').value;
                let color_moto = document.getElementById('color_moto').value;
                let anio_moto =   document.getElementById('anio_moto').value;
                let id_nacionalidad =   document.getElementById('id_nacionalidad').value;
                let nr_motor =   document.getElementById('nr_motor').value;
                let nr_chasis =   document.getElementById('nr_chasis').value;
                let precio_compra = parseFloat(document.getElementById('precio_compra').value);
                let imagen_moto = 'sin_imagen.jpg';

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
                            <input type="hidden" name="imagen_moto[]" class="form-control" value="${imagen_moto}" min="1" required readonly>
                            ${contador}
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <input type="hidden" name="id_marca[]" class="form-control" value="${id_marca}" min="1" required readonly>
                            ${id_marca}
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
                            ${id_nacionalidad}
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <input type="hidden" name="nr_motor[]" class="form-control" value="${nr_motor}" min="1" required readonly >
                            ${nr_motor}
                        </td>
                         <td class="text-center" style="vertical-align: middle;">
                            <input type="hidden" name="nr_chasis[]" class="form-control" value="${nr_chasis}" min="1" required readonly >
                            ${nr_chasis}
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <input type="hidden" name="precio_compra[]" class="form-control" value="${precio_compra}" min="1" required readonly oninput="calcularSubtotal(this)">
                            ${precio_compra}
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                `;

                  // 4. Agregar fila
                 tablaBody.appendChild(fila);

                // 2. Agregar DIRECTAMENTE al formulario (no solo a la tabla)
                const form = document.getElementById('formulario-compra');



                // 3. Resetear solo los campos del modal (no el formulario completo)
                $('#modalMoto').find('input').not('[type="hidden"]').val('');


                $('#crearMotoModal').modal('hide'); // Cierra correctamente el modal

            }
        });
       </script>


    @endsection
