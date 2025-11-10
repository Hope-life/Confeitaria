@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Clientes</h1>

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

        <!-- Botão para Adicionar Cliente -->
        <a href="{{ route('clientes.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Adicionar Cliente
        </a>

        <!-- Tabela de Clientes -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>{{ $cliente->endereco }}</td>
                            <td>
                                <!-- Botão Visualizar -->
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Visualizar
                                </a>

                                <!-- Botão Editar -->
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Formulário Deletar -->
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                     <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="setDeleteAction('{{ route('clientes.destroy', $cliente->id) }}')">
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


