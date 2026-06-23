<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $nodes = [
            [
                'node_name' => 'SRV-CENTRAL',
                'type' => 'systems',
                'location_name' => 'homelab',
                'source_system' => 'proxmox',
                'protocol' => 'local',
                'current_value' => 'CPU 22% | RAM 4.1GB',
                'unit' => 'status',
                'ip_address' => '192.168.1.101',
                'status' => 'ok',
                'last_seen_at' => $now,
                'is_active' => true,
                'notes' => 'Nodo principal de lectura operativa asociado a servicios centrales del laboratorio.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'node_name' => 'NODE-KNX-01',
                'type' => 'domotica',
                'location_name' => 'casa',
                'source_system' => 'home-assistant',
                'protocol' => 'knx',
                'current_value' => 'ONLINE | 24.5°C',
                'unit' => 'temperature',
                'ip_address' => '192.168.1.210',
                'status' => 'ok',
                'last_seen_at' => $now,
                'is_active' => true,
                'notes' => 'Nodo domótico conectado al entorno doméstico para lectura de sensores y automatización.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'node_name' => 'GATEWAY-BACNET',
                'type' => 'inmotica',
                'location_name' => 'casa',
                'source_system' => 'gateway',
                'protocol' => 'bacnet',
                'current_value' => 'ALERTA RECONEXION',
                'unit' => 'status',
                'ip_address' => '192.168.1.220',
                'status' => 'warning',
                'last_seen_at' => $now,
                'is_active' => true,
                'notes' => 'Pasarela de integración para pruebas entre sistemas de automatización técnica.',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'node_name' => 'SENSOR-TEMP-01',
                'type' => 'sensor',
                'location_name' => 'salon',
                'source_system' => 'home-assistant',
                'protocol' => 'zigbee',
                'current_value' => '23.8',
                'unit' => '°C',
                'ip_address' => null,
                'status' => 'ok',
                'last_seen_at' => $now,
                'is_active' => true,
                'notes' => 'Sensor de temperatura del entorno doméstico integrado en automatizaciones.',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'node_name' => 'ENERGY-METER-01',
                'type' => 'sensor',
                'location_name' => 'cuadro-electrico',
                'source_system' => 'home-assistant',
                'protocol' => 'mqtt',
                'current_value' => '482',
                'unit' => 'W',
                'ip_address' => null,
                'status' => 'ok',
                'last_seen_at' => $now,
                'is_active' => true,
                'notes' => 'Medidor energético para seguimiento de consumo y análisis del hogar.',
                'is_featured' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($nodes as $node) {
            $exists = DB::table('nodes')
                ->where('node_name', $node['node_name'])
                ->exists();

            DB::table('nodes')->updateOrInsert(
                ['node_name' => $node['node_name']],
                array_merge($node, [
                    'updated_at' => $now,
                    'created_at' => $exists ? DB::raw('created_at') : $now,
                ])
            );
        }
    }
}
