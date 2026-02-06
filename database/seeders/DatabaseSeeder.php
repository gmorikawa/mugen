<?php

namespace Database\Seeders;

use App\Core\User\UserRole;
use App\Infrastructure\Persistence\Models\UserModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserModel::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => UserRole::ADMIN->value
        ]);
    }
}
