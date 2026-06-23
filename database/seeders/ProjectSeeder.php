<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $projects = [
            [
                'title' => 'Sistema de Gestión Escolar POO',
                'slug' => 'sistema-gestion-escolar-poo',
                'description' => 'Aplicación de escritorio robusta desarrollada en Java aplicando patrones de diseño estructural y persistencia de datos.',
                'short_description' => 'Aplicación de escritorio en Java orientada a gestión escolar con persistencia y enfoque POO.',
                'technologies' => 'Java, MySQL, OOP',
                'stack_summary' => 'Java + MySQL',
                'image_url' => null,
                'project_url' => null,
                'repo_url' => null,
                'status' => 'published',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Orquestador de Microservicios en Linux',
                'slug' => 'orquestador-microservicios-linux',
                'description' => 'Despliegue automatizado de clústeres locales utilizando Docker, scripts en Python para monitoreo y políticas de red.',
                'short_description' => 'Entorno técnico para automatizar despliegues locales, monitoreo y red sobre Linux.',
                'technologies' => 'Docker, Linux, Python, Bash',
                'stack_summary' => 'Docker + Python + Linux',
                'image_url' => null,
                'project_url' => null,
                'repo_url' => null,
                'status' => 'published',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Controlador Inmótico de Iluminación KNX',
                'slug' => 'controlador-inmotico-iluminacion-knx',
                'description' => 'Pasarela IoT para la automatización de edificios inteligentes comunicando controladores BACnet con sensores bajo el protocolo KNX.',
                'short_description' => 'Pasarela técnica para integración inmótica entre BACnet, sensores y automatización KNX.',
                'technologies' => 'KNX, BACnet, IoT, C++',
                'stack_summary' => 'KNX + BACnet + C++',
                'image_url' => null,
                'project_url' => null,
                'repo_url' => null,
                'status' => 'published',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            $exists = DB::table('projects')
                ->where('title', $project['title'])
                ->exists();

            DB::table('projects')->updateOrInsert(
                ['title' => $project['title']],
                array_merge($project, [
                    'updated_at' => $now,
                    'created_at' => $exists ? DB::raw('created_at') : $now,
                ])
            );
        }
    }
}
