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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('name_en');
            $table->string('name_np')->nullable();
            $table->string('slug')->unique();
            $table->longText('value')->nullable();
            $table->text('cover_image')->nullable();
            $table->integer('display_order');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
