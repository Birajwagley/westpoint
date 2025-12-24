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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('career_id')->nullable();
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade')->onUpdate('cascade');

            $table->string('full_name');
            $table->string('gender');
            $table->string('other_gender')->nullable();
            $table->date('date_of_birth_ad');
            $table->string('date_of_birth_bs');
            $table->integer('age');
            $table->string('current_address');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('phone_no')->nullable();
            $table->string('highest_education_qualification');
            $table->text('cover_letter');
            $table->text('remarks')->nullable();
            $table->longText('cv')->nullable();
            $table->boolean('is_scanned')->default(false);
            $table->boolean('is_shortlisted')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
