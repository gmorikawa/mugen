<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    public function test_it_updates_a_company(): void
    {
        $former = Company::factory()->create();
        $latter = Company::factory()->makeOne();

        $response = $this
            ->patch("/api/companies/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($updated['id'], $former->id);
        $this->assertEquals($updated['name'], $latter->name);
        $this->assertEquals($updated['description'], $latter->description);

        $this->assertNotEquals($updated['name'], $former->name);
        $this->assertNotEquals($updated['description'], $former->description);
    }
}
