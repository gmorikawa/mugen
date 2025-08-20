<?php

namespace Database\Factories;

use App\Enums\FileState;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'concrete_name' => fake()->name(),
            'path' => fake()->filePath(),
            'size' => 108950,
            'state' => FileState::AVAILABLE->value
        ];
    }
}
