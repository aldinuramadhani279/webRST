<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Jadwal Dokter';
    protected static ?string $pluralModelLabel = 'Jadwal Dokter';
    protected static ?string $modelLabel = 'Jadwal';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('day')
                    ->label('Hari')
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label('Jam Mulai')
                    ->getStateUsing(fn($record) => substr($record->start_time, 0, 5)),
                TextColumn::make('end_time')
                    ->label('Jam Selesai')
                    ->getStateUsing(fn($record) => substr($record->end_time, 0, 5)),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('manage')
                    ->label('Kelola')
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn($record) => static::getUrl('manage', ['doctorId' => $record->doctor_id])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListSchedules::route('/'),
            'select'  => Pages\SelectDoctor::route('/select-doctor'),
            'manage'  => Pages\ManageDoctorSchedule::route('/manage/{doctorId}'),
            'import'  => Pages\ImportSchedule::route('/import'),
        ];
    }
}
