<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confeitaria - Sistema de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="b-example-divider"></div>

    <div class="container-fluid px-0">
        <header class="d-flex justify-content-center py-3 bg-dark">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.index') ? 'active bg-success text-white' : 'text-success' }}">
                        Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pedidos.index') }}" class="nav-link {{ request()->routeIs('pedidos.index') ? 'active bg-success text-white' : 'text-success' }}">
                        Pedidos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produtos.index') }}" class="nav-link {{ request()->routeIs('produtos.index') ? 'active bg-success text-white' : 'text-success' }}">
                        Produtos
                    </a>
                </li>
            </ul>
        </header>
    </div>

    <!-- Conteúdo da página -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Modal de confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    Tem certeza que deseja excluir este item? Esta ação não pode ser desfeita.
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="" id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts necessários para o Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setDeleteAction(url) {
            document.getElementById('deleteForm').action = url;
        }
    </script>

</body>
</html>
