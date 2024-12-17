@extends('layouts.admin')
@include('partials.alerts')
@section('content')
<div class="container">
    <h2>Registrar Compra</h2>
    <form action="{{ route('admin.compras.guardar') }}" method="POST">
        @csrf
        <!-- Proveedor -->
        <div class="mb-3">
            <label for="rut_proveedor" class="form-label">Proveedor</label>
            <select name="rut_proveedor" id="rut_proveedor" class="form-select" required>
                <option value="" selected disabled>Seleccione un proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->rut_proveedor }}">
                        {{ $proveedor->nom_proveedor }} ({{ $proveedor->rut_proveedor }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Detalle General -->
        <div class="mb-3">
            <label for="detalle_general" class="form-label">Detalle General</label>
            <textarea name="detalle_general" id="detalle_general" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Detalles de Productos -->
        <h4>Detalles de Productos</h4>
        <div id="productos">
            <div class="row mb-3 producto">
                <div class="col-md-4">
                    <label for="cod_producto" class="form-label">Producto</label>
                    <select name="productos[0][cod_producto]" class="form-select" required>
                        <option value="" selected disabled>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->cod_producto }}">
                                {{ $producto->nom_producto }} - ${{ $producto->precio }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="productos[0][cantidad]" class="form-control" min="1" required>
                </div>
                <div class="col-md-2">
                    <label for="precio_unitario" class="form-label">Precio Unitario</label>
                    <input type="number" name="productos[0][precio_unitario]" class="form-control" min="0" required>
                </div>
                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="productos[0][descripcion]" class="form-control">
                </div>
            </div>
        </div>

        <!-- Botón para agregar más productos -->
        <button type="button" class="btn btn-secondary mb-3" id="agregar-producto">Agregar Producto</button>

        <!-- Botón de enviar -->
        <button type="submit" class="btn btn-primary">Registrar Compra</button>
    </form>
</div>

<script>
document.getElementById('agregar-producto').addEventListener('click', function () {
    const productos = document.getElementById('productos');
    const index = productos.children.length;

    const productoRow = `
        <div class="row mb-3 producto">
            <div class="col-md-4">
                <select name="productos[${index}][cod_producto]" class="form-select" required>
                    <option value="" selected disabled>Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->cod_producto }}">
                            {{ $producto->nom_producto }} - ${{ $producto->precio }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="productos[${index}][cantidad]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="productos[${index}][precio_unitario]" class="form-control" min="0" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="productos[${index}][descripcion]" class="form-control">
            </div>
        </div>
    `;
    productos.insertAdjacentHTML('beforeend', productoRow);
});
</script>
@endsection
