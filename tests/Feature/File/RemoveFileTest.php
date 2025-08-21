<?php

namespace Tests\Feature\File;

use App\Models\File;
use Tests\TestCase;

class RemoveFileTest extends TestCase
{
    public function test_removes_file(): void
    {
        $file = File::factory()->create();

        $response = $this
            ->delete("/api/files/{$file->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('files', $file->toArray());
    }
}
