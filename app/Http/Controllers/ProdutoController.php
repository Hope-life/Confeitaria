<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
        public function index()
        {
            // Busca todos os produtos
            $produtos = Produto::all();
            
            // Retorna a view de index com os produtos
            return view('produtos.index', compact('produtos'));
        }
        
        public function create()
        {
            return view('produtos.create'); // Rendeiza a view para criar um produto
        }

        public function store(Request $request)
        {
            // Validação dos dados recebidos
            $request->validate([
                'nome' => 'required|string|max:255',
                'preco_unitario' => 'required|numeric',
                'categoria' => 'required|string|max:255',
                'estoque' => 'required|integer',
            ]);

            // Criação do produto no banco de dados
            Produto::create([
                'nome' => $request->nome,
                'preco_unitario' => $request->preco_unitario,
                'categoria' => $request->categoria,
                'estoque' => $request->estoque,
            ]);

            // Redireciona de volta para a página de produtos com uma mensagem de sucesso
            return redirect()->route('produtos.index')->with('message', 'Produto criado com sucesso!');
        }
        
        // Exibe o formulário de edição de um produto
        public function edit($id)
        {
            // Encontra o produto pelo ID
            $produto = Produto::findOrFail($id);
            
            // Retorna a view de edição com o produto
            return view('produtos.edit', compact('produto'));
        }

        // Atualiza o produto no banco de dados
        public function update(Request $request, $id)
        {
            // Validação dos dados recebidos
            $request->validate([
                'nome' => 'required|string|max:255',
                'preco_unitario' => 'required|numeric',
                'categoria' => 'required|in:paes,bolos,doces,salgados,sobremesas',
                'estoque' => 'required|integer|min:0',
            ]);

            // Encontra o produto pelo ID
            $produto = Produto::findOrFail($id);

            // Atualiza o produto com os dados recebidos
            $produto->update($request->all());

            // Redireciona de volta com uma mensagem de sucesso
            return redirect()->route('produtos.index')->with('message', 'Produto atualizado com sucesso!');
        }

        public function show($id)
        {
            // Encontra o produto pelo id
            $produto = Produto::findOrFail($id);
            
            // Exibe a visão com os detalhes do produto
            return view('produtos.show', compact('produto'));
        }

        // Deleta um produto
        public function destroy($id)
        {
            // Encontre o produto pelo ID e exclua
            Produto::findOrFail($id)->delete();

            // Redireciona de volta com uma mensagem de sucesso
            return redirect()->route('produtos.index')->with('message', 'Produto excluído com sucesso!');
        }

}
