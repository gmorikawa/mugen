<?php

namespace Tests\Feature\ColorEncoding;

use App\Models\ColorEncoding;
use Tests\TestCase;

class RemoveColorEncodingTest extends TestCase
{
    public function test_removes_color_encoding(): void
    {
        $color_encoding = ColorEncoding::factory()->create();

        $response = $this
            ->delete("/api/color-encodings/{$color_encoding->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('color_encodings', $color_encoding->toArray());
    }
}
