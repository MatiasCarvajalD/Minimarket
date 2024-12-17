@extends('layouts.app')
@include('partials.alerts')

@section('title', 'Finalizar Compra')

@section('content')
<div class="container">
    <h1>Finalizar Compra</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito as $item)
                <tr>
                    <td>{{ $item->producto->nom_producto }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                    <td>${{ number_format($item->producto->precio * $item->cantidad, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <form action="{{ route('carrito.confirmCheckout') }}" method="POST">
        @csrf
        
        <!-- Tipo de Entrega -->
        <h2>Tipo de Entrega</h2>
        <div class="mb-3">
            <select name="tipo_entrega" class="form-select" required onchange="toggleDireccion(this)">
                <option value="retiro">Retiro en Tienda</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>

        <!-- Dirección -->
        <div class="mb-3" id="direccion-container" style="display: none;">
            <label for="direccion" class="form-label">Dirección</label>
            @if (auth()->user()->rol === 'invitado')
                <input type="text" name="direccion" class="form-control" placeholder="Ingrese su dirección">
            @else
                <select name="direccion_id" class="form-select">
                    @foreach ($direcciones as $direccion)
                        <option value="{{ $direccion->id }}">
                            {{ $direccion->calle }}, {{ $direccion->ciudad }}, {{ $direccion->region }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <!-- Información para Invitados -->
        @if (auth()->user()->rol === 'invitado')
            <h2>Información del Invitado</h2>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" required>
            </div>
        @endif

        <!-- Método de Pago -->
        <h2>Método de Pago</h2>
        <div class="mb-3">
            <select name="metodo_pago" class="form-select" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
            </select>
        </div>

        <!-- Botón de Envío -->
        <button type="submit" class="btn btn-success">Proceder al Pago</button>
    </form>
</div>

<script>
    // Mostrar u ocultar el contenedor de dirección según el tipo de entrega
    function toggleDireccion(select) {
        const direccionContainer = document.getElementById('direccion-container');
        direccionContainer.style.display = (select.value === 'delivery') ? 'block' : 'none';
    }
</script>
@endsection
