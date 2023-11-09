<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'content' => fake()->text(),
            'category' => fake()->text(),
            'author' => fake()->name,
            'source' => fake()->title(),
            'date' => fake()->dateTime,
            'url' => fake()->url,
            'image_url' => fake()->imageUrl,
        ];
    }
}
