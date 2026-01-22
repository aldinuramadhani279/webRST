<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('specialization_id')
                    ->relationship('specialization', 'name')
                    ->required()
                    ->label('Spesialisasi'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Dokter'),

                Forms\Components\TextInput::make('sip_number')
                    ->required()
                    ->maxLength(255)
                    ->label('Nomor SIP'),

                Forms\Components\Textarea::make('bio')
                    ->required()
                    ->columnSpanFull()
                    ->label('Biografi'),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->label('Foto')
                    ->maxSize(2048)
                    ->directory('doctors'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Dokter'),

                Tables\Columns\TextColumn::make('sip_number')
                    ->searchable()
                    ->label('Nomor SIP'),

                Tables\Columns\TextColumn::make('specialization.name')
                    ->sortable()
                    ->label('Spesialisasi'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->sortable()
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('specialization')
                    ->relationship('specialization', 'name')
                    ->label('Spesialisasi'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
