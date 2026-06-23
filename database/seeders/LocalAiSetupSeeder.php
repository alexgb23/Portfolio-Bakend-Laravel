<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalAiSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('local_ai_setups')->insert([
            [
                'name' => 'Ollama + Open WebUI',
                'slug' => 'ollama-open-webui',
                'provider' => 'ollama',
                'model_name' => 'llama3',
                'model_size' => '8B',
                'base_url' => 'http://localhost:11434',
                'interface_name' => 'Open WebUI',
                'description' => 'Entorno local de IA para pruebas de inferencia, chat y evaluación de modelos autoalojados.',
                'hardware_notes' => 'Despliegue sobre laboratorio local con recursos dedicados y posibilidad de virtualización en Proxmox.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LocalAI API',
                'slug' => 'localai-api',
                'provider' => 'localai',
                'model_name' => 'mistral',
                'model_size' => '7B',
                'base_url' => 'http://localhost:8080',
                'interface_name' => 'REST API',
                'description' => 'Servicio local compatible con API estilo OpenAI para pruebas de integración y automatización.',
                'hardware_notes' => 'Orientado a integración interna con servicios locales del laboratorio.',
                'status' => 'standby',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
