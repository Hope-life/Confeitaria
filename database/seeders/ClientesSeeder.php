<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'nome' => 'João Silva',
                'email' => 'joao.silva@example.com',
                'telefone' => '21987654321',
                'endereco' => 'Rua A, 123, Centro, Rio de Janeiro',
            ],
            [
                'nome' => 'Maria Oliveira',
                'email' => 'maria.oliveira@example.com',
                'telefone' => '21987654322',
                'endereco' => 'Rua B, 456, Botafogo, Rio de Janeiro',
            ],
            [
                'nome' => 'Carlos Souza',
                'email' => 'carlos.souza@example.com',
                'telefone' => '21987654323',
                'endereco' => 'Rua C, 789, Copacabana, Rio de Janeiro',
            ]
        ]);
    }
}
