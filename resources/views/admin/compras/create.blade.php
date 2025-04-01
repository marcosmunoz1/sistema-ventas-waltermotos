@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Compras/<b>Cargar-Compra</b></h2>
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
                         <div class="row">
                            <div class="col-md-4">
                                <label for="cantidad">Proveedor</label> 
                                <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal2"><i class="fas fa-search"></i> Buscar</button>
                                        <div class="modal fade" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de
                                                        Proveedores</h1>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button>
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
                                                                    empresa</th>
                                                                <th scope="col" style="text-align: center ">Telefono</th>
                                                                <th scope="col" style="text-align: center ">Nombre</th>


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
                                                                        <button type="button" class="btn btn-info seleccionar-btn-proveedor first:" data-id="{{ $proveedor->id }}" data-empresa="{{ $proveedor->empresa }}">Seleccionar</button>
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        {{ $proveedor->empresa }}</td>
                                                                        <td style="text-align: center">
                                                                            {{ $proveedor->telefono }}</td>
                                                                        <td style="text-align: center">
                                                                            {{ $proveedor->name }}</td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="empresa_proveedor" disabled>
                                        <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor" hidden>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                3
                            </div>
                            <div class="col-md-2">
                                2
                            </div>
                            <div class="col-md-2">
                                2
                            </div>
                            <div class="col-md-2">
                                2
                            </div>
                         </div>
                    </div>
                </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Buscar producto</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table">
                            <table class="table table-striped table-responsive"  id="tablaProductos"
                                style="table-layout: fixed; width: 100%;">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 5%;">Acción</th>
                                        <th scope="col" style="width: 10%;">Código</th>
                                        <th scope="col" style="width: 35%;">Nombre del Producto</th>
                                        <th scope="col" style="width: 15%;">P. Compra</th>
                                        <th scope="col" style="width: 15%;">P. Venta</th>
                                        <th scope="col" style="width: 5%;">Stock</th>
                                        <th scope="col" style="width: 15%;">Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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



    @endsection
