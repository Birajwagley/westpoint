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
        Schema::create('volunteer', function (Blueprint $table) {
            $table->id();

            $table->longText('images')->nullable();

            $table->longText('description_en')->nullable();
            $table->longText('description_np')->nullable();

            $table->longText('qualification_en')->nullable();
            $table->longText('qualification_np')->nullable();

            $table->longText('need_of_volunteer_en')->nullable();
            $table->longText('need_of_volunteer_np')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer');
    }
};
