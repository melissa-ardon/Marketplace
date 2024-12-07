<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    
    /*
    $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('descripcion');
            $table->integer('precio');
            $table->unsignedBigInteger('user_id');
            $table->enum('estado', ['disponible', 'vendido'])->default('disponible');
    */
    public function definition(): array
    {
        return [
            'titulo' => fake()->word(),
            'autor' => fake()->name(),
            'descripcion' => fake()->text(),
            'precio' => fake()->numberBetween(1000, 10000),
            'user_id' => fake()->numberBetween(1, 20),
            'estado' => fake()->randomElement(['disponible', 'vendido']),
        ];
    }
}
