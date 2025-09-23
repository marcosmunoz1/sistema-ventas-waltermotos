@extends('layouts.app')

@section('title', 'Motos')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-primary mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Listado de Motos</h2>
                            {{-- <div class="card-tools">
                        <a href="{{ url('admin/motos/crear-moto') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Nueva Moto</a>
                    </div> --}}
                        </div>
                        <div class="col-md-12 mx-auto mt-2">

                            <!-- Tabla -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped" id="mitabla">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">#</th>
                                                <th class="text-center" style="width: 10%">Marca</th>
                                                <th class="text-center" style="width: 10%">Modelo</th>
                                                <th class="text-center" style="width: 5%">Año</th>
                                                <th class="text-center" style="width: 10%">Nacionalidad</th>
                                                <th class="text-center" style="width: 10%">P. Compra</th>
                                                <th class="text-center" style="width: 10%">P. Venta</th>
                                                <th class="text-center" style="width: 10%">Condicion</th>
                                                <th class="text-center" style="width: 10%">Imagen</th>
                                                <th class="text-center" style="width: 10%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $contador = 1; ?>
                                            @foreach ($motos as $moto)
                                                <tr>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        {{ $contador++ }}</td>
                                                    <!-- Marca de la moto, usando la relación -->
                                                    <td class="text-center" style="vertical-align: middle">
                                                        {{ $moto->marca->nombre_marca }}</td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        {{ $moto->modelo_moto }}</td>

                                                    <td class="text-center" style="vertical-align: middle">
                                                        {{ $moto->anio_moto }}</td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        {{ $moto->nacionalidad->pais }}</td>
                                                    <td class="text-right text-success" style="vertical-align: middle">
                                                        ${{ number_format($moto->precio_compra, 2, ',', '.') }}</td>
                                                    <td class="text-right text-danger" style="vertical-align: middle">
                                                        ${{ number_format($moto->precio_venta, 2, ',', '.') }}</td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        @php
                                                            $colores = [
                                                                'vendida' => 'danger',
                                                                'en_stock' => 'success',
                                                                'garantia' => 'warning',
                                                                'devuelta' => 'secondary',
                                                            ];
                                                            $color = $colores[$moto->condicion] ?? 'light';
                                                        @endphp
                                                        <span class="badge bg-{{ $color }}">
                                                            {{ ucfirst(str_replace('_', ' ', $moto->condicion)) }}
                                                        </span>
                                                    </td>

                                                    <td class="text-center" style="vertical-align: middle">
                                                        <img src="{{ asset($moto->imagen_moto) }}" width="40%"
                                                            alt="">

                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{ url('/admin/motos', $moto->id) }}"
                                                                class="btn btn-sm btn-info" title="Ver moto"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a href="{{ url('/admin/motos/' . $moto->id . '/edit') }}"
                                                                class="btn btn-sm btn-warning" title="Editar moto"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <a href="{{ url('/admin/compras/' . $moto->compra->id) }}?from=motos"
                                                                class="btn btn-secondary btn-sm" title="Ver compra">
                                                                <i class="fa-solid fa-cart-shopping"></i>
                                                            </a>


                                                            {{--  <form action="{{ url('/admin/motos', $moto->id) }}"
                                                                method="post" class="d-inline-block"
                                                                onsubmit="preguntar(event, {{ $moto->id }})"
                                                                id="miFormulario{{ $moto->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 0px 4px 4px 0px">
                                                                    <i class="fas fa-trash"></i>
                                                                </button> --}}
                                                        </div>
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
@stop

@section('css')
    {{-- Agregar aquí hojas de estilo adicionales --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar esta Moto?',
                text: 'Tenga en cuenta que todas las transacciones asociadas se verán afectadas.',
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
        $('#mitabla').DataTable({
            "pageLength": 8,
            "order": [
                [0, "desc"]
            ],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Motos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Motos",
                "infoFiltered": "(Filtrado de _MAX_ total Motos)",
                "lengthMenu": "Mostrar _MENU_ Motos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    </script>
@stop
