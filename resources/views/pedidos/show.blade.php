@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Pedido</h1>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Cliente:</th>
                    <td>{{ $pedido->cliente->nome }}</td>
                </tr>
                <tr>
                    <th>Produto:</th>
                    <td>{{ $pedido->produto->nome }}</td>
                </tr>
                <tr>
                    <th>Quantidade:</th>
                    <td>{{ $pedido->quantidade }}</td>
                </tr>
                <tr>
                    <th>Preço Unitário:</th>
                    <td>R$ {{ number_format($pedido->preco_unitario, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Subtotal:</th>
                    <td>R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>{{ $pedido->status }}</td>
                </tr>
                <tr>
                    <th>Método de Pagamento:</th>
                    <td>{{ $pedido->metodo_pagamento }}</td>
                </tr>
                <tr>
                    <th>Observações:</th>
                    <td>{{ $pedido->observacoes }}</td>
                </tr>
                <tr>
                    <th>Data de Criação:</th>
                    <td>{{ $pedido->data_inicio }}</td>
                </tr>
                
            </table>
        </div>

        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
