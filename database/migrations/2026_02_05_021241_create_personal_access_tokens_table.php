<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('tokenable');
            $table->text('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};

// SQLSTATE[22P02]:
// Invalid text representation:
// 7 ERROR:
// invalid input syntax for type bigint:
// "019c2927-dc41-71d3-9a32-68530e654b25"
// CONTEXT: unnamed portal parameter $5 = '...' (
//     Connection: pgsql, SQL:
// insert into "personal_access_tokens" (
//     "name",
//     "token",
//     "abilities",
//     "expires_at",
//     "tokenable_id",
//     "tokenable_type",
//     "updated_at",
//     "created_at"
// )
// values (
//     auth_token,
//     c5a7801eb3b579ace8a14cd565281250e705888614fd8ec52db6f9d2d8c9651d,
//     ["*"],
//     ?,
//     019c2927-dc41-71d3-9a32-68530e654b25,
//     App\Models\UserModel,
//     2026-02-05 02:16:08,
//     2026-02-05 02:16:08
// ) returning "id")