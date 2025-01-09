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
        Schema::create('mobile_devices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);

            // $table->foreignUlid('brand_id')->constrained('brands')->onDelete('cascade');
            // $table->foreignUlid('model_number')->constrained('models')->onDelete('cascade');
            // $table->foreignUlid('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('listing_title');
            $table->text('listing_description');
            $table->text('damage_wear_description')->nullable();
            $table->boolean('exchange_possible')->default(false);
            $table->string('carrier')->nullable();
            $table->string('color')->nullable();
            $table->string('storage_capacity')->nullable();
            $table->string('location')->nullable();
            $table->string('battery_health')->nullable();
            $table->enum('condition', ['new', 'mint', 'good', 'fair'])->default('new');
            $table->decimal('price', 10, 2);
            $table->foreignUlid('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_devices');
    }
};
