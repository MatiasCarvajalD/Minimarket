@extends('layouts.admin')
@include('partials.alerts')
@section('content')
<div class="container">
    <h1>Lista de Ajustes</h1>
    <a href="{{ route('admin.ajustes.create') }}" class="btn btn-primary">Crear Ajuste</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ajustes as $ajuste)
                <tr>
                    <td>{{ $ajuste->id_ajuste }}</td>
                    <td>{{ $ajuste->producto->nom_producto }}</td>
                    <td>{{ $ajuste->cantidad }}</td>
                    <td>{{ ucfirst($ajuste->tipo_ajuste) }}</td>
                    <td>{{ $ajuste->fecha }}</td>
                    <td>{{ $ajuste->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
