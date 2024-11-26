@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
    <h2 class="text-center">Iniciar Sesión</h2>
    @if ($errors->has('login'))
    <div class="alert alert-danger">
        {{ $errors->first('login') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
@endsection
