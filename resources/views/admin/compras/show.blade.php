@extends('layouts.admin')
@include('partials.alerts')
@section('content')
<h1>Detalles de la Compra</h1>

<table class="table">
    <tr>
        <th>Código:</th>
        <td>{{ $compra->cod_compra }}</td>
    </tr>
    <tr>
        <th>Proveedor:</th>
        <td>
           @if ($compra->proveedor)
                {{ $compra->proveedor->nom_proveedor }}
            @else
                <span class="text-danger">Proveedor no disponible</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Fecha:</th>
        <td>{{ $compra->fecha }}</td>
    </tr>
    <tr>
        <th>Detalle General:</th>
        <td>{{ $compra->detalle_general }}</td>
    </tr>
</table>

<h2>Productos</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Valor Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($compra->detalles as $detalle)
        <tr>
            <td>{{ $detalle->producto->nom_producto }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ $detalle->valor_unitario }}</td>
            <td>{{ $detalle->subtotal }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
