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
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito as $item)
                <tr>
                    <td>{{ $item->producto->nom_producto }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                    <td>${{ number_format($item->cantidad * $item->producto->precio, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form method="POST" action="{{ route('carrito.confirmCheckout') }}">
            @csrf
    
            <!-- Método de entrega -->
            <div class="form-group">
                <label for="tipo_entrega">Método de entrega</label>
                <select id="tipo_entrega" name="tipo_entrega" class="form-control" onchange="toggleAddressField(this.value)" required>
                    <option value="retiro">Retiro en tienda</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>
    
            <!-- Dirección solo para invitados -->
            @if(auth()->user()->rol === 'invitado')
            <div id="direccion_field" style="display: none;">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa tu dirección">
            </div>
            @else
            <div id="direccion_field" class="mt-3">
                <label for="direccion" class="form-label">Dirección</label>
                <div class="alert alert-info p-2" role="alert">
                    <strong>{{ auth()->user()->direccion }}</strong>
                </div>
                <input type="hidden" id="direccion" name="direccion" value="{{ auth()->user()->direccion }}">
            </div>
            @endif


            <!-- Método de pago -->
            <div class="form-group">
                <label for="metodo_pago">Método de pago</label>
                <select id="metodo_pago" name="metodo_pago" class="form-control" required>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                </select>
            </div>
    
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>
    @endif 
</div>

<script>
    function toggleAddressField(tipoEntrega) {
        const addressField = document.getElementById('direccion_field');
        addressField.style.display = (tipoEntrega === 'delivery') ? 'block' : 'none';
    }
</script>
@endsection
