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
        Schema::table('servers', function (Blueprint $table) {
            // Nombre visible y función
            $table->string('display_name')->nullable()->after('hostname');
            $table->string('role')->nullable()->after('display_name');

            // Origen e infraestructura
            $table->string('provider')->nullable()->after('role');
            $table->string('environment')->nullable()->after('provider');
            $table->string('location_name')->nullable()->after('environment');
            $table->string('virtualization_type')->nullable()->after('location_name');

            // Estado y presentación
            $table->string('status')->default('online')->after('uptime');
            $table->text('notes')->nullable()->after('status');
            $table->boolean('is_featured')->default(false)->after('notes');
            $table->unsignedInteger('sort_order')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn([
                'display_name',
                'role',
                'provider',
                'environment',
                'location_name',
                'virtualization_type',
                'status',
                'notes',
                'is_featured',
                'sort_order',
            ]);
        });
    }
};
