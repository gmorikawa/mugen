<?php

namespace Tests\Feature\Platform;

use App\Models\Platform;
use Tests\TestCase;

class UpdatePlatformTest extends TestCase
{
    public function test_updates_platform(): void
    {
        $former = Platform::factory()->create();
        $latter = Platform::factory()->makeOne();

        $response = $this
            ->patch("/api/platforms/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->abbreviation, $updated['abbreviation']);
        $this->assertEquals($latter->type, $updated['type']);
        $this->assertEquals($latter->developer_id, $updated['developer_id']);
        $this->assertEquals($latter->manufacturer_id, $updated['manufacturer_id']);
    }
}
