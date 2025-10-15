@extends('layouts.app')

@section('title', 'Asignar Permiso')

@section('content_header')
    <h2 class="brand-text font-weight-light ">Asignar Permisos al Rol: <b>{{ $rol->name }}</b></h2>
    
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
                @method('PUT')

                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h5 class="text-primary mb-3">⚙️ Configuración del Sistema</h5>
                        <div class="row">
                            @foreach (['Usuarios', 'Roles', 'Permisos'] as $modulo)
                                @if (isset($permisos[$modulo]))
                                    <div class="col-md-2">
                                        <h4>{{ $modulo }}</h4>
                                        @foreach ($permisosDivididos[$modulo] as $grupo)
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-primary mb-3">🧩 Otros Módulos</h5>
                    <div class="row">
                        @foreach ($permisos as $modulo => $grupoPermisos)
                            @if (!in_array($modulo, ['Usuarios', 'Roles', 'Permisos']))
                                <div class="col-md-2">
                                    <h3>{{ $modulo }}</h3>
                                    @foreach ($permisosDivididos[$modulo] as $grupo)
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
                            @endif
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
