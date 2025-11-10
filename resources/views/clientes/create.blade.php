@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Criar Cliente</h1>

        <!-- Exibe as mensagens de erro -->
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Criação de Cliente -->
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone') }}" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control" value="{{ old('endereco') }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>
@endsection
