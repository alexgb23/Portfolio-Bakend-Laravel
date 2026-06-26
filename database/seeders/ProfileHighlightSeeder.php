<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileHighlightSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profile_highlights')->insert([
            [
                'number' => '01',
                'title' => 'Full Stack',
                'text' => 'Desarrollo frontend y backend, aplicaciones web modernas y APIs empresariales.',
                'side' => 'left',
                'sort_order' => 1,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '02',
                'title' => 'Sistemas IT',
                'text' => 'Administración Linux, servidores, servicios y entornos profesionales.',
                'side' => 'right',
                'sort_order' => 2,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '03',
                'title' => 'Bases de Datos',
                'text' => 'Diseño, modelado y optimización SQL, PostgreSQL y sistemas empresariales.',
                'side' => 'left',
                'sort_order' => 3,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '04',
                'title' => 'Redes',
                'text' => 'VLANs, routing, segmentación, seguridad y conectividad profesional.',
                'side' => 'right',
                'sort_order' => 4,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '05',
                'title' => 'Automatización',
                'text' => 'Domótica, inmótica e integración de dispositivos inteligentes.',
                'side' => 'left',
                'sort_order' => 5,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '06',
                'title' => 'Virtualización',
                'text' => 'Proxmox, Docker, laboratorios IT y despliegues escalables.',
                'side' => 'right',
                'sort_order' => 6,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
