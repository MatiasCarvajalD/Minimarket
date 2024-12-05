@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">¡Compra Confirmada!</h1>

    <div class="alert alert-success">
        <strong>Gracias por tu compra.</strong> Tu pedido ha sido procesado exitosamente.
    </div>

    <div class="mb-3">
        <p><strong>Dirección de Envío:</strong> {{ $direccion }}</p>
        <p><strong>Tipo de Entrega:</strong> {{ $tipo_entrega == 'delivery' ? 'Delivery a Domicilio' : 'Retiro en Tienda' }}</p>
        <p><strong>Método de Pago:</strong> {{ $metodo_pago == 'efectivo' ? 'Efectivo' : 'Tarjeta' }}</p>
    </div>

    <h3>Total Pagado: ${{ number_format($total, 0, ',', '.') }}</h3>

    <a href="{{ route('carrito.index') }}" class="btn btn-primary mt-4">Volver al Carrito</a>
</div>
@endsection
