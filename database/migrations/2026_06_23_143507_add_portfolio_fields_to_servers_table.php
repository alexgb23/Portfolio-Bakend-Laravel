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

            $table->string('hostname')->unique();
            $table->string('display_name')->nullable();
            $table->string('role')->nullable();

            $table->string('provider')->nullable();
            $table->string('environment')->nullable();
            $table->string('location_name')->nullable();
            $table->string('virtualization_type')->nullable();

            $table->string('os');
            $table->string('public_ip')->nullable();
            $table->string('cpu_usage');
            $table->string('ram_usage');
            $table->string('uptime');

            $table->string('status')->default('online');
            $table->text('notes')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

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
