@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Compras/<b>Cargar-Compra</b></h2>
    <hr>
@endsection

@section('content')
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
                                    <input type="text" class="form-control" placeholder="Número de factura">
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="text" class="form-control" placeholder="Número de remito">
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date:</label>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
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
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Agregar Moto</button>
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
                                            <?php $contador = 1; ?>
                                            <tbody>
                                                @foreach ($motos as $moto)
                                                    <tr>
                                                        <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                                        <td  class="text-center" style="vertical-align: middle"> {{ $moto->id_marca }}</td>
                                                        <td class="text-center" style="vertical-align: middle">{{ $moto->modelo_moto }}</th>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle;">
                                                            {{ $moto->color_moto }}</td>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                                            {{ $moto->anio_moto }} </td>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                                            {{ $moto->id_nacionalidad }} </td>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                                            {{ $moto->nr_motor }} </td>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                                            {{ $moto->nr_chasis }} </td>
                                                        <td class="text-center" style="text-align: right; vertical-align: middle; ">
                                                            {{ $moto->precio_compra }} </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <a href="{{ url('/admin/proveedores', $moto->id) }}"
                                                                class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                            <a href="{{ url('/admin/proveedores/' . $moto->id . '/edit') }}"
                                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                            <form action="{{ url('/admin/proveedores', $moto->id) }}"
                                                                method="post" class="d-inline-block"
                                                                onsubmit="preguntar(event, {{ $moto->id }})"
                                                                id="miFormulario{{ $moto->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
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

            <p><b>Suma de compra:</b>12222</p>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Guardar compra</button>
          </div>
          </div>
    </div>
    <br>


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

    @endsection
