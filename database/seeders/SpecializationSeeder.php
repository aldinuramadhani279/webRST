<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            ['name' => 'Dokter Umum', 'icon' => 'fa-user-md'],
            ['name' => 'Dokter Gigi', 'icon' => 'fa-tooth'],
            ['name' => 'Dokter Anak', 'icon' => 'fa-baby'],
            ['name' => 'Dokter Kulit', 'icon' => 'fa-allergies'],
            ['name' => 'Dokter Jantung', 'icon' => 'fa-heart'],
            ['name' => 'Dokter Mata', 'icon' => 'fa-eye'],
            ['name' => 'Dokter THT', 'icon' => 'fa-head-side-cough'],
            ['name' => 'Dokter Kandungan', 'icon' => 'fa-baby-carriage'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::firstOrCreate(
                ['name' => $specialization['name']], 
                $specialization
            );
        }
    }
}