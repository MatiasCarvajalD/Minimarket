@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Confirmación de Compra</h1>
    <p>Gracias por tu compra. Aquí tienes los detalles de tu pedido:</p>

    <h3>Datos del Pedido</h3>
    <ul>
        <li><strong>Método de entrega:</strong> 
            {{ $venta->tipo_entrega === 'delivery' ? 'Delivery' : 'Retiro en tienda' }}
        </li>
        @if($venta->tipo_entrega === 'delivery')
            <li><strong>Dirección de entrega:</strong> {{ $venta->detallesCheckout->direccion ?? 'No especificada' }}</li>
        @endif
        <li><strong>Método de pago:</strong> {{ ucfirst($venta->metodo_pago) }}</li>
        <li><strong>Estado de entrega:</strong> {{ $venta->entrega_completada ? 'Completada' : 'Pendiente' }}</li>
    </ul>

    <h3>Datos del Comprador</h3>
    <ul>
        <li><strong>Nombre:</strong> {{ auth()->user()->nombre_usuario }}</li>
        <li><strong>Teléfono:</strong> {{ auth()->user()->telefono }}</li>
        <li><strong>Correo:</strong> {{ auth()->user()->email }}</li>
        <li><strong>Dirección Principal:</strong> 
            {{ auth()->user()->direcciones->first()?->calle ?? 'No registrada' }}
        </li>
    </ul>

    <h3>Productos Comprados</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nom_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->valor_unidad, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->valor_unidad, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <th>
                    ${{ number_format($venta->detalles->sum(fn($detalle) => $detalle->cantidad * $detalle->valor_unidad), 0, ',', '.') }}
                </th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
