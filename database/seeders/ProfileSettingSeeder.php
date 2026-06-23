<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profile_settings')->insert([
            'full_name' => 'Alexander Galvez',
            'display_name' => 'Alexander Galvez',
            'headline' => 'Desarrollador web y perfil técnico IT',
            'subheadline' => 'React, Laravel, infraestructura, automatización y despliegue de soluciones completas',
            'bio_short' => 'Desarrollador web y perfil técnico IT con enfoque en frontend moderno, backend con Laravel, APIs, cloud, infraestructura y automatización.',
            'bio_long' => 'Desarrollador web y perfil técnico IT con formación de Grado Superior y Bachillerato, especializado en frontend moderno con React y Vite, backend con Laravel y despliegue de proyectos en servidores cloud. Trabajo con APIs para alimentar dinámicamente mis aplicaciones y me gusta construir soluciones completas, desde la interfaz hasta la infraestructura que las soporta.

Además, cuento con formación en domótica e inmótica y experiencia práctica en homelab e infraestructura propia, incluyendo Proxmox, pfSense, VLANs y switch gestionable. Esta base me permite combinar desarrollo web con administración de sistemas, virtualización, redes y automatización, aportando una visión más completa y técnica de los proyectos.

Me considero una persona resolutiva, analítica y orientada a la mejora continua. He desarrollado proyectos propios de principio a fin, integrando frontend, backend, consumo de datos y despliegue, y aunque todavía no he trabajado formalmente en España, sí aporto una base técnica sólida, capacidad de adaptación y experiencia práctica con tecnologías actuales.',
            'location' => 'Barakaldo, País Vasco, España',
            'email_public' => 'alexandergalvez880208@gmail.com',
            'website_url' => null,
            'resume_url' => null,
            'status_label' => 'Disponible para colaboraciones y proyectos técnicos',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
