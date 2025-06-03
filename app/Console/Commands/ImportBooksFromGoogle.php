<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Book;

class ImportBooksFromGoogle  extends Command
{
    protected $signature = 'books:import {query} {--max=10}';
    protected $description = 'Importa libros desde Google Books API';

    public function handle()
    {
        $query = $this->argument('query');
        $max = $this->option('max');

        $this->info("Buscando libros para: {$query}");

        $client = new Client();

        try {
            $response = $client->get('https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => $query,
                    'maxResults' => $max,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['items'])) {
                $this->info("No se encontraron libros.");
                return;
            }

            foreach ($data['items'] as $item) {
                $volumeInfo = $item['volumeInfo'] ?? [];

                $title = $volumeInfo['title'] ?? 'Sin título';
                $authors = isset($volumeInfo['authors']) ? implode(', ', $volumeInfo['authors']) : 'Desconocido';
                $description = $volumeInfo['description'] ?? '';
                $categories = isset($volumeInfo['categories']) ? implode(', ', $volumeInfo['categories']) : '';
                $isbn = '';
                if (isset($volumeInfo['industryIdentifiers'])) {
                    foreach ($volumeInfo['industryIdentifiers'] as $identifier) {
                        if ($identifier['type'] === 'ISBN_13') {
                            $isbn = $identifier['identifier'];
                            break;
                        }
                    }
                }

                // Crear o actualizar libro
                Book::updateOrCreate(
                    ['isbn' => $isbn], // clave para actualizar si existe
                    [
                        'title' => $title,
                        'author' => $authors,
                        'description' => $description,
                        'category' => $categories,
                        'status' => 'disponible',
                        'cover_image' => $volumeInfo['imageLinks']['thumbnail'] ?? null,
                    ]
                );

                $this->info("Libro importado: $title");
            }

        } catch (\Exception $e) {
            $this->error("Error al importar libros: " . $e->getMessage());
        }
    }
}
