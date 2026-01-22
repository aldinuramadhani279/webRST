<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Imports\DoctorScheduleImport;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportSchedule extends Page
{
    use WithFileUploads;

    protected static string $resource = ScheduleResource::class;

    protected static string $view = 'filament.resources.schedule-resource.pages.import-schedule';

    protected static ?string $title = 'Import Jadwal Dokter';

    // Direct file property for Livewire upload
    public $excelFile;

    public function import(): void
    {
        // Validate file
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls|max:10240',
        ], [
            'excelFile.required' => 'Pilih file Excel terlebih dahulu.',
            'excelFile.file' => 'File tidak valid.',
            'excelFile.mimes' => 'File harus berformat .xlsx atau .xls',
            'excelFile.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $import = new DoctorScheduleImport;
            Excel::import($import, $this->excelFile->getRealPath());

            // Show notification with results
            $message = "Berhasil import {$import->successCount} jadwal.";
            if ($import->skipCount > 0) {
                $message .= " ({$import->skipCount} baris dilewati)";
            }

            if (!empty($import->errors)) {
                Notification::make()
                    ->warning()
                    ->title('Import selesai dengan error')
                    ->body($message . "\n\n" . implode("\n", array_slice($import->errors, 0, 5)))
                    ->persistent()
                    ->send();
            } else {
                Notification::make()
                    ->success()
                    ->title('Import berhasil!')
                    ->body($message)
                    ->send();
            }

            // Reset
            $this->excelFile = null;

        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Import gagal')
                ->body($e->getMessage())
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
