<?php

namespace Tests\Feature\File;

use App\Models\File;
use Tests\TestCase;

class CreateFileTest extends TestCase
{
    public function test_creates_file(): void
    {
        $file = File::factory()->makeOne();

        $response = $this
            ->post('/api/files', $file->toArray())
            ->assertStatus(201);
        
        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($file->name, $created['name']);
    }
}
