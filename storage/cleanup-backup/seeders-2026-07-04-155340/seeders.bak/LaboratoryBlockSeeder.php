<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoryBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laboratory_blocks')->insert([
            [
                'name' => 'Laboratory Hero',
                'slug' => 'laboratory-hero',
                'block_key' => 'hero',
                'kicker' => 'Laboratorio técnico',
                'title' => 'Entorno vivo de sistemas, automatización y experimentación',
                'description' => 'Espacio donde documento infraestructura, automatizaciones reales en casa, pruebas con IA local y futuros sistemas de análisis conectados a APIs y paneles de observación.',
                'layout_type' => 'hero',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infrastructure Section',
                'slug' => 'infrastructure-section',
                'block_key' => 'infrastructure',
                'kicker' => 'Infraestructura',
                'title' => 'Servidores, servicios y lectura operativa',
                'description' => 'Base técnica del laboratorio donde organizo despliegues, conectividad, disponibilidad y observación del estado del sistema.',
                'layout_type' => 'metrics',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automation Section',
                'slug' => 'automation-section',
                'block_key' => 'automation',
                'kicker' => 'Automatización',
                'title' => 'Nodos, controladores y lógica conectada',
                'description' => 'Área orientada a integración hardware, red y software para pruebas funcionales, lectura de señales y automatismos técnicos.',
                'layout_type' => 'list',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => false,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home Assistant Section',
                'slug' => 'home-assistant-section',
                'block_key' => 'home_assistant',
                'kicker' => 'Home Assistant',
                'title' => 'Domótica real desplegada en casa',
                'description' => 'Entorno doméstico donde centralizo automatizaciones, estados, dispositivos y escenas para experimentar con control y observabilidad del hogar.',
                'layout_type' => 'story',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => false,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Local AI Section',
                'slug' => 'local-ai-section',
                'block_key' => 'local_ai',
                'kicker' => 'IA local',
                'title' => 'Experimentos con modelos corriendo en local',
                'description' => 'Zona enfocada en instalar, comparar y evaluar soluciones de IA local para automatización, productividad y análisis aplicado.',
                'layout_type' => 'cards',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => false,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Research Lab Section',
                'slug' => 'research-lab-section',
                'block_key' => 'research_lab',
                'kicker' => 'Research lab',
                'title' => 'Análisis experimental y estudio de mercado',
                'description' => 'Área en evolución para conectar fuentes externas, procesar datos, crear comparativas y estudiar señales útiles con apoyo de IA y APIs.',
                'layout_type' => 'research',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => false,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Capabilities Section',
                'slug' => 'capabilities-section',
                'block_key' => 'capabilities',
                'kicker' => 'Capacidades',
                'title' => 'Líneas activas y áreas en evolución',
                'description' => 'Este laboratorio une infraestructura, domótica, redes, automatización e investigación aplicada dentro de un mismo ecosistema técnico.',
                'layout_type' => 'tags',
                'status' => 'active',
                'is_visible' => true,
                'is_featured' => false,
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
