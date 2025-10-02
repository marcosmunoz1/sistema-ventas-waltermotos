@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
  
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h2 class="brand-text font-weight-light mb-0">Listado de Roles</h2>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#crearRolModal">
                            <i class="fas fa-plus"></i> Nuevo Rol
                        </a>
                    </div>
                </div>
                <div class="col-md-10 mx-auto mt-4">
                    <div class="card">
                        <div class="card-body">
                            <table id="mitabla" class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 10%">#</th>
                                        <th style="width: 40%">Nombre del Rol</th>
                                        <th class="text-center" style="width: 40%">Acciones</th>
                                    </tr>
                                </thead>
                                <?php $contador = 1; ?>
                                <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <td class="text-center">{{ $contador++ }}</td>
                                            <td>{{ $rol->name }}</th>
                                            <td class="text-center">
                                                <a href="{{ url('/admin/roles/' . $rol->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="{{ url('/admin/roles/asignar/' . $rol->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fas fa-check"></i> Permisos</a>
                                                <form action="{{ url('/admin/roles', $rol->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $rol->id }})"
                                                    id="miFormulario{{ $rol->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Eliminar
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

    <!-- Modal para Crear Rol -->
    <div class="modal" id="crearRolModal" tabindex="-1" aria-labelledby="crearRolLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-file-alt"></i> Crear Nuevo Rol</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('/admin/roles/crear-rol') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fas fa-user-pen"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="name" class="form-control" required>
                                  </div>
                                @error('name')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Agregar Rol</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    @if ($errors->any())
        <script>
            // Muestra el modal si hay errores
            document.addEventListener("DOMContentLoaded", function() {
                $('#crearRolModal').modal('show');
            });
        </script>
    @endif

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar este Rol? ',
                text: 'Todos los usuarios con este rol se veran afectados',
                icon: 'question',
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
           ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "lengthMenu": "Mostrar _MENU_ Roles",
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

@stop
