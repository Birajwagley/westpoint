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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alumni_form_id')->nullable();
            $table->foreign('alumni_form_id')->references('id')->on('alumni_form')->onDelete('cascade')->onUpdate('cascade');

            $table->text('image')->nullable();
            $table->string('full_name');
            $table->longText('testimonial_text');
            $table->text('testimonial_video')->nullable();
            $table->string('perspective_from')->nullable();
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
