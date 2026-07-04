<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_assistant_instances')->insert([
            [
                'name' => 'Home Assistant Principal',
                'slug' => 'home-assistant-principal',
                'version' => '2026.5',
                'location_name' => 'Laboratorio principal',
                'access_url' => 'http://homeassistant.local:8123',
                'description' => 'Instancia principal para automatización doméstica, monitorización y pruebas de integración.',
                'status' => 'active',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
