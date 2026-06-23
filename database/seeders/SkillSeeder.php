<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'category' => 'backend',
                'proficiency_level' => 'advanced',
                'proficiency_score' => 4,
                'icon_name' => 'laravel',
                'description' => 'Desarrollo de APIs, migraciones, seeders y estructura backend para aplicaciones web.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'category' => 'devops',
                'proficiency_level' => 'advanced',
                'proficiency_score' => 4,
                'icon_name' => 'docker',
                'description' => 'Contenerización de servicios, despliegue local y orquestación básica de entornos.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proxmox',
                'slug' => 'proxmox',
                'category' => 'virtualization',
                'proficiency_level' => 'advanced',
                'proficiency_score' => 4,
                'icon_name' => 'server',
                'description' => 'Virtualización, clúster, gestión de nodos y soporte para servicios autoalojados.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home Assistant',
                'slug' => 'home-assistant',
                'category' => 'automation',
                'proficiency_level' => 'intermediate',
                'proficiency_score' => 3,
                'icon_name' => 'home',
                'description' => 'Automatización domótica, integración de servicios y diseño de casos de uso del laboratorio.',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'pfSense',
                'slug' => 'pfsense',
                'category' => 'networking',
                'proficiency_level' => 'intermediate',
                'proficiency_score' => 3,
                'icon_name' => 'shield',
                'description' => 'Segmentación de red, políticas de firewall y soporte de infraestructura segura.',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ollama',
                'slug' => 'ollama',
                'category' => 'ai',
                'proficiency_level' => 'intermediate',
                'proficiency_score' => 3,
                'icon_name' => 'cpu',
                'description' => 'Despliegue y pruebas de modelos locales de IA en entorno autoalojado.',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
