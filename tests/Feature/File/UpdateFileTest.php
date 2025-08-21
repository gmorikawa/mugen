<?php

namespace Tests\Feature\File;

use App\Models\File;
use Tests\TestCase;

class UpdateFileTest extends TestCase
{
    public function test_updates_file(): void
    {
        $former = File::factory()->create(['name' => 'game1.rom']);
        $latter = File::factory()->makeOne(['name' => 'game2.rom']);

        $response = $this
            ->patch("/api/files/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
    }
}
