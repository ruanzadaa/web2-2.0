<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Lista de Usuários</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabela de usuários com estilo -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Privilégio</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('users.editPrivilege', $user->id) }}" class="btn btn-sm btn-warning">
                                    Editar Privilégio
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão voltar -->
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Voltar</a>
    </div>
@endsection
