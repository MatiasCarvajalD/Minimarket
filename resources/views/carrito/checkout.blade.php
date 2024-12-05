@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Checkout</h1>

    @if ($carrito->isEmpty())
        <div class="alert alert-warning" role="alert">
            Tu carrito está vacío. Agrega productos para continuar.
        </div>
    @else
        <!-- Resumen del carrito -->
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($carrito as $item)
                    @php
                        $subtotal = $item->cantidad * $item->producto->precio;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->producto->nom_producto }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                        <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="text-end">Total: ${{ number_format($total, 0, ',', '.') }}</h3>

        <form action="{{ route('carrito.confirmCheckout') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tipo_entrega" class="form-label">Tipo de Entrega</label>
                <select name="tipo_entrega" id="tipo_entrega" class="form-select" required>
                    <option value="">Selecciona una opción</option>
                    <option value="retiro">Retiro en Tienda</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección de Envío (solo para delivery)</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>
            <div class="mb-3">
                <label for="metodo_pago" class="form-label">Método de Pago</label>
                <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                    <option value="">Selecciona una opción</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Confirmar Compra</button>
        </form>
        
        
    @endif
</div>
@endsection
