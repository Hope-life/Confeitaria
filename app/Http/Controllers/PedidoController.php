<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Exibe a lista de pedidos
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'produto'])->get();
        return view('pedidos.index', compact('pedidos'));
    }

    // Exibe o formulário de criação de pedidos
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    // Armazena o novo pedido
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date',
            'metodo_pagamento' => 'required|in:CREDITO,DEBITO,PIX',
            'status' => 'required|in:pendente,em produção,finalizado',
            'endereco_cliente' => 'required|string',
        ]);

        // Pega o produto e verifica estoque
        $produto = Produto::find($request->produto_id);
        if ($produto->estoque < $request->quantidade) {
            // Retorna mensagem de erro se não tiver estoque
            return back()
                ->with('message', 'Produto sem estoque suficiente para o pedido.')
                ->withInput();
        }

        // Subtrai o estoque do produto
        $produto->estoque -= $request->quantidade;
        $produto->save();

        // Gerando o número do pedido
        $ultimoPedido = Pedido::orderBy('id', 'desc')->first();
        $ultimoNumero = $ultimoPedido ? (int) substr($ultimoPedido->numero_pedido, 4) : 0;
        $numeroPedido = 'PED-' . str_pad($ultimoNumero + 1, 4, '0', STR_PAD_LEFT);

        // Calcula o subtotal
        $subtotal = $request->quantidade * $produto->preco_unitario;

        // Cria o pedido
        Pedido::create([
            'numero_pedido' => $numeroPedido,
            'cliente_id' => $request->cliente_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'preco_unitario' => $produto->preco_unitario,
            'subtotal' => $subtotal,
            'metodo_pagamento' => $request->metodo_pagamento,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
            'data_inicio' => $request->data_inicio,
            'data_final' => $request->data_final,
            'endereco_cliente' => $request->endereco_cliente,
        ]);

        return redirect()->route('pedidos.index')->with('message', 'Pedido criado com sucesso!');
    }

    // Exibe os detalhes de um pedido
    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'produto'])->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    // Exibe o formulário para editar o pedido
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('pedidos.edit', compact('pedido', 'clientes', 'produtos'));
    }

    // Atualiza o pedido
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date',
            'metodo_pagamento' => 'required|in:CREDITO,DEBITO,PIX',
            'status' => 'required|in:pendente,em produção,finalizado',
        ]);

        $pedido = Pedido::findOrFail($id);
        $produto = Produto::find($request->produto_id);

        // Verifica estoque ao editar
        if ($produto->estoque + $pedido->quantidade < $request->quantidade) {
            return back()->with('message', 'Estoque insuficiente para atualizar o pedido.')->withInput();
        }

        // Ajusta estoque
        $produto->estoque += $pedido->quantidade; // devolve o estoque anterior
        $produto->estoque -= $request->quantidade; // subtrai o novo
        $produto->save();

        $subtotal = $request->quantidade * $produto->preco_unitario;

        $pedido->update([
            'cliente_id' => $request->cliente_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'preco_unitario' => $produto->preco_unitario,
            'subtotal' => $subtotal,
            'status' => $request->status,
            'metodo_pagamento' => $request->metodo_pagamento,
            'data_inicio' => $request->data_inicio,
            'data_final' => $request->data_final,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('pedidos.index')->with('message', 'Pedido atualizado com sucesso!');
    }

    // Deleta o pedido
    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return redirect()->route('pedidos.index')->with('message', 'Pedido deletado com sucesso!');
    }
}
