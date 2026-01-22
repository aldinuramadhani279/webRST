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
        $doctors = Doctor::with('specialization')->where('is_active', true)->get();
        
        $rows = collect();
        $no = 1;
        
        // Add example row first (will be row 2 after header)
        $rows->push([
            'no' => '(Contoh)',
            'nama_dokter' => 'Dr. Contoh',
            'nomor_sip' => '1234567890',
            'spesialisasi' => 'Dokter Umum',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '16:00',
        ]);
        
        foreach ($doctors as $doctor) {
            // Add 7 rows per doctor (one for each day of the week)
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            
            // Get existing schedules for this doctor
            $existingSchedules = $doctor->schedules->keyBy('day');
            
            foreach ($days as $day) {
                $schedule = $existingSchedules->get($day);
                
                $rows->push([
                    'no' => $no,
                    'nama_dokter' => $doctor->name,
                    'nomor_sip' => $doctor->sip_number,
                    'spesialisasi' => $doctor->specialization->name ?? '-',
                    'hari' => $day,
                    'jam_mulai' => $schedule ? substr($schedule->start_time, 0, 5) : '',
                    'jam_selesai' => $schedule ? substr($schedule->end_time, 0, 5) : '',
                ]);
                $no++;
            }
        }
        
        return $rows;
    }

    public function headings(): array
    {
        // Use lowercase with underscore to match import expectations
        return [
            'no',
            'nama_dokter',
            'nomor_sip',
            'spesialisasi',
            'hari',
            'jam_mulai',
            'jam_selesai',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Header row
            2 => ['font' => ['italic' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FFFFCC']]], // Example row (yellow bg)
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 18,
            'D' => 20,
            'E' => 12,
            'F' => 12,
            'G' => 12,
        ];
    }
}
