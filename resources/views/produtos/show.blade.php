@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Produto</h1>

        <table class="table">
            <tr>
                <th>Nome:</th>
                <td>{{ $produto->nome }}</td>
            </tr>
            <tr>
                <th>Preço Unitário:</th>
                <td>R$ {{ number_format($produto->preco_unitario, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Categoria:</th>
                <td>{{ $produto->categoria }}</td>
            </tr>
            <tr>
                <th>Estoque:</th>
                <td>{{ $produto->estoque }}</td>
            </tr>
        </table>

        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
