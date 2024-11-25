@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de Entrega</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                <option value="tarjeta">Tarjeta</option>
                <option value="efectivo">Efectivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar Compra</button>
    </form>
</div>
@endsection
