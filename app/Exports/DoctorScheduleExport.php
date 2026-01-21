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
                    'sip_number' => $doctor->sip_number,
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
        return [
            'No',
            'Nama Dokter',
            'Nomor SIP',
            'Spesialisasi',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 15,
            'D' => 20,
            'E' => 12,
            'F' => 12,
            'G' => 12,
        ];
    }
}
