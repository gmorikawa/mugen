<?php

namespace Tests\Feature\Country;

use App\Models\Country;
use Tests\TestCase;

class RemoveCountryTest extends TestCase
{
    public function test_removes_country(): void
    {
        $country = Country::factory()->create();

        $response = $this
            ->delete("/api/countries/{$country->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('countries', $country->toArray());
    }
}
