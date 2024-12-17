@extends('layouts.app')
@include('partials.alerts')

@section('title', 'Login')

@section('content')
<div class="container">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
    <hr>
    <!-- Opción para iniciar como invitado -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="email" value="invitado@example.com">
        <input type="hidden" name="password" value="invitado"> <!-- Ajusta la contraseña según corresponda -->
        <button type="submit" class="btn btn-secondary">Iniciar como Invitado</button>
    </form>
    <hr>
    <!-- Enlace para registrarse -->
    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
</div>
@endsection
