@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Autenticarse para Iniciar Sesión')

@section('auth_body')
   

@section('classes_body', 'login-page bg-light') {{-- Cambia el color con clases de Bootstrap --}}



<form action="{{ route('login') }}" method="post">
    @csrf

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Contraseña" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    {{-- Remember Me --}}
    <div class="row mb-3">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Recordarme</label>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </div>
    </div>
</form>
@endsection

@section('auth_footer')
<p class="my-0">
    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
</p>
@endsection

