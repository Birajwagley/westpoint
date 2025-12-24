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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();

            $table->string('name_en')->unique();
            $table->string('name_np')->nullable();

            $table->text('thumbnail_image')->nullable();
            $table->text('images')->nullable();

            $table->text('short_description_en')->nullable();
            $table->text('short_description_np')->nullable();

            $table->longText('description_en')->nullable();
            $table->longText('description_np')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->string('display_order');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
