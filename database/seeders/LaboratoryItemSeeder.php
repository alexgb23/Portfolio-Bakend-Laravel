<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $items = [
            [
                'name' => 'Automatización doméstica',
                'slug' => 'automatizacion-domestica',
                'item_type' => 'workflow',
                'category' => 'automation',
                'location_name' => 'casa',
                'status' => 'active',
                'description' => 'Conjunto de escenarios y lógicas para automatización real del entorno doméstico.',
                'technical_notes' => 'Incluye eventos, sensores, escenas y reglas conectadas a Home Assistant.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Observabilidad del laboratorio',
                'slug' => 'observabilidad-laboratorio',
                'item_type' => 'platform',
                'category' => 'monitoring',
                'location_name' => 'homelab',
                'status' => 'active',
                'description' => 'Espacio orientado a lectura operativa, estado de servicios y seguimiento del entorno técnico.',
                'technical_notes' => 'Relaciona métricas, disponibilidad, paneles y estado general de infraestructura.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Home Assistant',
                'slug' => 'home-assistant',
                'item_type' => 'service',
                'category' => 'automation',
                'location_name' => 'casa',
                'status' => 'active',
                'description' => 'Plataforma principal de automatización domótica e integración de dispositivos.',
                'technical_notes' => 'Usada para escenarios domésticos, observación del hogar y orquestación de automatizaciones.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Pipeline de IA local',
                'slug' => 'pipeline-ia-local',
                'item_type' => 'service',
                'category' => 'ai',
                'location_name' => 'lab-services',
                'status' => 'active',
                'description' => 'Entorno de pruebas para ejecutar modelos locales orientados a productividad, automatización y análisis.',
                'technical_notes' => 'Incluye runtimes, comparación de modelos y evaluación de recursos en infraestructura propia.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Research API Lab',
                'slug' => 'research-api-lab',
                'item_type' => 'platform',
                'category' => 'research',
                'location_name' => 'lab-services',
                'status' => 'building',
                'description' => 'Área experimental para conectar fuentes, APIs y señales externas orientadas a análisis técnico y de mercado.',
                'technical_notes' => 'Preparado para alimentar comparativas, scoring, alertas y futuros paneles de investigación.',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            DB::table('laboratory_items')->updateOrInsert(
                ['slug' => $item['slug']],
                array_merge($item, [
                    'updated_at' => $now,
                    'created_at' => $now,
                ])
            );
        }
    }
}
