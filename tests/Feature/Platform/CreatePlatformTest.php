<?php

namespace Tests\Feature\Platform;

use App\Models\Platform;
use Tests\TestCase;

class CreatePlatformTest extends TestCase
{
    public function test_creates_platform(): void
    {
        $platform = Platform::factory()->makeOne();

        $response = $this
            ->post('/api/platforms', $platform->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($platform->name, $created['name']);
        $this->assertEquals($platform->abbreviation, $created['abbreviation']);
        $this->assertEquals($platform->type, $created['type']);
        $this->assertEquals($platform->developer_id, $created['developer_id']);
        $this->assertEquals($platform->manufacturer_id, $created['manufacturer_id']);
    }
}
