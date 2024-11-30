@extends('layouts.app')

@section('title', 'Detalles de Venta')

@section('content')
<h1>Detalles de la Venta</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($venta->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nom_producto }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>${{ number_format($detalle->producto->precio, 0, ',', '.') }}</td>
                <td>${{ number_format($detalle->cantidad * $detalle->producto->precio, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3>Total: ${{ number_format($venta->total, 0, ',', '.') }}</h3>
@endsection
