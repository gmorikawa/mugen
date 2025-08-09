<?php

use App\Enums\FileState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 127);
            $table->string('concrete_name', 127);
            $table->string('path', 255);
            $table->integer('size', false, true);
            $table->enum('state', array_column(FileState::cases(), 'value'))->default(FileState::PENDING->value);
            $table->timestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('flag');
            $table->foreignUuid('flag_id')->nullable(true);
            $table->foreign('flag_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('flag', 127);
            $table->dropColumn('flag_id');
        });

        Schema::dropIfExists('files');
    }
};
