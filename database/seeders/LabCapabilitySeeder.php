<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabCapabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lab_capabilities')->insert([
            [
                'title' => 'Virtualización y clúster Proxmox',
                'slug' => 'virtualizacion-cluster-proxmox',
                'category' => 'virtualization',
                'capability_level' => 'advanced',
                'description' => 'Capacidad para desplegar y administrar nodos de virtualización, cargas de trabajo y agrupación de infraestructura en Proxmox.',
                'technical_notes' => 'Incluye nodos de hypervisor, gestión centralizada y base para servicios autoalojados del laboratorio.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Segmentación de red y firewalling',
                'slug' => 'segmentacion-red-firewalling',
                'category' => 'networking',
                'capability_level' => 'advanced',
                'description' => 'Capacidad para aislar servicios, aplicar políticas de red y gestionar el tráfico interno mediante firewall dedicado.',
                'technical_notes' => 'Apoyado en pfSense para control de red, seguridad y separación lógica del entorno.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Backups y recuperación',
                'slug' => 'backups-recuperacion',
                'category' => 'backup',
                'capability_level' => 'advanced',
                'description' => 'Capacidad para realizar copias de seguridad y mantener estrategias de recuperación para servicios e infraestructura.',
                'technical_notes' => 'Incluye servidor Proxmox Backup Server y flujos de protección del laboratorio.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'IA local autoalojada',
                'slug' => 'ia-local-autoalojada',
                'category' => 'ai',
                'capability_level' => 'intermediate',
                'description' => 'Capacidad para ejecutar modelos y servicios de IA en infraestructura propia, con control local del entorno.',
                'technical_notes' => 'Incluye pruebas con Ollama, LocalAI y servicios compatibles con API local.',
                'status' => 'active',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Automatización domótica',
                'slug' => 'automatizacion-domotica',
                'category' => 'automation',
                'capability_level' => 'intermediate',
                'description' => 'Capacidad para integrar sensores, servicios y flujos domóticos sobre Home Assistant y sistemas conectados.',
                'technical_notes' => 'Relacionada con automatización, observación del entorno y orquestación de eventos.',
                'status' => 'active',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
