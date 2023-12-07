<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->realText(30);
        $book_seo = \Illuminate\Support\Str::slug($title, '-');

        return [
            'title' => $title,
            'book_seo' => $book_seo,
            'author' => $this->faker->name(),
            'description' => $this->faker->realText(200),
            'date_published' => $this->faker->date(),
            'publisher' => $this->faker->company(), 
            'page_count' => $this->faker->numberBetween(100, 1000),
            'price' => $this->faker->randomNumber(6, false),
        ];
    }
}
