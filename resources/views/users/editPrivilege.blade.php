<!-- resources/views/users/editPrivilege.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Editar Privilégio do Usuário: {{ $user->name }}</h1>

    <form action="{{ route('users.updatePrivilege', $user->id) }}" method="POST">
        @csrf
        @method('POST')

        <label for="role">Privilégio do Usuário:</label>
        <select name="role" id="role">
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuário</option>
            <option value="bibliotecario" {{ $user->role === 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit">Atualizar Privilégio</button>
    </form>
@endsection