<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'platform_id' => Platform::factory(),
            'release_date' => fake()->date(),
        ];
    }
}
