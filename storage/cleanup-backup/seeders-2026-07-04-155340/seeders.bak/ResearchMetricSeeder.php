<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homeAssistantId = DB::table('research_sources')
            ->where('slug', 'documentacion-oficial-home-assistant')
            ->value('id');

        $proxmoxId = DB::table('research_sources')
            ->where('slug', 'documentacion-oficial-proxmox-ve')
            ->value('id');

        $pfsenseId = DB::table('research_sources')
            ->where('slug', 'documentacion-oficial-pfsense')
            ->value('id');

        DB::table('research_metrics')->insert([
            [
                'research_source_id' => $homeAssistantId,
                'metric_name' => 'relevance_score',
                'metric_value' => '95',
                'metric_unit' => 'score',
                'measured_on' => now()->toDateString(),
                'notes' => 'Fuente muy relevante para automatización e integración domótica.',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'research_source_id' => $proxmoxId,
                'metric_name' => 'credibility_score',
                'metric_value' => '98',
                'metric_unit' => 'score',
                'measured_on' => now()->toDateString(),
                'notes' => 'Documentación oficial altamente fiable para virtualización y clúster.',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'research_source_id' => $pfsenseId,
                'metric_name' => 'priority_level',
                'metric_value' => 'high',
                'metric_unit' => 'level',
                'measured_on' => now()->toDateString(),
                'notes' => 'Fuente prioritaria para diseño de red y seguridad del laboratorio.',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
