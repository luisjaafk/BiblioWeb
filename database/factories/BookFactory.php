<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
{
    return [
        'title' => $this->faker->sentence(3),
        'author' => $this->faker->name,
        'isbn' => $this->faker->unique()->isbn13,
        'category' => $this->faker->randomElement(['Novela', 'Ciencia', 'Fantasía']),
        'status' => $this->faker->randomElement(['disponible', 'prestado']),
        'published_year' => $this->faker->year,
        'description' => $this->faker->paragraph,
        'cover_image' => $this->faker->imageUrl(200, 300, 'books')
    ];
}
}