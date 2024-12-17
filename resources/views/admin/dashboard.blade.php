@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Estadísticas Generales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total de Usuarios</h5>
                    <p class="card-text">{{ $totalUsuarios }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total de Productos</h5>
                    <p class="card-text">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Productos en Stock Crítico</h5>
                    <p class="card-text">{{ $stockCritico }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <p class="card-text">{{ $pedidosPendientes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ventas -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Gráfico de Ventas Mensuales
                </div>
                <div class="card-body">
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Actividades -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Últimos Pedidos
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($ultimosPedidos as $pedido)
                        <li class="list-group-item">
                            Pedido #{{ $pedido->id }} - {{ $pedido->fecha }} - 
                            <strong>{{ $pedido->entrega_completada ? 'Entregado' : 'Pendiente' }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Últimos Ajustes de Stock
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($ultimosAjustes as $ajuste)
                        <li class="list-group-item">
                            Producto: {{ $ajuste->cod_producto }} - Cantidad: {{ $ajuste->cantidad }} 
                            - {{ $ajuste->tipo_ajuste }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Ventas del Mes Anterior -->
        <div class="col-md-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Ventas del Mes Anterior</h5>
                    <p class="card-text">{{ $ventasMesAnterior }} ventas realizadas</p>
                </div>
            </div>
        </div>
    
        <!-- Compras del Mes Anterior -->
        <div class="col-md-6">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Compras del Mes Anterior</h5>
                    <p class="card-text">{{ $comprasMesAnterior }} compras registradas</p>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Notificaciones de Stock Crítico -->
    @if (isset($productosCriticos) && $productosCriticos->count() > 0)
        <div class="alert alert-warning mt-4">
            Hay {{ $productosCriticos->count() }} productos con stock crítico. ¡Revísalos!
        </div>
    @endif

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('ventasChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasLabels) !!}, // Ejemplo: ["Enero", "Febrero"]
            datasets: [{
                label: 'Ventas Mensuales',
                data: {!! json_encode($ventasData) !!}, // Ejemplo: [1500, 2000, 1800]
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
