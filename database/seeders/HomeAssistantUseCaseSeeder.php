<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeAssistantUseCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_assistant_use_cases')->insert([
            [
                'home_assistant_instance_id' => 1,
                'title' => 'Automatización de iluminación',
                'category' => 'domótica',
                'description' => 'Automatización de luces por horarios, presencia y condiciones del entorno.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'home_assistant_instance_id' => 1,
                'title' => 'Monitorización energética',
                'category' => 'energía',
                'description' => 'Seguimiento de consumos, estados y métricas energéticas del entorno.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'home_assistant_instance_id' => 1,
                'title' => 'Alertas y notificaciones',
                'category' => 'automatización',
                'description' => 'Generación de alertas para eventos, incidencias o cambios de estado relevantes.',
                'status' => 'active',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
