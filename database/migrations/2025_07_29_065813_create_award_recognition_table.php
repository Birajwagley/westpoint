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
        Schema::create('award_recognition', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('award_type')->nullable();

            $table->string('title_en');
            $table->string('title_np')->nullable();
            $table->text('image')->nullable();

            $table->text('short_description_en');
            $table->text('short_description_np')->nullable();

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
        Schema::dropIfExists('award_recognition');
    }
};
