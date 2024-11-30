@extends('layouts.app')

@section('title', 'Gestión de Ventas')

@section('content')
<h1>Historial de Ventas</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>{{ $venta->usuario->nombre_usuario }}</td>
                <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info btn-sm">Ver Detalle</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
