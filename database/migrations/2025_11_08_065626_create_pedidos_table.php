<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pedido')->unique();  // Número do pedido único
            $table->unsignedBigInteger('cliente_id');  // Referência para cliente
            $table->unsignedBigInteger('produto_id');  // Referência para produto
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 8, 2);
            $table->decimal('subtotal', 8, 2);
            $table->enum('status', ['pendente', 'em produção', 'finalizado']);  // Status do pedido
            $table->enum('metodo_pagamento', ['CREDITO', 'DEBITO', 'PIX']);  // Método de pagamento
            $table->text('observacoes')->nullable();
            $table->date('data_inicio');  // Data de início do pedido
            $table->date('data_final');  // Data final de entrega
            $table->string('endereco_cliente');  // Endereço do cliente no pedido
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
