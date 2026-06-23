<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $clusterId = DB::table('clusters')
            ->where('slug', 'proxmox-cluster-principal')
            ->value('id');

        if (! $clusterId) {
            return;
        }

        $servers = [
            'proxmox-node-01' => 'hypervisor',
            'proxmox-node-02' => 'hypervisor',
            'proxmox-node-03' => 'hypervisor',
        ];

        $sortOrder = 1;

        foreach ($servers as $hostname => $nodeRole) {
            $serverId = DB::table('servers')
                ->where('hostname', $hostname)
                ->value('id');

            if (! $serverId) {
                continue;
            }

            DB::table('cluster_server')->updateOrInsert(
                [
                    'cluster_id' => $clusterId,
                    'server_id' => $serverId,
                ],
                [
                    'node_role' => $nodeRole,
                    'sort_order' => $sortOrder++,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
