<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Se você tiver um sistema de autorização, modifique aqui conforme necessário
    }

    public function rules()
    {
        // Pega o ID do cliente a partir da rota
        $clienteId = $this->route('cliente'); // Acessa o ID do cliente pela rota

        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $clienteId, // Verifica se o email é único, exceto o cliente atual
            'telefone' => 'required|string|unique:clientes,telefone,' . $clienteId, // Verifica se o telefone é único, exceto o cliente atual
            'endereco' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este email já está em uso. Por favor, insira um email diferente.',
            'telefone.unique' => 'Este telefone já está em uso. Por favor, insira um telefone diferente.',
        ];
    }
}
