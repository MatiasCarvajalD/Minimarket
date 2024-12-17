@extends('layouts.app')
@include('partials.alerts')

@section('content')
    <div class="container">
        <h1>Detalle de la Compra</h1>
        <h3>Venta #{{ $venta->id_venta }}</h3>
        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
        <p><strong>Tipo de Entrega:</strong> {{ $venta->tipo_entrega == 1 ? 'Retiro' : 'Delivery' }}</p>
        <p><strong>Estado:</strong> {{ $venta->entrega_completada ? 'Completada' : 'Pendiente' }}</p>

        <h4>Productos</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($venta->detalles as $detalle)
                    @php
                        $subtotal = $detalle->cantidad * $detalle->valor_unidad;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $detalle->producto->nom_producto }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ $detalle->valor_unidad }}</td>
                        <td>${{ $subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total: ${{ $total }}</h3>
    </div>
@endsection
