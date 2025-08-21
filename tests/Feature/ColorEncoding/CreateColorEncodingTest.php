<?php

namespace Tests\Feature\ColorEncoding;

use App\Models\ColorEncoding;
use Tests\TestCase;

class CreateColorEncodingTest extends TestCase
{
    public function test_creates_color_encoding(): void
    {
        $color_encoding = ColorEncoding::factory()->makeOne();

        $response = $this
            ->post('/api/color-encodings', $color_encoding->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($color_encoding->name, $created['name']);
        $this->assertEquals($color_encoding->description, $created['description']);
    }
}
