<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SpecializationSeeder::class,
            DoctorSeeder::class,
            ScheduleSeeder::class,
            ServiceSeeder::class,
            ArticleSeeder::class,
            GallerySeeder::class,
            SettingSeeder::class,
        ]);
    }
}
