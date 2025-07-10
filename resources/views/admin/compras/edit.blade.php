@extends('adminlte::page')

@section('title', 'Editar Compra')

@section('content_header')
    <H1 class="brand-text font-weight-light"><b>Compras</b>/<b>Editar Compra</b></H1>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-title">Datos de Compra </div>
                </div>
                <form action="{{ url('/admin/compras',$compra->id) }}" id="form_compra" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
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
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="{{$compra->proveedor->nombre_proveedor}}" id="nombre_proveedor" disabled>
                                        <input type="hidden" value="{{$compra->proveedor->id}}" class="form-control" id="id_proveedor" name="id_proveedor" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Factura</label>
                                    <input type="number" class="form-control" value="{{$compra->numero_factura, old('numero_factura')}}" id="numero_factura" name="numero_factura" required>
                                      @error('numero_factura')
                                                <small style="color:red;">{{ $message }}</small>
                                       @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito</label>
                                    <input type="number" class="form-control" value="{{$compra->numero_remito}}" id="numero_remito" name="numero_remito"  required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha compra</label>
                                        <input type="date" name="fecha_compra" value="{{$compra->fecha_compra}}" id="fecha_compra" class="form-control datetimepicker-input" data-target="#reservationdate" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <div class="card-title">Detalles de moto </div>
                                    </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mx-auto mt-4">
                                                    <a class="btn btn-warning" id="btn-agregar-moto" data-toggle="modal" data-target="#crearMotoModal">
                                                        <i class="fas fa-edit"></i> Editar moto
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive-sm" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                                      <table id="tabla-motos" class="table table-bordered table-nowrap  table-striped table-hover table-sm ">
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
                                                                <tr>
                                                                    <td  class="text-center" style="vertical-align: middle;">
                                                                        1
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="hidden" name="dominio" id="dominioTabla" class="form-control" value="{{$motos->dominio}}" min="1" required readonly>
                                                                        <input type="hidden" name="cilindrada_moto" id="cilindra_motoTabla" class="form-control" value="{{$motos->cilindrada_moto}}" min="1" required readonly>
                                                                        <input type="hidden" name="km_moto" id="km_motoTabla" class="form-control"  value="{{$motos->km_moto}}" min="1" required readonly>
                                                                        <input type="hidden" name="es_usada" id="es_usadaTabla" class="form-control" value="{{$motos->es_usada}}" min="1" required readonly>
                                                                        <input type="hidden" name="dnrpa" id="dnrpaTabla" class="form-control" value="{{$motos->dnrpa}}" min="1" required readonly>
                                                                        <input type="hidden" name="nr_certificado" id="nr_certificadoTabla" class="form-control" value="{{$motos->nr_certificado}}" min="1" required readonly>
                                                                        <input type="hidden" name="precio_venta" id="precio_ventaTabla" class="form-control" value="{{$motos->precio_venta}}" min="1" required readonly>
                                                                        <input type="hidden" name="id_deposito" id="id_depositoTabla" class="form-control" value="{{$motos->id_deposito}}" min="1" required readonly>
                                                                        <input type="hidden" name="precio_compra" id="precio_compraTabla" class="form-control" value="{{$motos->precio_compra}}" min="1" required readonly>
                                                                        <input type="hidden" name="id_marca" id="id_marcaTabla" class="input-invisible"
                                                                        value="{{ $motos->id_marca}}" min="1" required>
                                                                        <input type="text" id="nombre_marcaTabla" class="input-invisible" value="{{$motos->marca->nombre_marca}}" min="1" required readonly>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="number" name="modelo_moto" id="modelo_motoTabla" class="input-invisible" value="{{$motos->modelo_moto}}" min="1" readonly >
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="text" name="color_moto" id="color_motoTabla" class="input-invisible" value="{{$motos->color_moto}}" min="1" required readonly >

                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="text" name="anio_moto" id="anio_motoTabla" class="input-invisible" value="{{$motos->anio_moto}}" min="1" required readonly >

                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="hidden" name="id_nacionalidad" id="id_nacionalidadTabla" class="input-invisible" value="{{$motos->id_nacionalidad}}" min="1" required readonly >
                                                                        <input type="text" id="nombre_paisTabla" class="input-invisible" value="{{$motos->nacionalidad->pais}}" min="1" required readonly>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="text" name="nr_motor" id="nr_motorTabla" class="input-invisible" value="{{$motos->nr_motor}}" min="1" required readonly >

                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <input type="text" name="nr_chasis" id="nr_chasisTabla" class="input-invisible" value="{{$motos->nr_chasis}}" min="1" required readonly >

                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        @if($motos->imagen_moto)
                                                                            <img src="{{ asset($motos->imagen_moto) }}" id="img" width="50" class="img-thumbnail">
                                                                        @else
                                                                            <span>Sin imagen</span>
                                                                        @endif
                                                                        <input type="file" name="imagen_moto" id="imagen_motoTabla" class="d-none" hidden>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <a class="btn btn-primary btn-sm" id="btn-ver-moto" data-toggle="modal" data-target="#VerMotoModal">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    </td>
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
                    </div>
                    <div class="card-body" style="justify-items: end">
                        <h4>
                            <label><b>Suma de compra</b></label>
                             <input type="number" id="total-compra" name="total_compra" value="{{ $compra->total_compra }}"
                                class="form-control" readonly step="0.01">
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning" >
                                <i class="fas fa-edit"></i> Actualizar
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
        {{-- Buscar Proveedor --}}
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">Buscar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <table id="tablaProveedores" class="table table-striped table-bordered table-hover table-sm">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" style="text-align: center ">Acción</th>
                                    <th scope="col" style="text-align: center ">Nombre</th>
                                    <th scope="col" style="text-align: center ">Celular</th>
                                    <th scope="col" style="text-align: center ">Cuit</th>
                                    <th scope="col" style="text-align: center ">Correo</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle ">
                                            <button type="button" class="btn btn-info seleccionar-btn-proveedor"
                                                data-id="{{ $proveedor->id }}"
                                                data-nombre_proveedor="{{ $proveedor->nombre_proveedor }}"><i
                                                    class="fa-solid fa-circle-plus"></i></button>
                                        </td>
                                        <td style="text-align: center">
                                            {{ $proveedor->nombre_proveedor }}</td>
                                        <td style="text-align: center">
                                            {{ $proveedor->celular }}</td>
                                        <td style="text-align: center">
                                            {{ $proveedor->cuit }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $proveedor->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="{{ url('admin/proveedores/crear-proveedor') }}"> <i
                                class="fas fa-save"></i> Agregar proveedor</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-cancel"></i>
                            Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal para ver los detalles de la moto -->
    <div class="modal" id="VerMotoModal" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="verRolLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-center" >
                <h4 class="modal-title text-center">
                    <i class="fa-solid fa-motorcycle"></i>
                    <span id="modalActionText">Ver</span> detalles de la moto  <i class="fa-solid fa-motorcycle"></i>
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
                                                            <label>Marca</label>
                                                             <input class="form-control" type="text" value="{{$motos->marca->nombre_marca}}" id="nombre_marcaTabla2" readonly>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <label>Modelo</label>
                                                                <input type="text" value="{{$motos->modelo_moto}}" id="modelo_motoVer" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Dominio</label>
                                                            <input type="text" value="{{$motos->dominio}}" id="dominioVer" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Cilindrada</label>
                                                            <input type="number" value="{{$motos->cilindrada_moto}}" id="cilindrada_motoVer" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                     <!-- Fila 2 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-2">
                                                            <label>Color</label>
                                                            <input type="text" value="{{$motos->color_moto}}"  id="color_motoVer" class="form-control"  readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nacionalidad</label>
                                                             <input class="form-control" type="text" value="{{$motos->nacionalidad->pais}}" id="paisVer" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Año</label>
                                                            <input type="number" value="{{$motos->anio_moto}}" id="anio_motoVer" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Km</label>
                                                            <input type="number" value="{{$motos->km_moto}}" id="km_motoVer" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check mt-4">
                                                                <input class="form-check-input" id="es_usadaVer" type="checkbox"
                                                                 {{ $motos->es_usada == 1 ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label">¿Es usada?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fila 3 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>Nro. Motor</label>
                                                            <input type="text" value="{{$motos->nr_motor}}" id="nr_motorVer" class="form-control"  readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nro. Chasis</label>
                                                            <input type="text" value="{{$motos->nr_chasis}}"  id="nr_chasisVer" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Fila 4 -->
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label>D.N.R.P.A</label>
                                                            <input type="text" value="{{$motos->dnrpa}}" id="dnrpaVer" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Certificado</label>
                                                            <input type="text" value="{{$motos->nr_certificado}}" class="form-control" id="nr_certificadoVer" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Precio de Compra</label>
                                                                    <div class="input-group">
                                                                            <span class="input-group-text">$</span>
                                                                        <input type="number" value="{{$motos->precio_compra}}" class="form-control"  id="precio_compraVer" readonly>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label>Precio de Venta</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" value="{{$motos->precio_venta}}" id="precio_ventaVer"
                                                                        class="form-control " readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Deposito</label>
                                                            <input class="form-control" type="text" value="{{$motos->deposito->nombre_deposito}}" id="depositoVer" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                  <!-- Segunda Columna: Imagen -->
                                                   <div class="col-md-3">
                                                         <label>Imagen</label>
                                                        <div class="text-center">
                                                            @if($motos->imagen_moto)
                                                                <img src="{{ asset($motos->imagen_moto) }}" id="imgVer" width="150" class="img-thumbnail">
                                                            @else
                                                                <span>Sin imagen</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cerrar</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
           <!-- Modal editar el detalle de la moto -->
    <div class="modal" id="crearMotoModal" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header bg-warning text-white d-flex justify-content-center" >
                    <h4 class="modal-title text-center">
                        <i class="fa-solid fa-motorcycle"></i>
                        <span id="modalActionText">Editar</span> detalles de la moto  <i class="fa-solid fa-motorcycle"></i>
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
                                                                    <input class="form-check-input"  {{ $motos->es_usada == 1 ? 'checked' : '' }} name="es_usada" id="es_usada" type="checkbox">
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
                                                                    <option value="{{$deposito->id}}" data-nombre_deposito="{{ $deposito->nombre_deposito }}"
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
    @endsection

    @section('css')
    <style>
    .input-invisible {
    border: none;           /* Elimina el borde */
    background: transparent; /* Fondo transparente */
    outline: none;          /* Elimina el contorno al enfocar */
    width: 100%;           /* Ocupa todo el ancho de la celda */
    padding: 0;            /* Elimina el relleno interno */
    margin: 0;             /* Elimina los márgenes */
    font-family: inherit;  /* Usa la misma fuente que la tabla */
    font-size: inherit;    /* Mismo tamaño de fuente */
    /* margin-left: 25px; */
    justify-items: center;
    }
    .precio-actualizado {
    transition: all 0.3s ease;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.3);
    background-color: #f8fff8;
    }
        /* Estilo para botón deshabilitado */
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
       {{--  <script>
            document.getElementById('form_compra').addEventListener('submit', function(e) {
                e.preventDefault(); // Evita el envío inmediato

                Swal.fire({
                    title: '¿Confirmar edición?',
                    text: "¡Si confirma los cambios, estos seran permanetes para siempre!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit(); // Ahora sí enviamos el formulario
                    }
                });
            });
        </script> --}}
       <script>
            $('#tablaProveedores').DataTable({
               ordering: false,
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
            document.getElementById('imagen_moto').addEventListener('change', function (e) {
                const input = e.target;
                const preview = document.getElementById('img');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
            function validarImagen() {
                const imagenInput = document.getElementById('imagen_moto');
                if (imagenInput.files.length > 0) {
                    const file = imagenInput.files[0];
                    if (!file.type.match('image.*')) {
                        alert('Solo se permiten imágenes');
                        return false;
                    }
                }
                return true;
            }
         </script>
         <script>
             document.getElementById('imagen_moto').addEventListener('change', function (e) {
                const input = e.target;
                const preview = document.getElementById('imgVer');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
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
                $('#id_deposito').change(function() {
                var selectedOption = $(this).find('option:selected');
                var depositoId = selectedOption.val(); // ID de la marca (para el value)
                var depositoNombre = selectedOption.data('nombre_deposito'); // Nombre de la marca (para mostrar)
                // Guarda el nombre en una variable global o pásalo a donde necesites
                window.depositoNombreSeleccionada = depositoNombre; // Opcional (solución rápida)
                 });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imagenInput = document.getElementById('imagen_moto');

                imagenInput.addEventListener('change', function(evt) {
                    const files = evt.target.files;
                    const imageContainer = document.getElementById('image-container');

                    // Limpiar contenedor
                    imageContainer.innerHTML = '';

                    if (files && files[0]) {
                        if (!files[0].type.match('image.*')) {
                            alert('Por favor selecciona una imagen válida');
                            return;
                        }

                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Mostrar previsualización de la nueva imagen
                            imageContainer.innerHTML = `<img class="img-thumbnail mb-2" src="${e.target.result}" width="150">`;

                            // Ocultar/mantener referencia a la imagen existente
                            const currentImage = document.getElementById('current-image');
                            if (currentImage) {
                                currentImage.style.display = 'none';
                            }

                            const noImageText = document.getElementById('no-image-text');
                            if (noImageText) {
                                noImageText.style.display = 'none';
                            }
                        };

                        reader.readAsDataURL(files[0]);
                    } else {
                        // Si no se seleccionó archivo, mostrar la imagen existente o texto
                        @if($motos->imagen_moto)
                            imageContainer.innerHTML = `<img id="current-image" src="{{ asset($motos->imagen_moto) }}" width="50%" alt="Imagen actual">`;
                        @else
                            imageContainer.innerHTML = '<span id="no-image-text">No hay imagen</span>';
                        @endif
                    }
                });
            });
        </script>
        <script>
            function agregarMotoATabla() {
                 // Validar campos primero
                if (!validarCampos()) {
                    const primerError = document.querySelector('.is-invalid, .campo-invalido');
                    if (primerError) {
                        primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return false;
                }

                const tablaBody = document.getElementById('tabla-motos-body');
                if (!tablaBody) {
                    console.error('Error: No se encontró el elemento #tabla-motos-body');
                    alert('Error interno. Recarga la página e intenta nuevamente.');
                    return false;
                }

                // OBTENER VALORES DEL FORMULARIO
                const id_marca = document.getElementById('id_marca').value;
                const marcaNombre = $('#id_marca').find('option:selected').data('nombre_marca');
                const modelo_moto = document.getElementById('modelo_moto').value;
                const precio_compra = parseFloat(document.getElementById('precio_compra').value);
                const dominio = document.getElementById('dominio').value;
                const cilindrada_moto = document.getElementById('cilindrada_moto').value;
                const km_moto = document.getElementById('km_moto').value;
                const es_usada = document.getElementById('es_usada').checked ? '1' : '0';
                const dnrpa = document.getElementById('dnrpa').value;
                const nr_certificado = document.getElementById('nr_certificado').value;
                const precio_venta = parseFloat(document.getElementById('precio_venta').value);
                const id_deposito = document.getElementById('id_deposito').value;
                const depositoNombre = $('#id_deposito').find('option:selected').data('nombre_deposito');
                const color_moto = document.getElementById('color_moto').value;
                const anio_moto =   document.getElementById('anio_moto').value;
                const id_nacionalidad =   document.getElementById('id_nacionalidad').value;
                const nacionalidadNombre = $('#id_nacionalidad').find('option:selected').data('nombre_nacionalidad');
                const nr_motor =   document.getElementById('nr_motor').value;
                const nr_chasis =   document.getElementById('nr_chasis').value;
                const imagenInput = document.getElementById('imagen_moto');
                // Actualizar el precio total
                actualizarPrecioCompra(precio_compra);

                //INPUTS ID DE LA TABLA

                  const inputDominio = document.getElementById('dominioTabla');
                  const inputCilindrada = document.getElementById('cilindra_motoTabla');
                  const inputKm_moto = document.getElementById('km_motoTabla');
                  const inputEsusada_moto = document.getElementById('es_usadaTabla');
                  const inputDnrpa = document.getElementById('dnrpaTabla');
                  const inputNr_certificado = document.getElementById('nr_certificadoTabla');
                  const inputPrecio_venta = document.getElementById('precio_ventaTabla');
                  const inputId_deposito = document.getElementById('id_depositoTabla');
                  const inputPrecio_compra = document.getElementById('precio_compraTabla');
                  const inputId_marca = document.getElementById('id_marcaTabla');
                  const inputNombre_marca = document.getElementById('nombre_marcaTabla');
                  const inputModelo_moto = document.getElementById('modelo_motoTabla');
                  const inputColor_moto= document.getElementById('color_motoTabla');
                  const inputAnio_moto = document.getElementById('anio_motoTabla');
                  const inputNacionalidad_moto = document.getElementById('id_nacionalidadTabla');
                  const inputNombrenacionalidad_moto = document.getElementById('nombre_paisTabla');
                  const inputNr_motor = document.getElementById('nr_motorTabla');
                  const inputNr_chasis = document.getElementById('nr_chasisTabla');
                  const inputImagen = document.getElementById('imagen_motoTabla');

                  // INPUTS ID DEL FORMULARIO VER DETALLE DE LA MOTO
                  const inputNombre_marca2 = document.getElementById('nombre_marcaTabla2');
                  const inputModeloMotoVer = document.getElementById('modelo_motoVer');
                  const inputDominioVer = document.getElementById('dominioVer');
                  const inputCilidradaVer = document.getElementById('cilindrada_motoVer');
                  const inputColorVer = document.getElementById('color_motoVer');
                  const inputanioVer = document.getElementById('anio_motoVer');
                  const inputnacionVer = document.getElementById('paisVer');
                  const inputkmVer = document.getElementById('km_motoVer');
                  const inputes_usadaVer = document.getElementById('es_usadaVer');
                  const inputnrmotorVer = document.getElementById('nr_motorVer');
                  const inputnrchasisVer = document.getElementById('nr_chasisVer');
                  const inputdnrpaVer = document.getElementById('dnrpaVer');
                  const inputcertificadoVer = document.getElementById('nr_certificadoVer');
                  const inputprecompraVer = document.getElementById('precio_compraVer');
                  const inputprecventaVer = document.getElementById('precio_ventaVer');
                  const inputdepositoVer= document.getElementById('depositoVer');

                  // ASIGNAR NUEVOS VALORES A LOS INPUTS ID

                  inputDominio.value = dominio;
                  inputCilindrada.value = cilindrada_moto;
                  inputKm_moto.value = km_moto;
                  inputEsusada_moto.value = es_usada;
                  inputDnrpa.value = dnrpa;
                  inputNr_certificado.value = nr_certificado;
                  inputPrecio_venta.value = precio_venta;
                  inputId_deposito .value = id_deposito;
                  inputPrecio_compra.value = precio_compra;
                  inputId_marca.value = id_marca;
                  inputNombre_marca.value = marcaNombre;
                  inputModelo_moto.value = modelo_moto;
                  inputColor_moto.value = color_moto;
                  inputAnio_moto.value = anio_moto;
                  inputNacionalidad_moto.value = id_nacionalidad;
                  inputNombrenacionalidad_moto.value = nacionalidadNombre;
                  inputNr_motor.value = nr_motor;
                  inputNr_chasis.value = nr_chasis;

                // ASIGNAR NUEVOS VALORES A LOS INPUTS ID DE LOS DETALLES

                  inputNombre_marca2.value = marcaNombre;
                  inputDominioVer.value = dominio;
                  inputCilidradaVer.value = cilindrada_moto;
                  inputkmVer.value = km_moto;
                  inputes_usadaVer.checked = (es_usada === '1');
                  inputdnrpaVer.value = dnrpa;
                  inputcertificadoVer.value = nr_certificado;
                  inputprecventaVer.value = precio_venta;
                  inputprecompraVer.value = precio_compra;
                  inputModeloMotoVer.value = modelo_moto;
                  inputColorVer.value = color_moto;
                  inputanioVer.value = anio_moto;
                  inputnacionVer.value = nacionalidadNombre;
                  inputdepositoVer.value = depositoNombre; //  nuevo
                  inputnrmotorVer.value = nr_motor;
                  inputnrchasisVer.value = nr_chasis;

               if (imagenInput.files && imagenInput.files[0]) {
                    const imagenFile = imagenInput.files[0];

                    const inputImagen  = document.getElementById('imagen_motoTabla');
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(imagenFile);
                    inputImagen.files = dataTransfer.files;
                }

                //cerrar modal

                $('#crearMotoModal').modal('hide');

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
        function actualizarPrecioCompra(nuevoTotal) {
            const inputTotal = document.getElementById('total-compra');

            // Validación básica
            if (!inputTotal) {
                console.error('No se encontró el input total');
                return false;
            }

            // Formatear a 2 decimales
            const valorFormateado = parseFloat(nuevoTotal).toFixed(2);

            // Efecto visual de actualización
            inputTotal.classList.add('precio-actualizado');
            setTimeout(() => inputTotal.classList.remove('precio-actualizado'), 1000);

            // Actualizar valor
            inputTotal.value = valorFormateado;

            return true;
                    }
    </script>
    @endsection