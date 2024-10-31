<!-- resources/views/usuarios/editar.blade.php -->

@extends("admin.template_admin.index")

@section("layout")
<div class="container">
    <h2>Editar Usuário</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('usuarios.atualizar') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$cliente->id}}">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required>
            @error('telefone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
