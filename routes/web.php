<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

// Definindo a rota para obter o endereço do cliente
Route::get('/clientes/{id}/endereco', [ClienteController::class, 'getEndereco'])
    ->name('clientes.endereco');

// Rotas para Clientes (CRUD)
Route::resource('clientes', ClienteController::class);

// Rotas para Produtos (CRUD)
Route::resource('produtos', ProdutoController::class);

// Rotas para Pedidos (CRUD)
Route::resource('pedidos', PedidoController::class);
