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
        $settings = [
            ['key' => 'emergency_number', 'value' => '(0298) 324568', 'type' => 'string'],
            ['key' => 'hospital_name', 'value' => 'RST dr. Asmir Salatiga', 'type' => 'string'],
            ['key' => 'hospital_address', 'value' => 'Jl. Muwardi No.9, Salatiga, Jawa Tengah', 'type' => 'string'],
            ['key' => 'hospital_phone', 'value' => '(0298) 324568', 'type' => 'string'],
            ['key' => 'hospital_email', 'value' => 'info@rstdrasmirsalatiga.co.id', 'type' => 'string'],
            ['key' => 'banner_image', 'value' => '', 'type' => 'image'],
            ['key' => 'logo', 'value' => '', 'type' => 'image'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }
}
