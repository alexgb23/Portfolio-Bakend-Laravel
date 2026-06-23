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
        Schema::table('nodes', function (Blueprint $table) {
            // Ubicación y procedencia
            $table->string('location_name')->nullable()->after('node_name');
            $table->string('source_system')->nullable()->after('type');

            // Datos técnicos
            $table->string('protocol')->nullable()->after('source_system');
            $table->string('unit')->nullable()->after('current_value');
            $table->string('ip_address')->nullable()->after('unit');

            // Estado operativo
            $table->timestamp('last_seen_at')->nullable()->after('status');
            $table->boolean('is_active')->default(true)->after('last_seen_at');

            // Presentación y control
            $table->text('notes')->nullable()->after('is_active');
            $table->boolean('is_featured')->default(false)->after('notes');
            $table->unsignedInteger('sort_order')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->dropColumn([
                'location_name',
                'source_system',
                'protocol',
                'unit',
                'ip_address',
                'last_seen_at',
                'is_active',
                'notes',
                'is_featured',
                'sort_order',
            ]);
        });
    }
};
