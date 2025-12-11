<?php

namespace App\Filament\Resources\SpecializationResource\RelationManagers;

use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DoctorsRelationManager extends RelationManager
{
    protected static string $relationship = 'doctors';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('specialization_id')
                    ->relationship('specialization', 'name')
                    ->required(),
                    
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
                    ->maxSize(2048) // Maksimal 2MB
                    ->directory('doctors'),
                    
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Dokter'),
                    
                Tables\Columns\TextColumn::make('sip_number')
                    ->searchable()
                    ->label('Nomor SIP'),
                    
                Tables\Columns\TextColumn::make('is_active')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Aktif' : 'Tidak Aktif';
                    })
                    ->color(function ($state) {
                        return $state ? 'success' : 'danger';
                    })
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}