

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
        <input type="hidden" name="id" value="{{$estoqueItem ->id}}">
        
        <div class="form-group">
            <label for="est_descricao">Descrição</label>
            <input type="text" class="form-control" id="est_descricao" name="est_descricao" value="{{ old('est_descricao', $estoqueItem->est_descricao) }}" required>
            @error('est_descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="est_tamanho">Tamanho</label>
            <input type="text" class="form-control" id="est_tamanho" name="est_tamanho" value="{{ old('est_tamanho', $estoqueItem->est_tamanho) }}" required>
            @error('est_tamanho')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="est_quantia">Quantia</label>
            <input type="number" class="form-control" id="est_quantia" name="est_quantia" value="{{ old('est_quantia', $estoqueItem->est_quantia) }}" required>
            @error('est_quantia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="est_nome">nome</label>
            <input type="text" class="form-control" id="est_nome" name="est_nome" value="{{ old('est_nome', $estoqueItem->est_nome) }}" required>
            
            
            @error('est_nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="est_valor">valor</label>
            <input type="number" class="form-control" id="est_valor" name="est_valor" value="{{ old('est_valor', $estoqueItem->est_valor) }}" required>
            
            @error('est_valor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group">
            <label for="imagem">Imagem (opcional)</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
            @if($estoqueItem->fk_img_id)
                <p>Imagem atual: <img src="{{ asset('storage/' . $estoqueItem->imagem->caminho) }}" alt="Imagem atual" width="100"></p>
            @endif
            
            @error('imagem')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>
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
