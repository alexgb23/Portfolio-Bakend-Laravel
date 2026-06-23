<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_links')->insert([
            [
                'platform' => 'github',
                'icon_key' => 'github',
                'label' => 'GitHub',
                'title' => 'Alexgb23',
                'text' => 'Repos y código',
                'url' => 'https://github.com/alexgb23',
                'sort_order' => 1,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'linkedin',
                'icon_key' => 'linkedin',
                'label' => 'LinkedIn',
                'title' => 'Alexander Galvez',
                'text' => 'Perfil profesional',
                'url' => 'https://www.linkedin.com/in/alexander-galvez-benavides-450917281/',
                'sort_order' => 2,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'email',
                'icon_key' => 'envelope',
                'label' => 'Correo',
                'title' => 'Email',
                'text' => 'Contacto directo',
                'url' => 'mailto:alexandergalvez880208@gmail.com',
                'sort_order' => 3,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'web',
                'icon_key' => 'globe',
                'label' => 'Web',
                'title' => 'Cubalinks',
                'text' => 'Empresa y servicios',
                'url' => null,
                'sort_order' => 4,
                'is_visible' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'instagram',
                'icon_key' => 'instagram',
                'label' => 'Instagram',
                'title' => '@_aaleex_88',
                'text' => 'Perfil personal',
                'url' => 'https://instagram.com/_aaleex_88',
                'sort_order' => 5,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'facebook',
                'icon_key' => 'facebook',
                'label' => 'Facebook',
                'title' => 'Alexander Galvez Benavides',
                'text' => 'Perfil personal',
                'url' => 'https://www.facebook.com/alexander.galvez.benavides',
                'sort_order' => 6,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
