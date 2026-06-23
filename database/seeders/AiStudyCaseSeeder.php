<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiStudyCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ai_study_cases')->insert([
            [
                'title' => 'Asistente local de IA para laboratorio doméstico',
                'slug' => 'asistente-local-ia-laboratorio-domestico',
                'category' => 'local-ai',
                'technology_stack' => 'Ollama, Open WebUI, Proxmox, Docker',
                'context' => 'Diseño de un entorno local de IA para pruebas privadas, automatización y evaluación de modelos en infraestructura propia.',
                'challenge' => 'Integrar modelos locales en un laboratorio doméstico manteniendo control del entorno, flexibilidad de despliegue y capacidad de prueba.',
                'solution' => 'Se desplegó un stack local con inferencia autoalojada, interfaz web y soporte para integración con servicios internos del laboratorio.',
                'results' => 'Se obtuvo un entorno reproducible para pruebas de modelos, validación técnica e integración con otros componentes del homelab.',
                'status' => 'published',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'API compatible para automatización con modelos locales',
                'slug' => 'api-compatible-automatizacion-modelos-locales',
                'category' => 'api-integration',
                'technology_stack' => 'LocalAI, REST API, Docker, Linux',
                'context' => 'Implementación de un servicio local compatible con flujos de automatización y consumo por aplicaciones internas.',
                'challenge' => 'Disponer de una interfaz sencilla y reutilizable para conectar herramientas y servicios con modelos ejecutados localmente.',
                'solution' => 'Se configuró una API local orientada a integración, con despliegue reproducible y enfoque en pruebas internas.',
                'results' => 'El laboratorio ganó una base útil para experimentar con automatización, consumo de modelos y validación de integraciones.',
                'status' => 'published',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
