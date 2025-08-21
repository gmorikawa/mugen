<?php

namespace Tests\Feature\Image;

use App\Models\Image;
use Tests\TestCase;

class CreateImageTest extends TestCase
{
    public function test_creates_image(): void
    {
        $image = Image::factory()->makeOne();

        $response = $this
            ->post('/api/images', $image->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($image->game_id, $created['game_id']);
        $this->assertEquals($image->color_encoding_id, $created['color_encoding_id']);
        $this->assertEquals($image->file_id, $created['file_id']);
        $this->assertEquals($image->description, $created['description']);
    }
}
