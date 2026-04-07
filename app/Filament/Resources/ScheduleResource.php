<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('doctor_id')
                    ->relationship(
                        name: 'doctor',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->where('is_active', true)->orderBy('name', 'asc')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                Select::make('day')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required()
                    ->columnSpanFull(),
                Section::make('Sesi 1')
                    ->description('Waktu praktik sesi pertama')
                    ->schema([
                        TimePicker::make('start_time')
                            ->label('Jam Mulai')
                            ->required(),
                        TimePicker::make('end_time')
                            ->label('Jam Selesai')
                            ->required(),
                    ])
                    ->columns(2),
                Section::make('Sesi 2 (Opsional)')
                    ->description('Isi jika dokter memiliki jadwal kedua di hari yang sama')
                    ->schema([
                        TimePicker::make('start_time_2')
                            ->label('Jam Mulai'),
                        TimePicker::make('end_time_2')
                            ->label('Jam Selesai'),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name')
                    ->label('Dokter')
                    ->searchable(),
                TextColumn::make('day')
                    ->label('Hari'),
                TextColumn::make('session_1')
                    ->label('Sesi 1')
                    ->getStateUsing(fn ($record) => substr($record->start_time, 0, 5) . ' - ' . substr($record->end_time, 0, 5)),
                TextColumn::make('session_2')
                    ->label('Sesi 2')
                    ->getStateUsing(fn ($record) => $record->start_time_2 
                        ? substr($record->start_time_2, 0, 5) . ' - ' . substr($record->end_time_2, 0, 5)
                        : '-'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
            'import' => Pages\ImportSchedule::route('/import'),
        ];
    }
}
