@extends("admin.template_admin.index")
@section("layout")
    <div class="container-fluid px-4">
        <h1 class="mt-4">Categoria</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Alteração de estoque</li>
        </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Editar estoque
        </div>
    <div class="card-body">

        <div class="row">
        <form method="POST" action="{{route('est_alterar')}}">
            @csrf
            <input type="hidden" name="id" value="{{$estoqueItem->id}}">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="est_tipo" value="{{ $estoqueItem->est_tipo }}">
                <label for="floatingInput">tipo </label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="est_descricao" value="{{ $estoqueItem->est_descricao }}">
                <label for="floatingInput">Descriçao</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="est_quantia" value="{{ $estoqueItem->est_quantia }}">
                <label for="floatingInput">Quantidade</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="est_ativo" value="{{ $estoqueItem->est_ativo }}">
                <label for="floatingInput">status</label>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
    </div>

@endsection