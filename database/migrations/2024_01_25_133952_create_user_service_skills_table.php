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
        Schema::create('user_service_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_service_id');
            $table->foreignId('skill_id');
            $table->timestamps();

            $table->foreign('user_service_id')->references('id')->on('user_services')->onDelete('CASCADE');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_service_skills');
    }
};
