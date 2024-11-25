@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
    <h2 class="text-center">Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login.submit') }}" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Iniciar Sesión</button>
    </form>
@endsection
