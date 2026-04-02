<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class PopularPagesWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Halaman Paling Populer';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageVisit::query()
                    ->selectRaw('MAX(id) as id, page_name, url, COUNT(*) as visit_count, MAX(created_at) as last_visited')
                    ->groupBy('page_name', 'url')
                    ->orderByDesc('visit_count')
            )
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Nama Halaman')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL berhasil disalin!')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('visit_count')
                    ->label('Jumlah Kunjungan')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' kunjungan'),

                Tables\Columns\TextColumn::make('last_visited')
                    ->label('Terakhir Dikunjungi')
                    ->sortable()
                    ->dateTime('d M Y, H:i')
                    ->since()
                    ->color('gray'),
            ])
            ->defaultSort('visit_count', 'desc')
            ->paginated([10, 25, 50])
            ->poll('60s');
    }
}
