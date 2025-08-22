<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 127);
            $table->foreignUuid('platform_id');
            $table->date('release_date')->nullable(true);
            $table->foreignUuid('cover_id')->nullable(true);
            $table->timestamps();

            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->foreign('cover_id')->references('id')->on('files')->onDelete('cascade');
        });

        Schema::create('game_category', function (Blueprint $table) {
            $table->foreignUuid('game_id');
            $table->foreignUuid('category_id');

            $table->primary(['game_id', 'category_id']);

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('game_developer', function (Blueprint $table) {
            $table->foreignUuid('game_id');
            $table->foreignUuid('company_id');

            $table->primary(['game_id', 'company_id']);

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::create('game_publisher', function (Blueprint $table) {
            $table->foreignUuid('game_id');
            $table->foreignUuid('company_id');

            $table->primary(['game_id', 'company_id']);

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
        Schema::dropIfExists('game_category');
        Schema::dropIfExists('game_developer');
        Schema::dropIfExists('game_publisher');
    }
};
