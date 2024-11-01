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

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $linha)
                            <tr>
                                <td>{{ $linha->name }}</td>
                                <td>{{ $linha->email }}</td>
                                <td>
                                    <form action="{{ route('users.update', $linha->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="adm_perm_{{ $linha->id }}" name="adm_perm" value="1"
                                                {{ $linha->adm_perm ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="adm_perm_{{ $linha->id }}">Conceder
                                                acesso administrativo</label>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
