@extends('admin.template_admin.index')
@section('layout')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Estoque</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gerenciamento de Estoque</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pesquisa de Estoque
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo
                            Produto</a>
                    </div>
                </div>

                {{-- <table id="datatablesSimple">  --}}
                <table class="table table-head-bg-primary mt-4">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Quantia</th>
                            <th>Imagem</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estoque as $linha)
                            <tr>
                                <td>{{ $linha->id }}</td>
                                <td>{{ $linha->est_descricao }}</td>
                                <td>{{ $linha->est_tamanho }}</td>
                                <td>{{ $linha->est_quantia }}</td>
                                <td>
                                    @if ($linha->imagem)
                                        <img src="{{ asset('storage/' . $linha->imagem->caminho) }}" alt="Imagem do estoque"
                                            width="120">
                                    @else
                                        <span>Sem imagem de perfil</span>
                                    @endif
                                </td>
                                <td>
                                    <a action="{{ route('edit', $linha->id) }}" class="btn btn-warning btn-sm edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-id="{{ $linha->id }}">Editar</a>
                                    |
                                    <form action="{{ route('est_excluir', $linha->id) }}" method="POST"
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
                <form method="post" action="/estoque" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nova Roupa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <center>
                            <h2>Cadastrar</h2>
                        </center>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="img" name="imagem">
                            <label for="image">Adicione a foto da roupa</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="est_descricao">
                            <label for="floatingInput">Descriçao</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="est_tamanho">
                            <label for="floatingInput">tamanho</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="est_quantia">
                            <label for="floatingInput">Quantia</label>
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
@endsection
