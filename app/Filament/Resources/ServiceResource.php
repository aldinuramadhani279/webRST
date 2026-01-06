<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers\ImagesRelationManager;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->imageCropAspectRatio('4:3')
                    ->disk('public')
                    ->label('Gambar')
                    ->maxSize(2048) // Maksimal 2MB
                    ->directory('services'),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Layanan Utama')
                    ->helperText('Centang jika ini adalah layanan utama yang akan ditampilkan di halaman home')
                    ->default(false),

                Forms\Components\Section::make('Kontak Tambahan')
                    ->description('Opsional: Tambahkan link kontak untuk layanan ini.')
                    ->schema([
                        Forms\Components\Select::make('contact_icon')
                            ->options([
                                'whatsapp' => 'WhatsApp',
                                'instagram' => 'Instagram',
                                'facebook' => 'Facebook',
                                'globe' => 'Website',
                            ])
                            ->label('Ikon Kontak'),
                        Forms\Components\TextInput::make('contact_link')
                            ->label('Link Kontak (URL)')
                            ->placeholder('Contoh: https://wa.me/62... atau https://www.instagram.com/...')
                            ->url(),
                    ]),
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
            ImagesRelationManager::class,
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
