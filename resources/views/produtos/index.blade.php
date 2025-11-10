@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Produtos</h1>

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
        <!-- Botão para Adicionar Produto -->
        <a href="{{ route('produtos.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Adicionar Produto
        </a>

        <!-- Tabela de Produtos -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Preço Unitário</th>
                        <th>Categoria</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>R$ {{ number_format($produto->preco_unitario, 2, ',', '.') }}</td>
                            <td>{{ $produto->categoria }}</td>
                            <td>{{ $produto->estoque }}</td>
                            <td>
                                <!-- Botões de ação com ícones -->
                                <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Visualizar
                                </a>
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                     <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="setDeleteAction('{{ route('produtos.destroy', $produto->id) }}')">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
