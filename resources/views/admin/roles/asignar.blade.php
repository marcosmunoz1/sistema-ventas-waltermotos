@extends('adminlte::page')

@section('title', 'Asignar Permiso')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Asignar Permisos al Rol: <b>{{ $rol->name }}</b></h2>
    <hr>
@stop

@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="select-all">
                    <label class="form-check-label" for="select-all">Seleccionar todos</label>
                </div>
            </div>

            <form action="{{ url('/admin/roles/asignar', $rol->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Si estás actualizando un rol -->

                <div class="card-body">
                    <div class="row">
                        @foreach ($permisos as $modulo => $grupoPermisos)
                            <div class="col-md-2">
                                <h3>{{ $modulo }}</h3>
                                @foreach ($permisosDivididos[$modulo] as $grupo)  <!-- Acceder correctamente a los permisos divididos -->
                                    <div class="col-md-12">
                                        @foreach ($grupo as $permiso)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input permiso-checkbox"
                                                    name="permisos[]" value="{{ $permiso->id }}"
                                                    {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $permiso->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Botones de acción -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                    <a href="{{ url('admin/roles') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .permissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .permission-column {
            display: flex;
            flex-direction: column;
        }
    </style>
@stop

@section('js')

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            // Obtén todos los checkboxes de permisos
            const checkboxes = document.querySelectorAll('.permiso-checkbox');

            // Si el checkbox "Seleccionar todos" está marcado
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
@stop
