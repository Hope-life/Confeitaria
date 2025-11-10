<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    // Exibe todos os clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Exibe o formulário para criar um novo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Armazena o cliente no banco de dados
    public function store(ClienteRequest $request)
    {
        // Validação feita pela ClienteRequest
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')->with('message', 'Cliente criado com sucesso!');
    }

    // Exibe os detalhes de um cliente
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Exibe o formulário de edição de um cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Atualiza as informações do cliente
    public function update(ClienteRequest $request, $id)
    {
        // A validação já foi feita pela ClienteRequest

        // Encontra o cliente e atualiza seus dados
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->validated());  // Atualiza com os dados validados

        return redirect()->route('clientes.index')->with('message', 'Cliente atualizado com sucesso!');
    }

    // Deleta o cliente
    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();
        return redirect()->route('clientes.index')->with('message', 'Cliente deletado com sucesso!');
    }

   // Preenche o edereço automaticamente
public function getEndereco($id)
{
    $cliente = \App\Models\Cliente::findOrFail($id);
    return response()->json(['endereco' => $cliente->endereco]);
}



}
