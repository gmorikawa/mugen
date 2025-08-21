<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    public function test_updates_company(): void
    {
        $former = Company::factory()->create();
        $latter = Company::factory()->makeOne();

        $response = $this
            ->patch("/api/companies/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->description, $updated['description']);
        $this->assertEquals($latter->country_id, $updated['country_id']);
    }
}
