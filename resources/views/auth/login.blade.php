@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Iniciar Sesión</h1>
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="email" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
    <a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate</a>
    <br>
    <a href="{{ route('guest.login') }}" class="btn btn-secondary">Entrar como Invitado</a>

</div>
@endsection
