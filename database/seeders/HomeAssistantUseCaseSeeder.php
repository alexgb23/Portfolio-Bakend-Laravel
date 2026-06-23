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
        $now = now();

        $instanceId = DB::table('home_assistant_instances')
            ->where('slug', 'home-assistant-principal')
            ->value('id');

        if (! $instanceId) {
            return;
        }

        $useCases = [
            [
                'home_assistant_instance_id' => $instanceId,
                'title' => 'Automatización de iluminación',
                'category' => 'domótica',
                'description' => 'Automatización de luces por horarios, presencia y condiciones del entorno.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'home_assistant_instance_id' => $instanceId,
                'title' => 'Monitorización energética',
                'category' => 'energía',
                'description' => 'Seguimiento de consumos, estados y métricas energéticas del entorno.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'home_assistant_instance_id' => $instanceId,
                'title' => 'Alertas y notificaciones',
                'category' => 'automatización',
                'description' => 'Generación de alertas para eventos, incidencias o cambios de estado relevantes.',
                'status' => 'active',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($useCases as $useCase) {
            DB::table('home_assistant_use_cases')->updateOrInsert(
                [
                    'home_assistant_instance_id' => $useCase['home_assistant_instance_id'],
                    'title' => $useCase['title'],
                ],
                array_merge($useCase, [
                    'updated_at' => $now,
                    'created_at' => $now,
                ])
            );
        }
    }
}
