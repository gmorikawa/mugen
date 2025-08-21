<?php

namespace Tests\Feature\Platform;

use App\Models\Platform;
use Tests\TestCase;

class RemovePlatformTest extends TestCase
{
    public function test_removes_platform(): void
    {
        $platform = Platform::factory()->create();

        $response = $this
            ->delete("/api/platforms/{$platform->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('platforms', $platform->toArray());
    }
}
