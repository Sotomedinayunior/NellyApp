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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');

            $table->string('descripcion');
            $table->integer('precio');
            $table->integer('equipaje');
            $table->integer('capacidad');
            $table->string('tipo');
            $table->string('transmision');
            $table->boolean('bluetooth');
            $table->boolean('siriusX');
            $table->boolean('GpS');
            $table->boolean('apple_cars');
            $table->unsignedBigInteger('landing_id');
            $table->timestamps();

            // Definición de la clave externa (foreign key)
            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};