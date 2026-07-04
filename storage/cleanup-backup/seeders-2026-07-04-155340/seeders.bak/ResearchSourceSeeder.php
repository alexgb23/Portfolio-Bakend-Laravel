<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('research_sources')->insert([
            [
                'title' => 'Documentación oficial de Home Assistant',
                'slug' => 'documentacion-oficial-home-assistant',
                'source_type' => 'documentation',
                'author_name' => 'Home Assistant',
                'publisher_name' => 'Home Assistant',
                'published_on' => null,
                'url' => 'https://www.home-assistant.io/',
                'reference_code' => null,
                'summary' => 'Fuente principal para consultas técnicas sobre automatización, integraciones y configuración de Home Assistant.',
                'notes' => 'Utilizada como referencia base para laboratorio domótico e integraciones.',
                'topic' => 'home-assistant',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Documentación oficial de Proxmox VE',
                'slug' => 'documentacion-oficial-proxmox-ve',
                'source_type' => 'documentation',
                'author_name' => 'Proxmox',
                'publisher_name' => 'Proxmox',
                'published_on' => null,
                'url' => 'https://www.proxmox.com/en/proxmox-virtual-environment/overview',
                'reference_code' => null,
                'summary' => 'Referencia técnica para virtualización, clústeres y administración de infraestructura en laboratorio.',
                'notes' => 'Usada para diseño y operación del clúster Proxmox del homelab.',
                'topic' => 'proxmox',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Documentación oficial de pfSense',
                'slug' => 'documentacion-oficial-pfsense',
                'source_type' => 'documentation',
                'author_name' => 'Netgate',
                'publisher_name' => 'Netgate',
                'published_on' => null,
                'url' => 'https://docs.netgate.com/pfsense/en/latest/',
                'reference_code' => null,
                'summary' => 'Referencia técnica para red, firewalling, segmentación y servicios de seguridad en la infraestructura.',
                'notes' => 'Base para diseño y mantenimiento de la parte de red del laboratorio.',
                'topic' => 'networking',
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
