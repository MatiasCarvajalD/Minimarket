@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Pedidos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->user->name }}</td>
                <td>{{ $pedido->total }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-success">Marcar como Completado</a>
                    <a href="#" class="btn btn-sm btn-danger">Cancelar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
