<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('game_id');
            $table->foreignUuid('color_encoding_id');
            $table->foreignUuid('file_id');
            $table->string('description', 255)->nullable(true);
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('color_encoding_id')->references('id')->on('color_encodings')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });

        Schema::create('image_language', function (Blueprint $table) {
            $table->foreignUuid('image_id');
            $table->foreignUuid('language_id');

            $table->primary(['image_id', 'language_id']);

            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_language');
        Schema::dropIfExists('images');
    }
};
