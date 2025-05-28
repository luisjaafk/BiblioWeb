<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->string('isbn')->unique();
        $table->string('category');
        $table->enum('status', ['disponible', 'prestado']);
        $table->year('published_year')->nullable(); // Añade esta línea
        $table->text('description')->nullable();   // Añade esta línea
        $table->string('cover_image')->nullable(); // Añade esta línea
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
