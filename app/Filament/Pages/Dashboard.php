<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PopularPagesWidget;
use App\Filament\Widgets\VisitChartWidget;
use App\Filament\Widgets\VisitStatsWidget;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Artisan;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public function getWidgets(): array
    {
        return [
            VisitStatsWidget::class,
            VisitChartWidget::class,
            PopularPagesWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 4;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('clear-cache')
                ->label('Clear Cache')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action(function () {
                    try {
                        Artisan::call('config:clear');
                        Artisan::call('cache:clear');
                        Artisan::call('view:clear');

                        Notification::make()
                            ->title('Cache Berhasil Dibersihkan')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error Membersihkan Cache')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
