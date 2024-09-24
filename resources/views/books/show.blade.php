@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{ asset('images/' . $book->cover_image) }}" style="width: 200px; height: auto;">
        <p><strong>Autor:</strong> {{ $book->author->name }}</p>
        <p><strong>Editora:</strong> {{ $book->publisher->name }}</p>
        <p><strong>Ano de Publicação:</strong> {{ $book->published_year }}</p>
        <p><strong>Categorias:</strong> 
            @foreach ($book->categories as $category)
                <span class="badge bg-secondary">{{ $category->name }}</span>
            @endforeach
        </p>
        <a href="{{ route('books.index') }}" class="btn btn-primary">Voltar à Lista</a>
        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Editar</a>
        @can('up', App\Models\Book::class)
        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
        </form>
        @endcan

        <hr>

        <!-- Exibir comentários existentes -->
        <h3>Comentários</h3>
        @if($book->comments->isEmpty())
            <p>Não há comentários ainda.</p>
        @else
            @foreach($book->comments as $comment)
                <div class="mb-3">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        @endif

        <hr>

        <!-- Formulário para adicionar um novo comentário -->
        <h4>Adicionar um comentário</h4>
        @auth
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Seu comentário</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="btn btn-success">Enviar Comentário</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Faça login</a> para deixar um comentário.</p>
        @endauth
    </div>
@endsection
