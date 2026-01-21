<?php

namespace App\Imports;

use App\Models\Doctor;
use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DoctorScheduleImport implements ToCollection, WithHeadingRow
{
    public $successCount = 0;
    public $skipCount = 0;
    public $errors = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2; // +2 because index is 0-based and header is row 1
            
            // Skip if required fields are empty
            $jamMulai = $row['jam_mulai'] ?? null;
            $jamSelesai = $row['jam_selesai'] ?? null;
            $hari = $row['hari'] ?? null;
            $sipNumber = $row['nomor_sip'] ?? null;
            
            // If schedule time is not filled, skip this row
            if (empty($jamMulai) || empty($jamSelesai)) {
                $this->skipCount++;
                continue;
            }

            // Find doctor by SIP number
            $doctor = Doctor::where('sip_number', $sipNumber)->first();
            
            if (!$doctor) {
                $this->errors[] = "Baris {$rowNumber}: Dokter dengan SIP '{$sipNumber}' tidak ditemukan";
                continue;
            }

            // Validate day
            $validDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            if (!in_array($hari, $validDays)) {
                $this->errors[] = "Baris {$rowNumber}: Hari '{$hari}' tidak valid";
                continue;
            }

            // Format time (handle Excel time format)
            $startTime = $this->formatTime($jamMulai);
            $endTime = $this->formatTime($jamSelesai);

            if (!$startTime || !$endTime) {
                $this->errors[] = "Baris {$rowNumber}: Format waktu tidak valid";
                continue;
            }

            // Update or create schedule
            Schedule::updateOrCreate(
                [
                    'doctor_id' => $doctor->id,
                    'day' => $hari,
                ],
                [
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]
            );

            $this->successCount++;
        }
    }

    private function formatTime($value)
    {
        if (empty($value)) {
            return null;
        }

        // If it's a decimal (Excel time format), convert it
        if (is_numeric($value)) {
            $hours = floor($value * 24);
            $minutes = round(($value * 24 - $hours) * 60);
            return sprintf('%02d:%02d:00', $hours, $minutes);
        }

        // If it's already in HH:MM or HH:MM:SS format
        if (preg_match('/^(\d{1,2}):(\d{2})(?::\d{2})?$/', $value, $matches)) {
            return sprintf('%02d:%02d:00', $matches[1], $matches[2]);
        }

        return null;
    }
}
