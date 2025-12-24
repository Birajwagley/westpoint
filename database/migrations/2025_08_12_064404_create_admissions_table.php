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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->text('photo')->nullable();
            $table->text('dob_bs');
            $table->date('dob_ad');
            $table->string('age');
            $table->string('gender');
            $table->string('other_gender')->nullable();
            $table->string('permanent_address');
            $table->string('current_address');
            $table->string('nationality');
            $table->string('contact_no');
            $table->boolean('living_with_guardian')->default(false);
            $table->string('academic_year');
            $table->string('previous_school');
            $table->string('previous_school_address');
            $table->string('pick_drop_facility_needed')->default(false);
            $table->string('pick_drop_location')->nullable();

            $table->unsignedBigInteger('academic_level_id')->nullable();
            $table->foreign('academic_level_id')->references('id')->on('academic_levels')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('is_school')->default(false);
            $table->boolean('approval')->nullable()->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
