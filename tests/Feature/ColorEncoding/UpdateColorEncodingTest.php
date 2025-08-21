<?php

namespace Tests\Feature\ColorEncoding;

use App\Models\ColorEncoding;
use Tests\TestCase;

class UpdateColorEncodingTest extends TestCase
{
    public function test_updates_color_encoding(): void
    {
        $former = ColorEncoding::factory()->create();
        $latter = ColorEncoding::factory()->makeOne();

        $response = $this
            ->patch("/api/color-encodings/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->description, $updated['description']);
    }
}
