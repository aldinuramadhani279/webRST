<?php

namespace App\Imports;

use App\Models\Doctor;
use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
                // To avoid too many errors, only log if it's not the example row
                if ($row['no'] !== '(Contoh)') {
                    $this->errors[] = "Baris {$rowNumber}: Dokter dengan SIP '{$sipNumber}' tidak ditemukan";
                }
                continue;
            }

            // Validate day
            $validDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            if (!in_array($hari, $validDays)) {
                $this->errors[] = "Baris {$rowNumber}: Hari '{$hari}' tidak valid";
                continue;
            }

            // Format time
            $startTime = $this->formatTime($jamMulai);
            $endTime = $this->formatTime($jamSelesai);

            if (!$startTime || !$endTime) {
                $this->errors[] = "Baris {$rowNumber}: Format waktu tidak valid";
                continue;
            }

            // Check if this exact schedule already exists to avoid duplicates
            $exists = Schedule::where('doctor_id', $doctor->id)
                ->where('day', $hari)
                ->where('start_time', $startTime)
                ->where('end_time', $endTime)
                ->exists();

            if (!$exists) {
                Schedule::create([
                    'doctor_id'  => $doctor->id,
                    'day'        => $hari,
                    'start_time' => $startTime,
                    'end_time'   => $endTime,
                ]);
                $this->successCount++;
            } else {
                $this->skipCount++; // Skip exact duplicates
            }
        }
    }

    private function formatTime($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value) && $value > 0 && $value < 1) {
            try {
                $dateTime = Date::excelToDateTimeObject($value);
                return $dateTime->format('H:i:00');
            } catch (\Exception $e) {
                $totalMinutes = round($value * 24 * 60);
                $hours = floor($totalMinutes / 60) % 24;
                $minutes = $totalMinutes % 60;
                return sprintf('%02d:%02d:00', $hours, $minutes);
            }
        }

        if (is_numeric($value) && $value >= 1) {
            try {
                $dateTime = Date::excelToDateTimeObject($value);
                return $dateTime->format('H:i:00');
            } catch (\Exception $e) {
                return null;
            }
        }

        if (is_string($value)) {
            if (preg_match('/^(\d{1,2}):(\d{2})(?::\d{2})?$/', trim($value), $matches)) {
                $hours = intval($matches[1]) % 24;
                $minutes = intval($matches[2]) % 60;
                return sprintf('%02d:%02d:00', $hours, $minutes);
            }
        }

        return null;
    }
}
