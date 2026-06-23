<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $metrics = [
            [
                'room' => 'Laboratorio de Redes',
                'parameter' => 'Temperatura Rack',
                'value' => 24.8,
                'unit' => '°C',
                'display_name' => 'Temperatura del rack',
                'category' => 'environment',
                'source_system' => 'homelab',
                'status' => 'normal',
                'recorded_at' => $now,
                'notes' => 'Métrica ambiental del rack principal del laboratorio.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'room' => 'Cuadro Eléctrico Inmótico',
                'parameter' => 'Consumo General',
                'value' => 1.45,
                'unit' => 'kW',
                'display_name' => 'Consumo general',
                'category' => 'energy',
                'source_system' => 'home-assistant',
                'status' => 'normal',
                'recorded_at' => $now,
                'notes' => 'Lectura agregada de consumo para control energético del entorno.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'room' => 'Servidor Principal',
                'parameter' => 'Humedad Ambiente',
                'value' => 45.2,
                'unit' => '%',
                'display_name' => 'Humedad ambiente',
                'category' => 'environment',
                'source_system' => 'homelab',
                'status' => 'normal',
                'recorded_at' => $now,
                'notes' => 'Lectura ambiental asociada al entorno técnico principal.',
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($metrics as $metric) {
            $exists = DB::table('metrics')
                ->where('room', $metric['room'])
                ->where('parameter', $metric['parameter'])
                ->exists();

            DB::table('metrics')->updateOrInsert(
                [
                    'room' => $metric['room'],
                    'parameter' => $metric['parameter'],
                ],
                array_merge($metric, [
                    'updated_at' => $now,
                    'created_at' => $exists ? DB::raw('created_at') : $now,
                ])
            );
        }
    }
}
