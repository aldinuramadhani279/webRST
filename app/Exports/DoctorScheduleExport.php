<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DoctorScheduleExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        $doctors = Doctor::with(['specialization', 'schedules'])->where('is_active', true)->get();

        $rows = collect();

        // Example row
        $rows->push([
            'no'           => '(Contoh)',
            'nama_dokter'  => 'Dr. Contoh',
            'nomor_sip'    => '1234567890',
            'spesialisasi' => 'Dokter Umum',
            'hari'         => 'Senin',
            'jam_mulai'    => '08:00',
            'jam_selesai'  => '12:00',
        ]);

        $no = 1;
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        foreach ($doctors as $doctor) {
            $existingSchedules = $doctor->schedules;

            // If doctor has no schedules, show empty rows for all days
            if ($existingSchedules->isEmpty()) {
                foreach ($days as $day) {
                    $rows->push([
                        'no'           => $no++,
                        'nama_dokter'  => $doctor->name,
                        'nomor_sip'    => $doctor->sip_number,
                        'spesialisasi' => $doctor->specialization->name ?? '-',
                        'hari'         => $day,
                        'jam_mulai'    => '',
                        'jam_selesai'  => '',
                    ]);
                }
            } else {
                // Each schedule record = one row (multiple sessions on same day = multiple rows)
                foreach ($existingSchedules->sortBy('day') as $schedule) {
                    $rows->push([
                        'no'           => $no++,
                        'nama_dokter'  => $doctor->name,
                        'nomor_sip'    => $doctor->sip_number,
                        'spesialisasi' => $doctor->specialization->name ?? '-',
                        'hari'         => $schedule->day,
                        'jam_mulai'    => substr($schedule->start_time, 0, 5),
                        'jam_selesai'  => substr($schedule->end_time, 0, 5),
                    ]);
                }
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['no', 'nama_dokter', 'nomor_sip', 'spesialisasi', 'hari', 'jam_mulai', 'jam_selesai'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['italic' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FFFFCC']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 10, 'B' => 25, 'C' => 18, 'D' => 20, 'E' => 12, 'F' => 12, 'G' => 12];
    }
}
