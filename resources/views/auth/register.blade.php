@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="container">
    <h1>Registro</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_usuario">Nombre</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    
</div>
@endsection
