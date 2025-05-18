@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h2 class="brand-text font-weight-light "><b>Listado de Compras</b>
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Compras registradas</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/compras/crear-compra') }}" class="btn btn-primary"> <i
                            class="fas fa-plus"></i> Nueva Compra</a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tablaCompras">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 10%">Proveedor</th>
                                        <th class="text-center" style="width: 10%">Celular</th>
                                        <th class="text-center" style="width: 10%">Fecha</th>
                                        <th class="text-center" style="width: 10%">N.Factura</th>
                                        <th class="text-center" style="width: 10%">Total</th>
                                        <th class="text-center" style="width: 15%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($motos as $moto)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">{{ $contador++ }}</td>
                                            <td class="text-center"style="vertical-align: middle">
                                                {{ $moto->compra->proveedor->nombre_proveedor}}</td>
                                                <td class="text-center"style="vertical-align: middle"> {{ $moto->compra->proveedor->celular }}
                                                <td class="text-center"style="vertical-align: middle"> {{ \App\Helpers\Helpers::cambiaFormatoFecha(($moto->compra->fecha_compra))}}</td>
                                                </td>
                                            </td>
                                            <td class="text-center"style="vertical-align: middle"> {{ $moto->compra->numero_factura }}
                                            </td>
                                            <td class="text-center"style="vertical-align: middle;color:red;">${{number_format($moto->compra->total_compra, 2, ',', '.')  }}</td>


                                            <td class="text-center" style="vertical-align: middle">
                                               <button class="btn btn-sm btn-info"
                                                        onclick="abrir_modal(
                                                            'ventana_modal',
                                                            'Detalle Compra: {{$moto->compra->numero_factura}}',
                                                            ['numero_factura', 'numero_remito'],
                                                            {{ json_encode($moto->compra->toArray()) }}
                                                        )">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('/admin/compras/' . $moto->compra->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('/admin/compras', $moto->compra->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $moto->compra->id }})"
                                                    id="miFormulario{{ $moto->compra->id }}">
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
  <div class="row">
   <div class="modal fade" id="ventana_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ventana_modal_titulo"></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ventana_modal_body">
                <!-- Contenido dinámico -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">N° Factura</label>
                            <input type="text" id="numero_factura" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">N° Remito</label>
                            <input type="text" id="numero_remito" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Fecha Compra</label>
                            <input type="text" id="fecha_compra" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Total</label>
                            <input type="text" id="total_compra" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <h5 class="font-weight-bold mb-3">Detalle de moto</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_motos">
                            <!-- Filas de motos se agregarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endsection

@section('js')

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar esta Compra?',
                text: 'Los cambios seran permanentes',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonColor: '#270a0a',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('miFormulario' + id);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>

    <script>
        $('#tablaCompras').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "lengthMenu": "Mostrar _MENU_ Compras",
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
    </script>
<script>
  function abrir_modal(modal, title, campos, dato) {
    // Mostrar el modal y establecer título
    $(`#${modal}`).modal('show');
    $(`#${modal}_titulo`).text(title);
    const $tablaMotos = $('#tabla_motos'); // Definir aquí

    // Limpiar tabla de motos
    $('#tabla_motos').empty();
/*
    // Mostrar spinner mientras se cargan los detalles completos
    $('#tabla_motos').html('<tr><td colspan="4" class="text-center"><div class="spinner-border"></div></td></tr>'); */

    // Llenar campos básicos
    if(campos && campos.length >= 1) {
        campos.forEach((campo) => {
            const $element = $(`#${campo}`);
            if($element.length) {
                $element.val(dato[campo] || 'N/A');
            }
        });
        $('#id').val(dato.id || 0);
    }

    // Cargar detalles asíncronos solo si hay ID
    if(dato?.id) {
        $.ajax({
            url: "{{url('admin/compras/show')}}/"+dato.id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Validar respuesta
                if(!response || !response.motos) {
                    throw new Error('Respuesta inválida');
                }

                // Actualizar campos
                $('#fecha_compra').val(response.fecha_formateada || 'N/A');
                $('#total_compra').val(response.total_formateado ? '$' + response.total_formateado : '$0.00');

                // Generar filas de motos
                const motosHtml = response.motos.map(moto => `
                    <tr>
                        <td>${moto.marca_nombre || 'Sin marca'}</td>
                        <td>${moto.modelo || 'N/A'}</td>
                        <td>${moto.color || 'N/A'}</td>
                        <td>${moto.precio ? '$' + moto.precio : '$0.00'}</td>
                    </tr>
                `).join('');

                $tablaMotos.html(motosHtml);
            },
            error: function(xhr, status, error) {
                let errorMsg = 'Error al cargar detalles';
                if(xhr.responseJSON?.message) {
                    errorMsg += `: ${xhr.responseJSON.message}`;
                }
                $tablaMotos.html(`<tr><td colspan="4" class="text-danger">${errorMsg}</td></tr>`);
            }
        });
    } else {
        $tablaMotos.html('<tr><td colspan="4" class="text-warning">No hay datos de motos disponibles</td></tr>');
    }
    }
</script>

@endsection
