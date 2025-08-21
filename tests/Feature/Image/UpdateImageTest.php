<?php

namespace Tests\Feature\Image;

use App\Models\Image;
use Tests\TestCase;

class UpdateImageTest extends TestCase
{
    public function test_updates_image(): void
    {
        $former = Image::factory()->create();
        $latter = Image::factory()->makeOne();

        $response = $this
            ->patch("/api/images/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->game_id, $updated['game_id']);
        $this->assertEquals($latter->color_encoding_id, $updated['color_encoding_id']);
        $this->assertEquals($latter->file_id, $updated['file_id']);
        $this->assertEquals($latter->description, $updated['description']);
    }
}
