@extends('admin.template_admin.index')
@section('layout')

<div class="container-fluid px-4">
    <h1 class="mt-4">Estoque</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gerenciamento de Estoque</li>
    </ol>

    <div class="card mb-4" style="margin-left: 20%; margin-right: 20%;" >
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesquisa de Estoque
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Produto</a>
                </div>
            </div>

            <div class="table-responsive"> <!-- Adicionando margem para centralizar -->
                <table class="table table-head-bg-primary mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Quantia</th>
                            <th>Valor</th>
                            <th>Imagem</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estoque as $linha)
                            <tr>
                                <td>{{ $linha->id }}</td>
                                <td>{{ $linha->est_nome }}</td>
                                <td>{{ $linha->est_descricao }}</td>
                                <td>{{ $linha->est_tamanho }}</td>
                                <td>{{ $linha->est_quantia }}</td>
                                <td>{{ $linha->est_valor }}</td>
                                <td>
                                    @if ($linha->imagem)
                                        <img src="{{ asset('storage/' . $linha->imagem->caminho) }}" alt="Imagem do estoque" width="120">
                                    @else
                                        <span>Sem imagem</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                       data-id="{{ $linha->id }}"
                                       data-nome="{{ $linha->est_nome }}"
                                       data-descricao="{{ $linha->est_descricao }}"
                                       data-tamanho="{{ $linha->est_tamanho }}"
                                       data-quantia="{{ $linha->est_quantia }}"
                                       data-valor="{{ $linha->est_valor }}">
                                        Editar
                                    </a>
                                    |
                                    <form action="{{ route('estoque.destroy', $linha->id) }}" method="POST" style="display:inline;">
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
</div>

<!-- Modal Novo Produto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('estoque.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <center>
                        <h2>Nova Roupa</h2>
                    </center>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="img" name="imagem">
                        <label for="img">Adicione a foto do produto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_nome" required>
                        <label for="floatingInput">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_descricao" required>
                        <label for="floatingInput">Descrição</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_tamanho" required>
                        <label for="floatingInput">Tamanho</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="est_quantia" required>
                        <label for="floatingInput">Quantia</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_valor" required>
                        <label for="floatingInput">Valor</label>
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

<!-- Modal Editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <center>
                        <h2>Editar Produto</h2>
                    </center>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="edit_img" name="imagem">
                        <label for="edit_img">Adicione a foto do produto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_nome" id="edit_nome" required>
                        <label for="edit_nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_descricao" id="edit_descricao" required>
                        <label for="edit_descricao">Descrição</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_tamanho" id="edit_tamanho" required>
                        <label for="edit_tamanho">Tamanho</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="est_quantia" id="edit_quantia" required>
                        <label for="edit_quantia">Quantia</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="est_valor" id="edit_valor" required>
                        <label for="edit_valor">Valor</label>
                    </div>
                    <input type="hidden" name="id" id="edit_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Script para preencher o modal de edição com os dados do item
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const nome = button.getAttribute('data-nome');
            const descricao = button.getAttribute('data-descricao');
            const tamanho = button.getAttribute('data-tamanho');
            const quantia = button.getAttribute('data-quantia');
            const valor = button.getAttribute('data-valor');

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nome').value = nome;
            document.getElementById('edit_descricao').value = descricao;
            document.getElementById('edit_tamanho').value = tamanho;
            document.getElementById('edit_quantia').value = quantia;
            document.getElementById('edit_valor').value = valor;

            // Atualiza a ação do formulário com o ID do item
            const formAction = `{{ url('/estoque') }}/${id}`; // Monta a URL correta
            document.querySelector('#editModal form').action = formAction;
        });
    });
</script>
@endsection
