@extends('layouts.app')

@section('title', 'Registrar Compra')

@section('content')
    <h1>Registrar Compra</h1>
    <form action="{{ route('admin.compras.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <select name="proveedor" id="proveedor" class="form-control" required>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nom_proveedor }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="productos">Productos</label>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>
                                <input type="checkbox" name="productos[{{ $producto->cod_producto }}][seleccionado]">
                                {{ $producto->nom_producto }}
                            </td>
                            <td>
                                <input type="number" name="productos[{{ $producto->cod_producto }}][cantidad]" min="1" class="form-control">
                            </td>
                            <td>
                                <input type="number" name="productos[{{ $producto->cod_producto }}][precio]" min="0" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn">Registrar Compra</button>
    </form>
@endsection
