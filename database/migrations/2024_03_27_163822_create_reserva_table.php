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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email');
            $table->unsignedBigInteger('landing_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->timestamps();

            // Definición de las claves externas (foreign keys)
            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};