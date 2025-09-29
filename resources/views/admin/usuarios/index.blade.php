@extends('layouts.app')


@section('title', 'Usuarios')

@section('content_header')

@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-outline card-primary mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h2 class="brand-text font-weight-light mb-0">Lista de Usuarios</h2>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioModal"><i
                                    class="fas fa-plus"></i>
                                Nuevo Usuario</a>
                        </div>

                        <div class="col-md-10 mx-auto mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <table id="mitabla" class="table table-striped table-sm table-hover" id="tablaProductos">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="text-center" style="width: 5%">#</th>
                                                <th style="width: 25%">Nombre</th>
                                                <th style="width: 25%">Rol</th>
                                                <th style="width: 30%">Correo</th>
                                                {{--    <th style="width: 10%">Rol</th> --}}
                                                <th class="text-center" style="width: 30%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <?php $contador = 1; ?>
                                        <tbody>
                                            @foreach ($usuarios as $usuario)
                                                <tr>
                                                    <td class="text-center ">{{ $contador++ }}</td>
                                                    <td>{{ $usuario->name }}</td>
                                                    <td>{{ $usuario->roles->pluck('name')->join(', ') }}</td>
                                                    <td>{{ $usuario->email }}</td>
                                                    {{--   <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td> --}}
                                                    <td style="text-align: center;vertical-align:middle;">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{ url('/admin/usuarios', $usuario->id) }}"
                                                                class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                            <a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}"
                                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ url('/admin/usuarios', $usuario->id) }}"
                                                                method="post" class="d-inline-block"
                                                                onsubmit="preguntar(event, {{ $usuario->id }})"
                                                                id="miFormulario{{ $usuario->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    style="border-radius: 0px 4px 4px 0px">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

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


    <!-- Modal para Crear Rol -->
    <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-file-alt"></i> Crear Nuevo Rol</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar"
                        onclick="cerrarModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('/admin/usuarios/crear-usuario') }}" method="post">
                        @csrf

                        <!-- Primera fila: Nombre de Usuario y Nombre del Rol -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre de Usuario</label>
                                    <input type="text" name="name" class="form-control" required
                                        value="{{ old('name') }}" placeholder="Ingrese un nombre de usuario">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Rol</label>
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Segunda fila: Correo -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="{{ old('email') }}" placeholder="Ingrese un correo electrónico">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tercera fila: Contraseña -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" required
                                        placeholder="Ingrese su contraseña">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirme su contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control" required
                                        placeholder="Repita su contraseña">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Registrar
                            </button>
                            <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>

                    </form> <!-- Cierre correcto del formulario -->
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
                $('#crearUsuarioModal').modal('show');
            });
        </script>
    @endif


    <script>
        // limpiar el formulario recargamos la pagina
        document.addEventListener("DOMContentLoaded", function() {
            $('#crearUsuarioModal').on('hidden.bs.modal', function() {
                window.location.href = "{{ url()->current() }}"; // Recarga la página y limpia errores
            });
        });
    </script>

    <script>
        function preguntar(event, id) {
            event.preventDefault();

            Swal.fire({
                title: '¿Desea eliminar este Usuario?',
                text: 'El mismo ya no tendra acceso al sistema.',
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
           ordering: false,
            "language": {
                "emptyTable": "No hay información.",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
