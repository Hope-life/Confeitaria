<?php

// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Permitir atribuição em massa dos seguintes campos
    protected $fillable = [
        'numero_pedido',
        'cliente_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
        'status',
        'metodo_pagamento',
        'observacoes',
        'data_inicio',
        'data_final',
        'endereco_cliente',
    ];

    // Relacionamento com o Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com o Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
