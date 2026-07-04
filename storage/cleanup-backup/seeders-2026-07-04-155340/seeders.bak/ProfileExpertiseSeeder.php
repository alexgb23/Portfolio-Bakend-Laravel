<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileExpertiseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profile_expertise')->insert([
            [
                'title' => 'Desarrollo Full Stack',
                'text' => 'Aplicaciones modernas con React, Laravel, JavaScript, Python y Java.',
                'icon_key' => 'code',
                'tone' => 'tone-0',
                'sort_order' => 1,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bases de Datos',
                'text' => 'Diseño y optimización de bases SQL y PostgreSQL para aplicaciones profesionales.',
                'icon_key' => 'database',
                'tone' => 'tone-1',
                'sort_order' => 2,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Infraestructura y Redes',
                'text' => 'Servidores Linux, virtualización, redes empresariales y despliegues IT.',
                'icon_key' => 'network',
                'tone' => 'tone-2',
                'sort_order' => 3,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Domótica e Inmótica',
                'text' => 'Automatización de viviendas y edificios inteligentes conectados.',
                'icon_key' => 'microchip',
                'tone' => 'tone-0',
                'sort_order' => 4,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
