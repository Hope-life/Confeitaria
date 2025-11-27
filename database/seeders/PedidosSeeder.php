<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedidos')->insert([
            [
                'numero_pedido' => 'PED-0001',
                'cliente_id' => 1,  // João Silva
                'produto_id' => 1,  // Pão Francês
                'quantidade' => 10,
                'preco_unitario' => 2.50,
                'subtotal' => 25.00,
                'metodo_pagamento' => 'CREDITO',
                'status' => 'pendente',
                'observacoes' => 'Pedido urgente',
                'data_inicio' => '2025-11-08',
                'endereco_cliente' => 'Rua A, 123, Centro, Rio de Janeiro',
            ],
            [
                'numero_pedido' => 'PED-0002',
                'cliente_id' => 2,  // Maria Oliveira
                'produto_id' => 2,  // Bolo de Chocolate
                'quantidade' => 5,
                'preco_unitario' => 15.00,
                'subtotal' => 75.00,
                'metodo_pagamento' => 'DEBITO',
                'status' => 'em produção',
                'observacoes' => 'Entrega no mesmo dia',
                'data_inicio' => '2025-11-08',
                'endereco_cliente' => 'Rua B, 456, Botafogo, Rio de Janeiro',
            ]
        ]);
    }
}
