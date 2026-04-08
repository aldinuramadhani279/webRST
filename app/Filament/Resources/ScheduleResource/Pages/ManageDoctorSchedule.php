<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Doctor;
use App\Models\Schedule;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class ManageDoctorSchedule extends Page
{
    protected static string $resource = ScheduleResource::class;
    protected static string $view = 'filament.resources.schedule-resource.pages.manage-doctor-schedule';
    protected static ?string $title = 'Kelola Jadwal Dokter';

    public ?Doctor $doctor = null;
    public int $doctorId;

    // Schedule state: ['Senin' => [['start' => '', 'end' => ''], ...], ...]
    public array $schedules = [];

    public static array $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    public function mount(int $doctorId): void
    {
        $this->doctorId = $doctorId;
        $this->doctor = Doctor::with('specialization')->findOrFail($doctorId);

        // Load existing schedules from DB
        $existing = Schedule::where('doctor_id', $doctorId)->get()->groupBy('day');

        foreach (self::$days as $day) {
            $sessions = $existing->get($day, collect());
            if ($sessions->isEmpty()) {
                // Default: one empty slot per day
                $this->schedules[$day] = [['start' => '', 'end' => '', 'id' => null]];
            } else {
                $this->schedules[$day] = $sessions->map(fn($s) => [
                    'start' => substr($s->start_time, 0, 5),
                    'end'   => substr($s->end_time, 0, 5),
                    'id'    => $s->id,
                ])->values()->toArray();
            }
        }
    }

    public function addSession(string $day): void
    {
        $this->schedules[$day][] = ['start' => '', 'end' => '', 'id' => null];
    }

    public function removeSession(string $day, int $index): void
    {
        $session = $this->schedules[$day][$index] ?? null;

        // Delete from DB if it has an id
        if ($session && $session['id']) {
            Schedule::destroy($session['id']);
        }

        array_splice($this->schedules[$day], $index, 1);

        // Keep at least one empty slot per day
        if (empty($this->schedules[$day])) {
            $this->schedules[$day] = [['start' => '', 'end' => '', 'id' => null]];
        }
    }

    public function save(): void
    {
        // Get all existing IDs for this doctor so we can delete removed ones
        $existingIds = Schedule::where('doctor_id', $this->doctorId)->pluck('id')->toArray();
        $keptIds = [];

        foreach (self::$days as $day) {
            $sessions = $this->schedules[$day] ?? [];
            foreach ($sessions as $session) {
                // Skip empty slots
                if (empty($session['start']) && empty($session['end'])) {
                    continue;
                }

                if (empty($session['start']) || empty($session['end'])) {
                    Notification::make()
                        ->warning()
                        ->title('Data tidak lengkap')
                        ->body("Hari {$day}: jam mulai dan jam selesai harus diisi keduanya.")
                        ->send();
                    return;
                }

                if ($session['id']) {
                    // Update existing
                    Schedule::where('id', $session['id'])->update([
                        'start_time' => $session['start'] . ':00',
                        'end_time'   => $session['end'] . ':00',
                    ]);
                    $keptIds[] = $session['id'];
                } else {
                    // Create new
                    $newSchedule = Schedule::create([
                        'doctor_id'  => $this->doctorId,
                        'day'        => $day,
                        'start_time' => $session['start'] . ':00',
                        'end_time'   => $session['end'] . ':00',
                    ]);
                    $keptIds[] = $newSchedule->id;
                }
            }
        }

        // Delete records that were removed in the UI
        $toDelete = array_diff($existingIds, $keptIds);
        if (!empty($toDelete)) {
            Schedule::destroy($toDelete);
        }

        // Reload schedules from DB to get fresh IDs
        $this->mount($this->doctorId);

        Notification::make()
            ->success()
            ->title('Jadwal berhasil disimpan!')
            ->body("Jadwal dr. {$this->doctor->name} telah diperbarui.")
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
