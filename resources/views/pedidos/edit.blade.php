@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Pedido</h1>

        <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Cliente -->
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" onchange="atualizarEndereco()">
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produto -->
            <div class="form-group">
                <label for="produto_id">Produto</label>
                <select name="produto_id" id="produto_id" class="form-control">
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}" {{ $pedido->produto_id == $produto->id ? 'selected' : '' }}>
                            {{ $produto->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Endereço do Cliente -->
            <div class="form-group">
                <label for="endereco_cliente">Endereço do Cliente</label>
                <input type="text" name="endereco_cliente" id="endereco_cliente" class="form-control" value="{{ old('endereco_cliente', $pedido->endereco_cliente) }}" required>
            </div>

            <!-- Quantidade -->
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ old('quantidade', $pedido->quantidade) }}" required>
            </div>

            <!-- Preço Unitário -->
            <div class="form-group">
                <label for="preco_unitario">Preço Unitário</label>
                <input type="text" class="form-control" value="R$ {{ number_format($pedido->preco_unitario, 2, ',', '.') }}" readonly />
            </div>

            <!-- Subtotal -->
            <div class="form-group">
                <label for="subtotal">Subtotal</label>
                <input type="text" class="form-control" value="R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}" readonly />
            </div>

            <!-- Data de Início -->
            <div class="form-group">
                <label for="data_inicio">Data de Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ old('data_inicio', $pedido->data_inicio) }}" required>
            </div>

            <!-- Data Final -->
            <div class="form-group">
                <label for="data_final">Data Final</label>
                <input type="date" name="data_final" id="data_final" class="form-control" value="{{ old('data_final', $pedido->data_final) }}" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pendente" {{ $pedido->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="em produção" {{ $pedido->status == 'em produção' ? 'selected' : '' }}>Em Produção</option>
                    <option value="finalizado" {{ $pedido->status == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>

            <!-- Método de Pagamento -->
            <div class="form-group">
                <label for="metodo_pagamento">Método de Pagamento</label>
                <select name="metodo_pagamento" id="metodo_pagamento" class="form-control">
                    <option value="CREDITO" {{ $pedido->metodo_pagamento == 'CREDITO' ? 'selected' : '' }}>Crédito</option>
                    <option value="DEBITO" {{ $pedido->metodo_pagamento == 'DEBITO' ? 'selected' : '' }}>Débito</option>
                    <option value="PIX" {{ $pedido->metodo_pagamento == 'PIX' ? 'selected' : '' }}>PIX</option>
                </select>
            </div>

            <!-- Observações -->
            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea name="observacoes" id="observacoes" class="form-control">{{ old('observacoes', $pedido->observacoes) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>

    <!-- Script JavaScript -->
   
       <script>
    function atualizarEndereco() {
        const clienteId = document.getElementById('cliente_id').value;
        const enderecoInput = document.getElementById('endereco_cliente');

        if (!clienteId) {
            enderecoInput.value = '';
            return;
        }

        // Usa a rota nomeada do Laravel para montar a URL correta
        const url = "{{ route('clientes.endereco', ['id' => ':id']) }}".replace(':id', clienteId);

        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(resp => {
                if (!resp.ok) throw new Error('Falha ao buscar endereço');
                return resp.json();
            })
            .then(data => {
                enderecoInput.value = data.endereco ?? '';
            })
            .catch(err => {
                console.error(err);
                // Mantém o valor atual se der erro
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Preenche com o endereço do cliente já selecionado ao abrir a página
        atualizarEndereco();

        // E também quando o usuário trocar o cliente
        document.getElementById('cliente_id').addEventListener('change', atualizarEndereco);
    });
</script>

   
@endsection
