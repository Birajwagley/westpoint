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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->text('primary_logo')->nullable();
            $table->text('secondary_logo')->nullable();
            $table->text('experience_logo')->nullable();
            $table->text('favicon')->nullable();
            $table->text('school_overview_image')->nullable();

            $table->string('title_en');
            $table->string('title_np')->nullable();

            $table->string('address_en');
            $table->string('address_np')->nullable();

            $table->string('admission_notify_email')->nullable();
            $table->string('career_notify_email')->nullable();
            $table->string('volunteer_notify_email')->nullable();
            $table->string('feedback_notify_email')->nullable();

            $table->text('map');

            $table->json('contacts')->nullable();
            $table->json('emails')->nullable();

            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('x')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('youtube')->nullable();
            $table->text('youtube_video')->nullable();

            $table->json('call_to_action_buttons')->nullable();

            $table->text('schema_markup')->nullable();
            $table->text('canonical_url')->nullable();
            $table->text('keyword')->nullable();

            $table->longText('description_en')->nullable();
            $table->longText('description_np')->nullable();

            $table->longText('school_hour_en')->nullable();
            $table->longText('school_hour_np')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
