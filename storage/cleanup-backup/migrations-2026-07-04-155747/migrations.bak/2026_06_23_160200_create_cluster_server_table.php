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
        Schema::create('cluster_server', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cluster_id')
                ->constrained('clusters')
                ->cascadeOnDelete();

            $table->foreignId('server_id')
                ->constrained('servers')
                ->cascadeOnDelete();

            $table->string('node_role')->nullable(); // manager, worker, hypervisor, quorum, backup
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->unique(['cluster_id', 'server_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cluster_server');
    }
};
