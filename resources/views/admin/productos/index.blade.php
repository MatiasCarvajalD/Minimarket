@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    <!-- Mensaje de éxito -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @forelse($productos as $producto)
                    <tr>
                        
                        <td>{{ $producto->cod_producto }}</td>
                        <td>{{ $producto->nom_producto }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>${{ $producto->precio }}</td>
                        <td>{{ $producto->stock_actual }}</td>
                        <td>{{ $producto->tipoProducto->categoria }}</td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->cod_producto) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->cod_producto) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
