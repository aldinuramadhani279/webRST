<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class VisitChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Grafik Kunjungan 30 Hari Terakhir';

    protected static ?string $maxHeight = '250px';

    public ?string $filter = '30';

    protected function getFilters(): ?array
    {
        return [
            '7'  => '7 Hari',
            '14' => '14 Hari',
            '30' => '30 Hari',
            '90' => '3 Bulan',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? 30);

        // Generate semua tanggal dalam rentang
        $dates = collect();
        for ($i = $days - 1; $i >= 0; $i--) {
            $dates->put(today()->subDays($i)->format('Y-m-d'), 0);
        }

        // Ambil data kunjungan per hari
        $visits = PageVisit::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Merge data ke dalam rentang tanggal
        $merged = $dates->merge($visits);

        $labels = $merged->keys()->map(fn ($date) => Carbon::parse($date)->isoFormat('D MMM'))->toArray();
        $data   = $merged->values()->toArray();

        return [
            'datasets' => [
                [
                    'label'                => 'Kunjungan',
                    'data'                 => $data,
                    'borderColor'          => '#3b82f6',
                    'backgroundColor'      => 'rgba(59, 130, 246, 0.1)',
                    'fill'                 => true,
                    'tension'              => 0.4,
                    'pointBackgroundColor' => '#3b82f6',
                    'pointRadius'          => 3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
