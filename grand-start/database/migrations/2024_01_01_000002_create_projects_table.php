<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Multilingual titles
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->string('title_ku')->nullable();

            // Multilingual descriptions
            $table->longText('description_ar');
            $table->longText('description_en')->nullable();
            $table->longText('description_ku')->nullable();

            // Multilingual locations
            $table->string('location_ar');
            $table->string('location_en')->nullable();
            $table->string('location_ku')->nullable();

            // Pricing
            $table->decimal('price_usd', 15, 2)->nullable();
            $table->decimal('price_iqd', 15, 0)->nullable();

            // Project details
            $table->string('area')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('units')->nullable();

            // Status & Type
            $table->enum('status', ['available', 'sold_out', 'under_construction', 'coming_soon'])->default('available');
            $table->enum('type', ['residential', 'commercial', 'villa', 'apartment', 'compound', 'tower'])->default('residential');

            // Flags
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);

            // Media
            $table->string('main_image')->nullable();
            $table->string('video_url')->nullable();

            // Map
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Dates
            $table->date('delivery_date')->nullable();

            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
