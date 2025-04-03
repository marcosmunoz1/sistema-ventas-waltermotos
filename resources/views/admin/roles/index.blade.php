@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Listado de Roles
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Roles Registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#crearRolModal">
                            <i class="fas fa-plus"></i> Nuevo Rol
                        </a>
                    </div>
                </div>
                <div class="col-md-10 mx-auto mt-4">
<<<<<<< HEAD
                    <div class="card ">
                        <div class="card-body ">
                            <div class="d-flex justify-content-center">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
=======
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
>>>>>>> ebac8b4953d9087f5096e6c70c2a8b0e6702f611
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
                                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>
                                                        Editar</a>
                                                    <a href="{{ url('/admin/roles/asignar/' . $rol->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                                        Permisos</a>
                                                    <form action="{{ url('/admin/roles', $rol->id) }}" method="post"
                                                        class="d-inline-block"
                                                        onsubmit="preguntar(event, {{ $rol->id }})"
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
        <div class="modal fade" id="crearRolModal" tabindex="-1" aria-labelledby="crearRolLabel" aria-hidden="true"
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
                        <form action="{{ url('/admin/roles/crear-rol') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre del Rol</label>
                                    <input type="text"name="name" class="form-control" required
                                        value="{{ old('name') }}" placeholder="Ingrese un nombre de rol">
                                    @error('name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar Orden</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                        class="fas fa-cancel"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
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
        // limpiar el formulario recargamos la pagina
        document.addEventListener("DOMContentLoaded", function() {
            $('#crearRolModal').on('hidden.bs.modal', function() {
                window.location.href = "{{ url()->current() }}"; // Recarga la página y limpia errores
            });
        });
    </script>

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
@stop
