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
        Schema::create('copy_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facemark_id');
            $table->string('ip_address', 50);
            $table->timestamps();

            $table->foreign('facemark_id')->references('id')->on('facemarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_histories');
    }
};
