<?php

use App\Enums\PlatformType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 127)->unique();
            $table->string('abbreviation', 63)->unique();
            $table->enum('type', array_column(PlatformType::cases(), 'value'))->default(PlatformType::HOME->value);
            $table->foreignUuid('developer_id')->nullable(true);
            $table->foreignUuid('manufacturer_id')->nullable(true);
            $table->timestamps();

            $table->foreign('developer_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('manufacturer_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
