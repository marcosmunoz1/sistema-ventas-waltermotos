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
                        <a href="{{ url('admin/roles/crear-rol') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo
                            Rol</a>
                    </div>
                </div>
                <div class="col-md-10 mx-auto mt-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-hover">
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
                                                <a href="{{ url('/admin/roles', $rol->id) }}" class="btn btn-sm btn-info"><i
                                                        class="fas fa-eye"></i> Ver</a>
                                                <a href="{{ url('/admin/roles/' . $rol->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="{{ url('/admin/roles/asignar/' . $rol->id ) }}"
                                                    class="btn btn-sm btn-success"><i class="fas fa-check"></i> Permiso</a>
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
                title: '¿Desea eliminar este Rol? Todos los usuarios con este rol se veran afectados',
                text: '',
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
