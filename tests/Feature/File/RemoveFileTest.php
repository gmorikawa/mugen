<?php

namespace Tests\Feature\File;

use App\Models\File;
use Tests\TestCase;

class RemoveFileTest extends TestCase
{
    public function test_it_removes_a_file(): void
    {
        $company = File::factory()->create();

        $response = $this
            ->delete("/api/files/{$company->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('files', $company->toArray());
    }
}
