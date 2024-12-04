@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Finalizar Compra</h1>
        @if($carrito->isEmpty())
            <p>No hay productos en el carrito.</p>
        @else
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
                    @foreach($carrito as $item)
                        @php $subtotal = $item->cantidad * $item->producto->precio; @endphp
                        @php $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item->producto->nom_producto }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ $item->producto->precio }}</td>
                            <td>${{ $subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total: ${{ $total }}</h3>

            <form action="{{ route('carrito.confirmCheckout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de Envío</label>
                    <input type="text" name="direccion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select name="metodo_pago" class="form-select" required>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Confirmar Compra</button>
            </form>
        @endif
    </div>
@endsection
