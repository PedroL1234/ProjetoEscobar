

@extends("admin.template_admin.index")

@section("layout")
<div class="container">
    <h2>Editar Produto</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('estoque.editar')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @method('PUT')
        <input type="hidden" name="id" value="{{$estoque->id}}">
        dd(id);
        
        <div class="form-group">
            <label for="est_descricao">Descrição</label>
            <input type="text" class="form-control" id="est_descricao" name="est_descricao" value="{{ old('est_descricao', $estoque->est_descricao) }}" required>
            @error('est_descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="est_tamanho">Tamanho</label>
            <input type="text" class="form-control" id="est_tamanho" name="est_tamanho" value="{{ old('est_tamanho', $estoque->est_tamanho) }}" required>
            @error('est_tamanho')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="est_quantia">Quantia</label>
            <input type="number" class="form-control" id="est_quantia" name="est_quantia" value="{{ old('est_quantia', $estoque->est_quantia) }}" required>
            @error('est_quantia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="est_nome">nome</label>
            <input type="text" class="form-control" id="est_nome" name="est_nome" value="{{ old('est_nome', $estoque->est_nome) }}" required>
            
            
            @error('est_nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="est_valor">valor</label>
            <input type="number" class="form-control" id="est_valor" name="est_valor" value="{{ old('est_valor', $estoque->est_valor) }}" required>
            
            @error('est_valor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group">
            <label for="imagem">Imagem (opcional)</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
            @if($estoque->fk_img_id)
                <p>Imagem atual: <img src="{{ asset('storage/' . $estoque->imagem->caminho) }}" alt="Imagem atual" width="100"></p>
            @endif
            
            @error('imagem')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
