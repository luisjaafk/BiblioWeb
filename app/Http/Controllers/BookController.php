<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status');

    if ($search) {
        // Consulta a Open Library
        $response = Http::get("https://openlibrary.org/search.json", [
            'q' => $search,
            'limit' => 21
        ]);

        if ($response->successful()) {
            $books = $response->json()['docs'] ?? [];
        } else {
            $books = [];
        }

        return view('books.results', compact('books'));
    }

    // Consulta local (sin búsqueda externa)
    $query = Book::query();

    if ($status) {
        $query->where('status', $status);
    }

    if ($search !== null) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('author', 'like', "%$search%")
              ->orWhere('isbn', 'like', "%$search%");
        });
    }

    $books = $query->latest()->paginate(9);

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
    $book = Book::findOrFail($id);
    return view('books.show', compact('book'));
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
    public function searchFromAPI(Request $request)
{
    $query = $request->input('q');
    $url = "https://openlibrary.org/search.json?q=" . urlencode($query);

    $response = Http::get($url);
    $books = $response->json()['docs'] ?? [];

    return view('books.results', compact('books'));
}

}
