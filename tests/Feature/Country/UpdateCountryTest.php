<?php

namespace Tests\Feature\Country;

use App\Models\Country;
use Tests\TestCase;

class UpdateCountryTest extends TestCase
{
    public function test_updates_country(): void
    {
        $former = Country::factory()->create();
        $latter = Country::factory()->makeOne();

        $response = $this
            ->patch("/api/countries/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->flag_id, $updated['flag_id']);
    }
}
