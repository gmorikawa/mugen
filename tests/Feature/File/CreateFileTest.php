<?php

namespace Tests\Feature\File;

use App\Models\File;
use Tests\TestCase;

class CreateFileTest extends TestCase
{
    public function test_it_creates_a_file(): void
    {
        $file = File::factory()->makeOne();

        $response = $this
            ->post('/api/files', $file->toArray())
            ->assertStatus(201);
        
        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($created['name'], $file->name);
        // $this->assertEquals($created['concrete_name'], $file->name);
        // $this->assertEquals($created['path'], $file->path);
        // $this->assertEquals($created['size'], $file->size);
    }
}
