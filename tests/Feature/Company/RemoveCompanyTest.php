<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class RemoveCompanyTest extends TestCase
{
    public function test_it_removes_a_company(): void
    {
        $company = Company::factory()->create();

        $response = $this
            ->delete("/api/companies/{$company->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('companies', $company->toArray());
    }
}
