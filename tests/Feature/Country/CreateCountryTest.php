<?php

namespace Tests\Feature\Country;

use App\Models\Country;
use App\Models\File;
use Tests\TestCase;

class CreateCountryTest extends TestCase
{
    public function test_creates_country(): void
    {
        $country = Country::factory()->makeOne();

        $response = $this
            ->post('/api/countries', $country->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($created['name'], $country->name);
    }
}
