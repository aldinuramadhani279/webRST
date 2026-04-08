<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Exports\DoctorScheduleExport;
use Filament\Actions;
use Filament\Actions\Action;
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
                ->url(fn() => ScheduleResource::getUrl('import')),

            Action::make('kelolaJadwal')
                ->label('Kelola Jadwal')
                ->icon('heroicon-o-pencil-square')
                ->color('primary')
                ->url(fn() => ScheduleResource::getUrl('select')),
        ];
    }
}
