<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->when(request('search'), function($query) {
                return $query->where('title', 'like', '%'.request('search').'%')
                             ->orWhere('author', 'like', '%'.request('search').'%')
                             ->orWhere('isbn', 'like', '%'.request('search').'%');
            })
            ->when(request('status'), function($query) {
                return $query->where('status', request('status'));
            })
            ->paginate(12);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'isbn' => 'required|string|max:20|unique:books,isbn',
        'category' => 'required|string|max:100',
        'status' => 'required|in:disponible,prestado',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
    ]);

    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('covers', 'public');
        $validatedData['cover_image'] = $path; // guardamos la ruta relativa
    }

    Book::create($validatedData);

    return redirect()->route('books.index')->with('success', 'Libro creado exitosamente.');
}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }


    public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'isbn' => 'required|string|max:50',
        'category' => 'required|string|max:100',
        'status' => 'required|in:disponible,prestado',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // máx 2MB
    ]);

    if ($request->hasFile('cover_image')) {
        if ($book->cover_image && \Storage::disk('public')->exists('covers/' . $book->cover_image)) {
            \Storage::disk('public')->delete('covers/' . $book->cover_image);
        }

        $file = $request->file('cover_image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('covers', $filename, 'public');

        $validated['cover_image'] = $filename;
    }

    $book->update($validated);
    return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
}


    public function destroy($id)
    {
        //
    }
}
