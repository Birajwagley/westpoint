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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('slug')->unique()->nullable();

            $table->string('name_en')->unique();
            $table->string('name_np')->nullable();

            $table->text('external_link')->nullable();

            $table->boolean('is_featured_navigation')->default(false);
            $table->text('icon')->nullable();

            $table->integer('display_order');
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign('menus_parent_id_foreign');
            $table->dropColumn('parent_id');
        });

        Schema::dropIfExists('menus');
    }
};
