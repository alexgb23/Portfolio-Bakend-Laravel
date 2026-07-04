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

            $table->string('room');
            $table->string('parameter');
            $table->string('display_name')->nullable();
            $table->string('category')->nullable();
            $table->string('source_system')->nullable();

            $table->float('value');
            $table->string('unit');

            $table->string('status')->default('normal');
            $table->timestamp('recorded_at')->nullable();

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
        Schema::dropIfExists('metrics');
    }
};
