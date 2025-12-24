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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('download_category_id')->nullable();
            $table->foreign('download_category_id')->references('id')->on('download_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->string('name_en');
            $table->string('name_np')->nullable();
            $table->longText('file')->nullable();
            $table->integer('display_order');
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
