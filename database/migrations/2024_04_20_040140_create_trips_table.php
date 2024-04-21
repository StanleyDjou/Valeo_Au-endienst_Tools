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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->integer('hotel_price')->nullable();
            $table->integer('distance')->nullable();
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('state' ,['passed', 'ongoing', 'planned'])->default('planned');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
