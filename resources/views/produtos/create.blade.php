@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Produto</h1>

        <form action="{{ route('produtos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="preco_unitario">Preço Unitário</label>
                <input type="number" name="preco_unitario" id="preco_unitario" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control">
                    <option value="paes">Pães</option>
                    <option value="bolos">Bolos</option>
                    <option value="doces">Doces</option>
                    <option value="salgados">Salgados</option>
                    <option value="sobremesas">Sobremesas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estoque">Estoque</label>
                <input type="number" name="estoque" id="estoque" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
