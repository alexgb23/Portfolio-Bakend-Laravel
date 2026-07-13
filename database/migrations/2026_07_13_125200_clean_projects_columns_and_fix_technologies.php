<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('projects', 'referencia_externa')) {
                $columnsToDrop[] = 'referencia_externa';
            }

            if (Schema::hasColumn('projects', 'categoria')) {
                $columnsToDrop[] = 'categoria';
            }

            if ($columnsToDrop !== []) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'referencia_externa')) {
                $table->string('referencia_externa')->nullable()->after('resultado_actual');
            }

            if (! Schema::hasColumn('projects', 'categoria')) {
                $table->string('categoria')->nullable()->after('fecha_fin');
            }
        });
    }
};
