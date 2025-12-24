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
        Schema::create('academic_levels', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->unique();
            $table->string('name_en')->unique();
            $table->string('name_np')->nullable();
            $table->text('icon')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->text('images')->nullable();
            $table->text('tagline_np')->nullable();
            $table->text('tagline_en')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_np')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_np')->nullable();
            $table->integer('display_order');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_levels');
    }
};
