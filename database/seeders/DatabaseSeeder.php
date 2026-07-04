<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProjectSeeder::class,
            ContactMessageSeeder::class,
            ProfileExpertiseSeeder::class,
            ProfileHighlightSeeder::class,
            SkillSeeder::class,
            SocialLinkSeeder::class,
        ]);
    }
}
