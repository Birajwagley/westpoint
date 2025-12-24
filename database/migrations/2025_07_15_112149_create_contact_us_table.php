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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('contact_no');
            $table->string('email');
            $table->text('message');

            $table->boolean('is_contacted')->default(false);
            $table->longText('contact_remarks')->nullable();

            $table->unsignedBigInteger('contacted_by')->nullable();
            $table->foreign('contacted_by')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
