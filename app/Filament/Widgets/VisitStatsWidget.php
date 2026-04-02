<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayCount    = PageVisit::today();
        $weekCount     = PageVisit::thisWeek();
        $monthCount    = PageVisit::thisMonth();
        $totalCount    = PageVisit::count();

        // Trend hari ini vs kemarin
        $yesterdayCount = PageVisit::whereDate('created_at', today()->subDay())->count();
        $todayTrend     = $yesterdayCount > 0
            ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 1)
            : ($todayCount > 0 ? 100 : 0);

        // Chart data 7 hari terakhir
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $last7Days->push(
                PageVisit::whereDate('created_at', today()->subDays($i))->count()
            );
        }

        return [
            Stat::make('Kunjungan Hari Ini', number_format($todayCount))
                ->description($todayTrend >= 0
                    ? "{$todayTrend}% lebih banyak dari kemarin"
                    : abs($todayTrend) . "% lebih sedikit dari kemarin")
                ->descriptionIcon($todayTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($todayTrend >= 0 ? 'success' : 'danger')
                ->chart($last7Days->toArray()),

            Stat::make('Kunjungan Minggu Ini', number_format($weekCount))
                ->description('Senin s/d Minggu')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Kunjungan Bulan Ini', number_format($monthCount))
                ->description(now()->isoFormat('MMMM YYYY'))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),

            Stat::make('Total Semua Kunjungan', number_format($totalCount))
                ->description('Sejak tracking aktif')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'),
        ];
    }
}
