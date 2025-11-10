@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Cliente</h1>

        <table class="table">
            <tr>
                <th>Nome:</th>
                <td>{{ $cliente->nome }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $cliente->email }}</td>
            </tr>
            <tr>
                <th>Telefone:</th>
                <td>{{ $cliente->telefone }}</td>
            </tr>
            <tr>
                <th>Endereço:</th>
                <td>{{ $cliente->endereco }}</td>
            </tr>
        </table>

        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
