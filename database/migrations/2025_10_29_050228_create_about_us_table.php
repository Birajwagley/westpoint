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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            $table->text('image_one')->nullable();
            $table->text('image_two')->nullable();
            $table->text('image_three')->nullable();
            $table->string('title_en');
            $table->string('title_np')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_np')->nullable();
            $table->longText('mission_en')->nullable();
            $table->longText('mission_np')->nullable();
            $table->longText('vision_en')->nullable();
            $table->longText('vision_np')->nullable();

            $table->timestamps();
        });

        Schema::create('about_us_cronology', function (Blueprint $table) {
            $table->id();

            $table->string('name_en');
            $table->string('name_np')->nullable();
            $table->string('date_en');
            $table->string('date_np')->nullable();
            $table->longText('description_en');
            $table->longText('description_np')->nullable();

            $table->timestamps();
        });

        Schema::create('about_us_card', function (Blueprint $table) {
            $table->id();

            $table->string('name_en');
            $table->string('name_np')->nullable();
            $table->text('link');
            $table->text('image')->nullable();
            $table->text('short_description_en');
            $table->text('short_description_np')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
        Schema::dropIfExists('about_us_cronology');
        Schema::dropIfExists('about_us_card');
    }
};
