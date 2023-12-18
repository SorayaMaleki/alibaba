<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Models\User;
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
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "content" => $this->faker->paragraph(5),
            'user_id' => User::factory(),
            //todo use enum
            'status' => $this->faker->randomElement(["draft","published"]),
        ];
    }
}
