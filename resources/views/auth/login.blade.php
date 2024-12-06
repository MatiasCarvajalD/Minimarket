@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
    <hr>
    <!-- Opción para iniciar como invitado -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="email" value="invitado@example.com">
        <input type="hidden" name="password" value="password_invitado"> <!-- Ajusta la contraseña según corresponda -->
        <button type="submit" class="btn btn-secondary">Iniciar como Invitado</button>
    </form>
    <hr>
    <!-- Enlace para registrarse -->
    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
</div>
@endsection
