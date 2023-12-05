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
        Schema::create('facemark_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facemark_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->unique(['facemark_id', 'group_id']);
            $table->foreign('facemark_id')->references('id')->on('facemarks');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facemark_group');
    }
};
