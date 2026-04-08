<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Doctor;
use Filament\Resources\Pages\Page;
use Livewire\Attributes\Url;

class SelectDoctor extends Page
{
    protected static string $resource = ScheduleResource::class;
    protected static string $view = 'filament.resources.schedule-resource.pages.select-doctor';
    protected static ?string $title = 'Pilih Dokter — Kelola Jadwal';

    #[Url]
    public string $search = '';

    public function getDoctors()
    {
        return Doctor::with('specialization')
            ->where('is_active', true)
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name', 'asc')
            ->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\DoctorScheduleExport, 'template_jadwal_dokter.xlsx');
                }),

            \Filament\Actions\Action::make('importSchedule')
                ->label('Import Jadwal')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->url(fn() => ScheduleResource::getUrl('import')),
        ];
    }
}
