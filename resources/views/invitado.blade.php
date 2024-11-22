@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido, Invitado</h1>
    <p>Estás navegando como invitado. Algunas funcionalidades pueden estar restringidas.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
</div>
@endsection
