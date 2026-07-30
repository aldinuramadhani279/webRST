<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();

        if ($doctors->isEmpty()) {
            return;
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        foreach ($doctors as $index => $doctor) {
            // Memberikan jadwal 2-3 hari per dokter
            $assignedDays = array_slice($days, ($index * 2) % count($days), 3);

            foreach ($assignedDays as $day) {
                // Jam praktek Pagi
                Schedule::firstOrCreate([
                    'doctor_id' => $doctor->id,
                    'day' => $day,
                    'start_time' => '08:00:00',
                    'end_time' => '12:00:00',
                ]);

                // Beberapa dokter punya jadwal Sore
                if ($index % 2 == 0) {
                    Schedule::firstOrCreate([
                        'doctor_id' => $doctor->id,
                        'day' => $day,
                        'start_time' => '15:00:00',
                        'end_time' => '18:00:00',
                    ]);
                }
            }
        }
    }
}
