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
        Schema::create('volunteer_form', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->date('date_of_birth_ad');
            $table->string('date_of_birth_bs');
            $table->integer('age');

            $table->string('gender');
            $table->string('other_gender')->nullable();

            $table->string('nationality');
            $table->string('passport_number')->nullable();
            $table->string('email');
            $table->string('contact_no');
            $table->string('current_address');

            $table->string('emergency_full_name');
            $table->string('emergency_relationship');
            $table->string('emergency_contact_number');
            $table->string('emergency_email');

            $table->longText('area_of_interest');
            $table->longText('skill_experties');
            $table->longText('motivation');
            $table->longText('previous_volunteer_experience');

            $table->date('start_date');
            $table->date('end_date');

            $table->string('daily_availability');
            $table->boolean('accomodation_required')->default(false);
            $table->longText('dietary_restriction')->nullable();

            $table->boolean('medical_condition')->default(false);
            $table->longText('medical_description')->nullable();

            $table->boolean('travel_insurance')->default(false);
            $table->longText('insurance_proof')->nullable();
            $table->text('remarks')->nullable();
            $table->text('cv')->nullable();
            $table->text('passport_copy')->nullable();
            $table->text('visa_copy')->nullable();

            $table->boolean('criminal_record')->default(false);
            $table->boolean('aggrement')->default(false);
            $table->boolean('is_scanned')->default(false);
            $table->boolean('is_shortlisted')->default(false);

            $table->text('digital_signature')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_form');
    }
};
