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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_heading_menu');
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
            $table->string('parent_id')->nullable();

            $table->foreign('id_role')->on('roles')->references('id')->cascadeOnDelete();
            $table->foreign('id_heading_menu')->on('heading_menus')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
