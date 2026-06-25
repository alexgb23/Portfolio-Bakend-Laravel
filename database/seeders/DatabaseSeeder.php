<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ProfileSettingSeeder::class,
            SocialLinkSeeder::class,
            SkillSeeder::class,

            ProjectSeeder::class,
            NodeSeeder::class,
            ServerSeeder::class,
            MetricSeeder::class,

            ClusterSeeder::class,
            ClusterServerSeeder::class,

            HomeAssistantSeeder::class,
            HomeAssistantUseCaseSeeder::class,

            LocalAiSetupSeeder::class,
            AiStudyCaseSeeder::class,

            ResearchSourceSeeder::class,
            ResearchMetricSeeder::class,

            LabCapabilitySeeder::class,
            LaboratoryBlockSeeder::class,
            LaboratoryItemSeeder::class,

            ContactMessageSeeder::class,
        ]);
    }
}