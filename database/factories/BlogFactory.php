<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Harus udh ada data user di databasenya
        $user = User::inRandomOrder()->first()->id;
        $title = fake()->unique()->sentence(4);
        $slug = Str::slug($title);

        return [
            'user_id' => $user,
            'title' => $title,
            'slug' => $slug,
            'body' => fake()->realText(3000),
            'created_at' => fake()->dateTimeBetween('-3 month', '0 day'),
        ];
    }
}
