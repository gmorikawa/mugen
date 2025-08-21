<?php

namespace Database\Factories;

use App\Models\ColorEncoding;
use App\Models\File;
use App\Models\Game;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'game_id' => Game::factory(),
            'color_encoding_id' => ColorEncoding::factory(),
            'file_id' => File::factory(),
            'description' => fake()->text(200),
        ];
    }
}
