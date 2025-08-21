<?php

namespace Tests\Feature\Image;

use App\Models\Image;
use Tests\TestCase;

class RemoveImageTest extends TestCase
{
    public function test_removes_image(): void
    {
        $image = Image::factory()->create();

        $response = $this
            ->delete("/api/images/{$image->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('images', $image->toArray());
    }
}
