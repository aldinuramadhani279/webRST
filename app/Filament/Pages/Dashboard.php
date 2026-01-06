<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Artisan;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('clear-cache')
                ->label('Clear Cache')
                ->icon('heroicon-o-arrow-path')
                ->action(function () {
                    try {
                        Artisan::call('config:clear');
                        Artisan::call('cache:clear');
                        Artisan::call('view:clear');

                        Notification::make()
                            ->title('Cache Cleared Successfully')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error Clearing Cache')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
