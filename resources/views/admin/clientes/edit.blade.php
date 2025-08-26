@extends('adminlte::page')

@section('content_header')
    <h1><b>Clientes/Modificación de los datos del cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <h5 class="text-center text-success"><i class="fas fa-id-card"></i> Datos Personales </h5>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre</label>
                                    <input type="text" name="nombre_cliente" class="form-control" required
                                        value="{{$cliente->nombre_cliente}}"
                                        placeholder="Ingrese nombre del cliente">
                                    @error('nombre_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apellido_cliente">Apellido</label>
                                    <input type="text" name="apellido_cliente" class="form-control" required
                                        value="{{$cliente->apellido_cliente}}"
                                        placeholder="Ingrese apellido del cliente">
                                    @error('apellido_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_nacimiento_cliente">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento_cliente" class="form-control"
                                        required value="{{\Carbon\Carbon::parse($cliente->fecha_nacimiento_cliente)->format('Y-m-d')}}">
                                    @error('fecha_nacimiento_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cuit_cliente">CUIT</label>
                                    <input type="text" name="cuit_cliente" class="form-control" required
                                        value="{{$cliente->cuit_cliente}}" placeholder="Ingrese CUIT del cliente">
                                    @error('cuit_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dni_cliente">DNI</label>
                                    <input type="text" name="dni_cliente" class="form-control" required
                                        value="{{$cliente->dni_cliente}}" placeholder="Ingrese DNI del cliente">
                                    @error('dni_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="profesion">Profesión</label>
                                    <input type="text" name="profesion" class="form-control" required
                                        value="{{$cliente->profesion}}"
                                        placeholder="Ingrese la profesion del cliente">
                                    @error('profesion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-md-3">
                                    <label>Estado civil</label>
                                    <select name="estado_civil_cliente" id="estado_civil_cliente" class="form-control" required>
                                        @foreach ($valores as $valor)
                                            <option value="{{ $valor->value }}" {{ $cliente->estado_civil_cliente === $valor->value ? 'selected' : '' }}>
                                                {{ ucfirst($valor->value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-body">
                                    <h5 class="text-center text-success mt-2"><i class="fas fa-phone-alt"></i> Datos
                                        De
                                        Contacto
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="celular_cliente">Celular</label>
                                                <input type="text" name="celular_cliente" class="form-control"
                                                    required value="{{$cliente->celular_cliente}}"
                                                    placeholder="Ingrese celular del cliente">
                                                @error('celular_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input type="email" name="email_cliente" class="form-control" required
                                                value="{{$cliente->email_cliente}}"
                                                placeholder="Ingrese un correo electrónico">
                                            @error('email_cliente')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-body">
                                    <h5 class="text-center text-success mt-2"><i class="fas fa-map-marker-alt"></i>
                                        Datos De Direccion
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="calle">Calle</label>
                                                <input type="text" name="calle" class="form-control"
                                                    required value="{{$cliente->calle}}"
                                                    placeholder="Ingrese la calle y numero del cliente">
                                                @error('calle')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <input type="text" name="ciudad" class="form-control"
                                                    required value="{{$cliente->ciudad}}"
                                                    placeholder="Ingrese la ciudad del cliente">
                                                @error('ciudad')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <input type="text" name="provincia" class="form-control"
                                                    required value="{{$cliente->provincia}}"
                                                    placeholder="Ingrese la provincia del cliente">
                                                @error('provincia')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Bloque del cónyuge -->
                        <div id="form_conyugue" style="display: none;">
                            <div class="row">
                                <div class="card card-body border-success shadow-sm">
                                    <h5 class="text-center text-success mb-3">
                                        <i class="fas fa-user-friends"></i> Datos del Cónyuge
                                    </h5>

                                    <div id="camposConyugue">
                                        <div id="errorConyugue" class="alert alert-danger d-none">
                                            Debe completar todos los datos del cónyuge para poder registrar al cliente.
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre_conyugue">Nombre</label>
                                                <input type="text" class="form-control" id="nombre_conyugue" name="nombre_conyugue"
                                                    value="{{optional($cliente->conyugue)->nombre_conyugue}}" placeholder="Ingresar nombre del cónyuge">
                                                @error('nombre_conyugue')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="apellido_conyugue">Apellido</label>
                                                <input type="text" class="form-control" id="apellido_conyugue" name="apellido_conyugue"
                                                    value="{{optional($cliente->conyugue)->apellido_conyugue}}" placeholder="Ingresar apellido del cónyuge">
                                                @error('apellido_conyugue')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dni_conyugue">DNI</label>
                                                <input type="text" class="form-control" id="dni_conyugue" name="dni_conyugue"
                                                    value="{{optional($cliente->conyugue)->dni_conyugue}}" placeholder="Ingresar DNI del cónyuge">
                                                @error('dni_conyugue')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="fecha_nacimiento_conyugue">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento_conyugue"
                                                    value="{{isset(optional($cliente->conyugue)->fecha_nacimiento_conyugue) ? \Carbon\Carbon::parse($cliente->conyugue->fecha_nacimiento_conyugue)->format('Y-m-d') : '' }}" name="fecha_nacimiento_conyugue">
                                                @error('fecha_nacimiento_conyugue')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="celular_conyugue">Celular</label>
                                            <input type="text" class="form-control" id="celular_conyugue" name="celular_conyugue"
                                                value="{{optional($cliente->conyugue)->celular_conyugue}}" placeholder="Ingresar celular del cónyuge">
                                            @error('celular_conyugue')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 ml-auto">
                                <a href="{{ url('admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estadoCivilSelect = document.getElementById('estado_civil_cliente');
            const formConyugue = document.getElementById('form_conyugue');

            function toggleFormConyugue() {
                if (estadoCivilSelect.value === 'Casado' || estadoCivilSelect.value === 'En Concubinato') {
                    formConyugue.style.display = 'block';
                } else {
                    formConyugue.style.display = 'none';
                }
            }

            estadoCivilSelect.addEventListener('change', toggleFormConyugue);
            toggleFormConyugue(); // Ejecutar al cargar
        });
    </script>
@stop
