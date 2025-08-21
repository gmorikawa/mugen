<?php

namespace Database\Factories;

use App\Models\ColorEncoding;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorEncodingFactory extends Factory
{
    protected $model = ColorEncoding::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->realText(200, 2),
        ];
    }
}
