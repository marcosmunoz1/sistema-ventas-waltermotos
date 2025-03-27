@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Listado de Usuarios
        {{-- <b>{{ $empresa->nombre_empresa }}</b> --}}
    </h2>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/usuarios/crear-usuario') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Nuevo
                            Usuario</a>
                    </div>
                </div>
                <div class="col-md-12 mx-auto mt-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th style="width: 25%">Nombre del Usuario</th>
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
                                            <td>{{ $usuario->email }}</td>
                                          {{--   <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td> --}}
                                            <td class="text-center">
                                                <a href="{{ url('/admin/usuarios', $usuario->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver</a>
                                                <a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                                <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="post"
                                                    class="d-inline-block" onsubmit="preguntar(event, {{ $usuario->id }})"
                                                    id="miFormulario{{ $usuario->id }}">
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
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

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
@stop
