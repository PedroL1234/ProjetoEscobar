@extends("admin.template_admin.index")
@section("layout")
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
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Produto</a>
                </div>
            </div>

            <table id="datatablesSimple"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($estoque as $linha)
                    <tr>
                        <td>{{ $linha->id }}</td>
                        <td>{{ $linha->est_tipo }}</td>
                        <td>{{ $linha->est_descricao }}</td>
                        <td>
                            <a href="{{ route('est_alterar', $linha->id) }}" class="btn btn-primary"><li class="fa fa-pencil"></li></a>
                            </a> 
                            | 
                             <a href="{{ route('est_excluir', ["id"=>$linha->id]) }}" class="btn btn-danger btn-sm">
                                <li class="fa fa-trash"></li>
                            </a>
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
        <form method="POST" action="/categorias">
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nova categoria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <center><h2>Cadastrar</h2></center>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cat_nome">
                <label for="floatingInput">Nome da categoria</label>
              </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cat_descricao">
                <label for="floatingInput">Descriçao</label>
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