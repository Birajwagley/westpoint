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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faq_category_id')
                ->nullable()
                ->constrained('faq_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('question_en');
            $table->string('question_np')->nullable();

            $table->text('answer_en');
            $table->text('answer_np')->nullable();

            $table->integer('display_order')->default(0);
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
