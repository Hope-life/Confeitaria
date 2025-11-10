<!-- resources/views/produtos/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Produto</h1>

        <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $produto->nome }}" required>
            </div>

            <div class="form-group">
                <label for="preco_unitario">Preço Unitário</label>
                <input type="number" name="preco_unitario" id="preco_unitario" class="form-control" value="{{ $produto->preco_unitario }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control">
                    <option value="paes" {{ $produto->categoria == 'paes' ? 'selected' : '' }}>Pães</option>
                    <option value="bolos" {{ $produto->categoria == 'bolos' ? 'selected' : '' }}>Bolos</option>
                    <option value="doces" {{ $produto->categoria == 'doces' ? 'selected' : '' }}>Doces</option>
                    <option value="salgados" {{ $produto->categoria == 'salgados' ? 'selected' : '' }}>Salgados</option>
                    <option value="sobremesas" {{ $produto->categoria == 'sobremesas' ? 'selected' : '' }}>Sobremesas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estoque">Estoque</label>
                <input type="number" name="estoque" id="estoque" class="form-control" value="{{ $produto->estoque }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
