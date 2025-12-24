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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('publication_category_id')->nullable();
            $table->foreign('publication_category_id')->references('id')->on('publication_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->date('published_date')->nullable();
            $table->string('author')->nullable();

            $table->string('name_en');
            $table->string('name_np')->nullable();

            $table->string('slug')->unique()->nullable();

            $table->text('thumbnail_image')->nullable();
            $table->text('images')->nullable();

            $table->text('short_description_en');
            $table->text('short_description_np')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_np')->nullable();

            $table->text('external_link')->nullable();
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
        Schema::dropIfExists('publications');
    }
};
