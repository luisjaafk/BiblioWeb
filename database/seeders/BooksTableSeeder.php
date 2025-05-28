<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creación de un libro específico
        if (!Book::where('isbn', '978-0307474728')->exists()) {
        Book::create([
            'title' => 'Cien años de soledad',
            'author' => 'Gabriel García Márquez',
            'isbn' => '978-0307474728',
            'category' => 'Novela',
            'status' => 'disponible'
        ]);
    }

    // Crea libros con ISBNs únicos
    Book::factory()->count(50)->create();
    }
}