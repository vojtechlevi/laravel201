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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model'); //bilmärke
            $table->string('manufacturer'); // tillverkare
            $table->unsignedInteger('year'); //årsmodell
            $table->string('fueltype'); // El, Bensin, Disel
            $table->unsignedBigInteger('userId'); // vilken user är det som har bilen?
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
