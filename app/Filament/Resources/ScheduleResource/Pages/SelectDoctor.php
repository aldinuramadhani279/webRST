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
        return [];
    }
}
