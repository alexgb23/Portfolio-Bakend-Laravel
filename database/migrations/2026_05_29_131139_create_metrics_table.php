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
    Schema::create('metrics', function (Blueprint $table) {
        $table->id();
        $table->string('room');        // Ejemplo: Salón Principal o Laboratorio
        $table->string('parameter');   // Ejemplo: Temperatura, Humedad, Consumo Eléctrico
        $table->float('value');        // Ejemplo: 22.5
        $table->string('unit');        // Ejemplo: °C, %, kWh, V
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
