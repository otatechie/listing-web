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
        Schema::create('beat_stats', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->integer('plays_count')->default(0);
            $table->integer('downloads_count')->default(0);
            $table->timestamps();
            $table->foreignUlid('beat_id')->constrained('beats')->onDelete('cascade');
            $table->index('plays_count');
            $table->index('downloads_count');
            $table->index('beat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beat_stats');
    }
};
