<?php

namespace Tests\Feature\Country;

use App\Models\Country;
use Tests\TestCase;

class UpdateCountryTest extends TestCase
{
    public function test_it_updates_a_country(): void
    {
        $former = Country::factory()->create();
        $latter = Country::factory()->makeOne();

        $response = $this
            ->patch("/api/countries/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($updated['id'], $former->id);
        $this->assertEquals($updated['name'], $latter->name);

        $this->assertNotEquals($updated['name'], $former->name);
    }
}
