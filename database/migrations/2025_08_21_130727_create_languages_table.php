<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 127);
            $table->string('iso_code', 7);
            $table->timestamps();
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
        Schema::dropIfExists('languages');
    }
};
