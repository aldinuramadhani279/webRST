<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorsData = [
            [
                'specialization_name' => 'Dokter Umum',
                'name' => 'dr. Budi Santoso',
                'sip_number' => 'SIP.449/001/DU/2023',
                'bio' => '<p>Dokter umum dengan pengalaman pelayanan kesehatan primer lebih dari 8 tahun.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Umum',
                'name' => 'dr. Siti Rahmawati',
                'sip_number' => 'SIP.449/002/DU/2023',
                'bio' => '<p>Dokter umum yang berfokus pada pencegahan penyakit dan kesehatan keluarga.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Gigi',
                'name' => 'drg. Maya Indah',
                'sip_number' => 'SIP.449/010/DG/2022',
                'bio' => '<p>Spesialis perawatan kesehatan gigi dan mulut untuk anak maupun dewasa.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Anak',
                'name' => 'dr. Hendra Wijaya, Sp.A',
                'sip_number' => 'SIP.449/015/SPA/2021',
                'bio' => '<p>Spesialis kesehatan anak dan tumbuh kembang balita.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Kulit',
                'name' => 'dr. Anita Setyowati, Sp.DV',
                'sip_number' => 'SIP.449/020/SPDV/2022',
                'bio' => '<p>Spesialis dermatologi dan estetika kulit.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Jantung',
                'name' => 'dr. Bambang Pratama, Sp.JP',
                'sip_number' => 'SIP.449/025/SPJP/2020',
                'bio' => '<p>Spesialis jantung dan pembuluh darah dengan kualifikasi kardiovaskular.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Mata',
                'name' => 'dr. Rina Kurnia, Sp.M',
                'sip_number' => 'SIP.449/030/SPM/2021',
                'bio' => '<p>Spesialis kesehatan mata dan operasi katarak.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter THT',
                'name' => 'dr. Ahmad Fauzi, Sp.THT-KL',
                'sip_number' => 'SIP.449/035/THT/2022',
                'bio' => '<p>Spesialis Telinga Hidung Tenggorokan dan Kepala Leher.</p>',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'specialization_name' => 'Dokter Kandungan',
                'name' => 'dr. Dewi Lestari, Sp.OG',
                'sip_number' => 'SIP.449/040/SPOG/2020',
                'bio' => '<p>Spesialis Kebidanan dan Kandungan untuk kehamilan dan kesehatan reproduksi wanita.</p>',
                'photo' => null,
                'is_active' => true,
            ],
        ];

        foreach ($doctorsData as $data) {
            $specialization = Specialization::where('name', $data['specialization_name'])->first();
            if ($specialization) {
                Doctor::firstOrCreate(
                    ['sip_number' => $data['sip_number']],
                    [
                        'specialization_id' => $specialization->id,
                        'name' => $data['name'],
                        'bio' => $data['bio'],
                        'photo' => $data['photo'],
                        'is_active' => $data['is_active'],
                    ]
                );
            }
        }
    }
}
