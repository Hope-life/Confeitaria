@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Criar Novo Pedido</h1>

        <!-- Exibe as mensagens de erro -->
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Exibe a mensagem de erro de estoque insuficiente -->
        @if(session('message'))
            <div class="alert alert-danger mb-3">
                {{ session('message') }}
            </div>
        @endif

        <!-- Formulário para criar pedido -->
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <!-- Cliente -->
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" required onchange="atualizarEndereco()">
                    <option value="">Selecione um Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produto -->
            <div class="form-group mt-3">
                <label for="produto_id">Produto</label>
                <select name="produto_id" id="produto_id" class="form-control" required onchange="atualizarPrecoUnitario()">
                    <option value="">Selecione um Produto</option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}
                            data-preco="{{ number_format($produto->preco_unitario, 2, ',', '.') }}">
                            {{ $produto->nome }} (R$ {{ number_format($produto->preco_unitario, 2, ',', '.') }}) - Estoque: {{ $produto->estoque }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Endereço do Cliente -->
            <div class="form-group mt-3">
                <label for="endereco_cliente">Endereço do Cliente</label>
                <input type="text" name="endereco_cliente" id="endereco_cliente" class="form-control" value="{{ old('endereco_cliente') }}" required readonly>
            </div>

            <!-- Quantidade -->
            <div class="form-group mt-3">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ old('quantidade') }}" required>
            </div>

            <!-- Preço Unitário -->
            <div class="form-group mt-3">
                <label for="preco_unitario">Preço Unitário</label>
                <input type="text" name="preco_unitario" id="preco_unitario" class="form-control" value="{{ old('preco_unitario') }}" required readonly>
            </div>

            <!-- Subtotal -->
            <div class="form-group mt-3">
                <label for="subtotal">Subtotal</label>
                <input type="text" name="subtotal" id="subtotal" class="form-control" value="{{ old('subtotal') }}" required readonly>
            </div>

            <!-- Data de Início -->
            <div class="form-group mt-3">
                <label for="data_inicio">Data de Criação</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ old('data_inicio') }}" required>
            </div>

            <!-- Método de Pagamento -->
            <div class="form-group mt-3">
                <label for="metodo_pagamento">Método de Pagamento</label>
                <select name="metodo_pagamento" id="metodo_pagamento" class="form-control" required>
                    <option value="CREDITO" {{ old('metodo_pagamento') == 'CREDITO' ? 'selected' : '' }}>Crédito</option>
                    <option value="DEBITO" {{ old('metodo_pagamento') == 'DEBITO' ? 'selected' : '' }}>Débito</option>
                    <option value="PIX" {{ old('metodo_pagamento') == 'PIX' ? 'selected' : '' }}>PIX</option>
                </select>
            </div>

            <!-- Status -->
            <div class="form-group mt-3">
                <label for="status">Status do Pedido</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="em produção" {{ old('status') == 'em produção' ? 'selected' : '' }}>Em Produção</option>
                    <option value="finalizado" {{ old('status') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>

            <!-- Observações -->
            <div class="form-group mt-3">
                <label for="observacoes">Observações</label>
                <textarea name="observacoes" id="observacoes" class="form-control">{{ old('observacoes') }}</textarea>
            </div>

            <!-- Botão para Criar Pedido -->
            <button type="submit" class="btn btn-success mt-3">Criar Pedido</button>
        </form>
    </div>

    <!-- Script JavaScript -->
    <script>
        // Função para preencher o endereço automaticamente ao selecionar um cliente
        function atualizarEndereco() {
            var clienteId = document.getElementById('cliente_id').value;
            if (clienteId) {
                // Fazer uma requisição para obter o endereço do cliente selecionado
                fetch(`/clientes/${clienteId}/endereco`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('endereco_cliente').value = data.endereco;
                    })
                    .catch(error => console.error('Erro ao carregar o endereço:', error));
            } else {
                document.getElementById('endereco_cliente').value = '';
            }
        }

        // Função para atualizar o preço unitário automaticamente ao selecionar o produto
        function atualizarPrecoUnitario() {
            var produtoId = document.getElementById('produto_id').value;
            var produtoSelecionado = document.querySelector(`#produto_id option[value="${produtoId}"]`);
            if (produtoSelecionado) {
                var preco = produtoSelecionado.getAttribute('data-preco');
                document.getElementById('preco_unitario').value = preco;
                atualizarSubtotal();
            }
        }

        // Função para calcular o subtotal ao alterar a quantidade ou preço
        document.getElementById('quantidade').addEventListener('input', atualizarSubtotal);
        document.getElementById('preco_unitario').addEventListener('input', atualizarSubtotal);

        function atualizarSubtotal() {
            var quantidade = parseFloat(document.getElementById('quantidade').value) || 0;
            var precoUnitario = parseFloat(document.getElementById('preco_unitario').value.replace(',', '.')) || 0;
            var subtotal = quantidade * precoUnitario;
            document.getElementById('subtotal').value = subtotal.toFixed(2);
        }
    </script>
@endsection
