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
        Schema::table('metrics', function (Blueprint $table) {
            // Contexto y origen
            $table->string('display_name')->nullable()->after('parameter');
            $table->string('category')->nullable()->after('display_name');
            $table->string('source_system')->nullable()->after('category');

            // Estado y tiempo
            $table->string('status')->default('normal')->after('unit');
            $table->timestamp('recorded_at')->nullable()->after('status');

            // Presentación
            $table->text('notes')->nullable()->after('recorded_at');
            $table->boolean('is_featured')->default(false)->after('notes');
            $table->unsignedInteger('sort_order')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metrics', function (Blueprint $table) {
            $table->dropColumn([
                'display_name',
                'category',
                'source_system',
                'status',
                'recorded_at',
                'notes',
                'is_featured',
                'sort_order',
            ]);
        });
    }
};
