<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Layanan'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->label('Slug')
                    ->helperText('Otomatis diisi berdasarkan nama layanan jika dikosongkan'),

                Forms\Components\Select::make('category')
                    ->options([
                        'rawat_jalan' => 'Rawat Jalan',
                        'rawat_inap' => 'Rawat Inap',
                        'penunjang' => 'Penunjang',
                    ])
                    ->required()
                    ->label('Kategori'),

                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->label('Deskripsi'),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->label('Gambar')
                    ->maxSize(2048) // Maksimal 2MB
                    ->directory('services'),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Layanan Utama')
                    ->helperText('Centang jika ini adalah layanan utama yang akan ditampilkan di halaman home')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Nama Layanan'),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $categories = [
                            'rawat_jalan' => 'Rawat Jalan',
                            'rawat_inap' => 'Rawat Inap',
                            'penunjang' => 'Penunjang',
                        ];
                        return $categories[$state] ?? $state;
                    })
                    ->color('primary')
                    ->label('Kategori'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Layanan Utama')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'rawat_jalan' => 'Rawat Jalan',
                        'rawat_inap' => 'Rawat Inap',
                        'penunjang' => 'Penunjang',
                    ])
                    ->label('Kategori'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}