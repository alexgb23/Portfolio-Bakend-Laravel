<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('clusters')->updateOrInsert(
            ['name' => 'Proxmox Cluster Principal'],
            [
                'slug' => 'proxmox-cluster-principal',
                'type' => 'proxmox',
                'description' => 'Clúster principal de virtualización del homelab para servicios, automatización e infraestructura.',
                'status' => 'online',
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}
