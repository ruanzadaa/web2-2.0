@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Privilégio do Usuário: <strong>{{ $user->name }}</strong></h1>

        <form action="{{ route('users.updatePrivilege', $user->id) }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="role" class="form-label">Privilégio do Usuário:</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuário</option>
                    <option value="bibliotecario" {{ $user->role === 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Privilégio</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
