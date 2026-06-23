<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $servers = [
            [
                'hostname' => 'vps-render-backend',
                'display_name' => 'VPS Render Backend',
                'os' => 'Linux Ubuntu 22.04 LTS',
                'public_ip' => '142.250.200.46',
                'cpu_usage' => '8%',
                'ram_usage' => '512MB / 1GB',
                'uptime' => '99.95%',
                'role' => 'backend',
                'provider' => 'render',
                'environment' => 'production',
                'location_name' => 'cloud',
                'virtualization_type' => 'vps',
                'status' => 'online',
                'notes' => 'Servidor principal del backend desplegado en Render.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'hostname' => 'home-lab-raspberry',
                'display_name' => 'Home Lab Raspberry',
                'os' => 'Raspbian OS (Debian)',
                'public_ip' => '192.168.1.150 (LAN)',
                'cpu_usage' => '24%',
                'ram_usage' => '1.8GB / 4GB',
                'uptime' => '100%',
                'role' => 'lab',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'bare-metal',
                'status' => 'online',
                'notes' => 'Nodo local del laboratorio para servicios e integración.',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'hostname' => 'pfsense-01',
                'display_name' => 'pfSense Firewall',
                'os' => 'pfSense',
                'public_ip' => '192.168.1.1 (LAN)',
                'cpu_usage' => 'N/A',
                'ram_usage' => 'N/A',
                'uptime' => 'N/A',
                'role' => 'firewall',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'appliance',
                'status' => 'online',
                'notes' => 'Firewall y router principal del laboratorio y la red segmentada.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'hostname' => 'proxmox-node-01',
                'display_name' => 'Proxmox Node 01',
                'os' => 'Proxmox VE',
                'public_ip' => '192.168.1.101 (LAN)',
                'cpu_usage' => 'N/A',
                'ram_usage' => 'N/A',
                'uptime' => 'N/A',
                'role' => 'hypervisor',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'bare-metal',
                'status' => 'online',
                'notes' => 'Nodo 1 del clúster Proxmox.',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'hostname' => 'proxmox-node-02',
                'display_name' => 'Proxmox Node 02',
                'os' => 'Proxmox VE',
                'public_ip' => '192.168.1.102 (LAN)',
                'cpu_usage' => 'N/A',
                'ram_usage' => 'N/A',
                'uptime' => 'N/A',
                'role' => 'hypervisor',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'bare-metal',
                'status' => 'online',
                'notes' => 'Nodo 2 del clúster Proxmox.',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'hostname' => 'proxmox-node-03',
                'display_name' => 'Proxmox Node 03',
                'os' => 'Proxmox VE',
                'public_ip' => '192.168.1.103 (LAN)',
                'cpu_usage' => 'N/A',
                'ram_usage' => 'N/A',
                'uptime' => 'N/A',
                'role' => 'hypervisor',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'bare-metal',
                'status' => 'online',
                'notes' => 'Nodo 3 del clúster Proxmox.',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'hostname' => 'proxmox-backup-01',
                'display_name' => 'Proxmox Backup Server',
                'os' => 'Proxmox Backup Server',
                'public_ip' => '192.168.1.110 (LAN)',
                'cpu_usage' => 'N/A',
                'ram_usage' => 'N/A',
                'uptime' => 'N/A',
                'role' => 'backup',
                'provider' => 'homelab',
                'environment' => 'lab',
                'location_name' => 'casa',
                'virtualization_type' => 'bare-metal',
                'status' => 'online',
                'notes' => 'Servidor dedicado a copias de seguridad del laboratorio.',
                'is_featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($servers as $server) {
            $existing = DB::table('servers')
                ->where('hostname', $server['hostname'])
                ->first();

            if ($existing) {
                DB::table('servers')
                    ->where('id', $existing->id)
                    ->update(array_merge($server, [
                        'updated_at' => $now,
                    ]));
            } else {
                DB::table('servers')->insert(array_merge($server, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }
    }
}
