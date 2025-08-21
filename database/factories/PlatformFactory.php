<?php

namespace Database\Factories;

use App\Enums\PlatformType;
use App\Models\Company;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    protected $model = Platform::class;

    public function definition(): array
    {
        $types = PlatformType::cases();
        $randomIndex = rand(0, count($types)-1);
        return [
            'name' => fake()->name(),
            'abbreviation' => fake()->stateAbbr(),
            'type' => $types[$randomIndex]->value,
            'developer_id' => Company::factory(),
            'manufacturer_id' => Company::factory()
        ];
    }
}
