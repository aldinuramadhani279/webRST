<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Exports\DoctorScheduleExport;
use App\Imports\DoctorScheduleImport;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return Excel::download(new DoctorScheduleExport, 'template_jadwal_dokter.xlsx');
                }),
            
            Action::make('importSchedule')
                ->label('Import Jadwal')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->required()
                        ->disk('local')
                        ->directory('temp-imports')
                        ->visibility('private'),
                ])
                ->action(function (array $data) {
                    $filePath = storage_path('app/' . $data['file']);
                    
                    $import = new DoctorScheduleImport;
                    Excel::import($import, $filePath);
                    
                    // Delete temp file
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    
                    // Show notification with results
                    $message = "Berhasil import {$import->successCount} jadwal.";
                    if ($import->skipCount > 0) {
                        $message .= " ({$import->skipCount} baris dilewati karena jadwal kosong)";
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
                }),
            
            Actions\CreateAction::make(),
        ];
    }
}
