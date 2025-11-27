<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        DB::table('produtos')->insert([
            [
                'nome' => 'Pão Francês',
                'preco_unitario' => 2.00,
                'categoria' => 'paes',
                'estoque' => 100,
            ],
            [
                'nome' => 'Bolo de Chocolate',
                'preco_unitario' => 15.00,
                'categoria' => 'bolos',
                'estoque' => 50,
            ],
            [
                'nome' => 'Coxinha',
                'preco_unitario' => 5.00,
                'categoria' => 'salgados',
                'estoque' => 80,
            ],
            [
                'nome' => 'Brigadeiro',
                'preco_unitario' => 3.00,
                'categoria' => 'doces',
                'estoque' => 120,
            ],
            [
                'nome' => 'Pudim',
                'preco_unitario' => 8.00,
                'categoria' => 'sobremesas',
                'estoque' => 70,
            ]
        ]);
    }
}
