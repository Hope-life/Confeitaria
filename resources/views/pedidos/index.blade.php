@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Pedidos</h1>
    
        <!-- Exibe a mensagem de sucesso -->
        @if(session('message'))
            <div id="successMessage" class="alert alert-success mb-3">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
                
            <script>
                // Após 3 segundos (3000 milissegundos), a mensagem será ocultada
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000); // 3000 milissegundos = 3 segundos
            </script>
        @endif
        
        <!-- Botão para Adicionar Pedido -->
        <a href="{{ route('pedidos.create') }}" class="btn btn-success mb-3">
             <i class="fas fa-plus-circle"></i> Adicionar Pedido
        </a>

        <!-- Tabela de Pedidos -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Pedido</th> <!-- Nova coluna para Número do Pedido -->
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Status do Pedido</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->numero_pedido }}</td> <!-- Exibe o número do pedido -->
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{ $pedido->produto->nome }}</td>
                            <td>{{ $pedido->quantidade }}</td>
                            <td>R$ {{ number_format($pedido->preco_unitario, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}</td>
                            <td>{{ $pedido->status }}</td>
                            <td>
                                <!-- Botão de Visualizar -->
                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Visualizar
                                </a>

                                <!-- Botão de Editar -->
                                <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Botão de Exclusão com Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="setDeleteAction('{{ route('pedidos.destroy', $pedido->id) }}')">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
