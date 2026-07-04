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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();

            $table->string('node_name')->unique();
            $table->string('location_name')->nullable();

            $table->string('type');
            $table->string('source_system')->nullable();
            $table->string('protocol')->nullable();

            $table->string('current_value');
            $table->string('unit')->nullable();
            $table->string('ip_address')->nullable();

            $table->string('status');
            $table->timestamp('last_seen_at')->nullable();
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('nodes');
    }
};
