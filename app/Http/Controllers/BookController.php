<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Função para exibir uma lista de livros
    public function index()
    {
        $books = Book::all();

        $books = Book::with(['author', 'publisher', 'categories'])->get();
        return view('books.index', compact('books'));
    }

    // Função para exibir um livro específico
    public function show($id)
    {
        $book = Book::with(['author', 'publisher', 'categories'])->findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Função para exibir o formulário de criação de um novo livro
    public function create()
    {

        
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'publishers', 'categories'));
    }
    
    // Função para armazenar um novo livro no banco de dados
    public function store(Request $request)
    {

        $this->authorize('create', Book::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Processar o upload da imagem
        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();  
            $request->cover_image->move(public_path('images'), $imageName);
            
            // Adicionar o nome da imagem ao validatedData
            $validatedData['cover_image'] = $imageName; // Salvar o nome da imagem no array
        }
        
      
    // Criar o livro no banco de dados
    $book = Book::create($validatedData); // Isso agora incluirá 'cover_image'
    $book->categories()->attach($request->categories);

    return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
}
    // Função para exibir o formulário de edição de um livro
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        $this->authorize('update', $book);
        return view('books.edit', compact('book', 'authors', 'publishers', 'categories'));
    }

    // Função para atualizar um livro no banco de dados
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'nullable' permite que o campo seja opcional
        ]);
    
        $book = Book::findOrFail($id);
    
        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('cover_image')) {
            // Remove a imagem antiga, se necessário
            if ($book->cover_image) {
                $oldImagePath = public_path('images/' . $book->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Remove a imagem antiga
                }
            }
    
            $imageName = time() . '.' . $request->cover_image->extension();  
            $request->cover_image->move(public_path('images'), $imageName);
            $validatedData['cover_image'] = $imageName; // Salva o nome da nova imagem
        } else {
            // Se não houver nova imagem, mantém a imagem antiga
            $validatedData['cover_image'] = $book->cover_image;
        }
    
        // Atualiza os dados do livro
        $this->authorize('update', $book);
        $book->update($validatedData);
        $book->categories()->sync($request->categories);
    
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    // Função para excluir um livro do banco de dados
    public function destroy($id)
    {

        $book = Book::findOrFail($id);
        $book->categories()->detach();
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
        
    }
}
