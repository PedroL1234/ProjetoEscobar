@extends('admin.template_admin.index')

@section('layout')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Lista de Clientes</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>

            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped table-borderedP">
                    <thead>
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Email</th>
                            <th>Número</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $linha)
                            <tr>
                                <td>{{ $linha->cli_nome }}</td>
                                <td>{{ $linha->cli_email }}</td>
                                <td>{{ $linha->cli_numero }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-id="{{ $linha->id }}">Editar</a>
                                    <form action="{{ route('clientes.destroy', $linha->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <h2>Editar Cliente</h2>
                        </center>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="clienteNome" name="nome" required>
                            <label for="clienteNome">Nome</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="clienteEmail" name="email" required>
                            <label for="clienteEmail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="clienteTelefone" name="telefone" required>
                            <label for="clienteTelefone">Número</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                fetch(`/clientes/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('clienteNome').value = data.cli_nome;
                        document.getElementById('clienteEmail').value = data.cli_email;
                        document.getElementById('clienteTelefone').value = data.cli_numero;
                        document.getElementById('editForm').action = `/clientes/${id}`;
                    });
            });
        });
    </script>
@endsection
