<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_messages')->insert([
            'name' => 'Mensaje de prueba',
            'email' => 'demo@portfolio.local',
            'subject' => 'Consulta inicial',
            'message' => 'Hola Alexander, este mensaje es un registro de prueba para validar el flujo del formulario de contacto del portfolio.',
            'status' => 'new',
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
