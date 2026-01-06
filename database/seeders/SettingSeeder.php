<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        Setting::updateOrCreate(
            ['key' => 'emergency_number'],
            ['value' => '(0298) 324568', 'type' => 'string']
        );

        // Homepage Banner
        Setting::updateOrCreate(
            ['key' => 'banner_image'],
            ['value' => '', 'type' => 'image']
        );

        // Site Logo
        Setting::updateOrCreate(
            ['key' => 'logo'],
            ['value' => '', 'type' => 'image']
        );
    }
}
