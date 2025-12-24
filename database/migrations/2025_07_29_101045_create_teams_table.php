<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('name_en');
            $table->string('name_np')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();

            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');

            $table->text('image')->nullable();
            $table->text('facebook')->nullable();
            $table->text('linked_in')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_np')->nullable();
            $table->integer('display_order');
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
        Schema::dropIfExists('teams');
    }
};
