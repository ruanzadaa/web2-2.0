<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    /**
     * Exibe uma lista de comentários para um livro específico.
     *
     * @param  int  $book_id
     * @return \Illuminate\Http\Response
     */
    public function index($book_id)
    {
        // Busca o livro pelos comentários
        $comments = Comment::where('book_id', $book_id)->get();

        // Retorna a visualização dos comentários (você pode ajustar a view conforme necessário)
        return view('comments.index', compact('comments'));
    }

    /**
     * Armazena um novo comentário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'comment' => 'required|string',
            'book_id' => 'required|exists:books,id',
        ]);

        // Criação do comentário
        Comment::create([
            'user_id' => auth()->id(), // ID do usuário autenticado
            'book_id' => $request->book_id, // ID do livro
            'comment' => $request->comment, // Texto do comentário
        ]);

        // Redireciona de volta ao livro ou outra página
        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
