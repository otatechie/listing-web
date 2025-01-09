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
        Schema::create('recent_plays', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('beat_id')->constrained()->onDelete('cascade');
            $table->timestamp('play_timestamp')->useCurrent();
            $table->string('device')->nullable();
            $table->integer('duration')->nullable();
            $table->unique(['user_id', 'beat_id'], 'unique_play');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recent_plays');
    }
};
