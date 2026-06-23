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
    Schema::create('servers', function (Blueprint $table) {
        $table->id();
        $table->string('hostname');    // Ejemplo: vps-render-db
        $table->string('os');          // Ejemplo: Linux Ubuntu 22.04
        $table->string('public_ip');   // Ejemplo: 185.230.14.2
        $table->string('cpu_usage');   // Ejemplo: 14%
        $table->string('ram_usage');   // Ejemplo: 1.2GB / 4GB
        $table->string('uptime');      // Ejemplo: 99.98%
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
