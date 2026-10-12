<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' =>Category::inRandomOrder()->first()->id,
            'title'=>fake()->sentence(6),
            'body'=>fake()->paragraph(),
        ];
    }
}
