@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
    <p class="mt-3">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>.</p>
</div>
@endsection
