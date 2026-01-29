<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Layanan')
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

                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->label('Deskripsi'),
                    ]),

                Forms\Components\Section::make('Media Utama')
                    ->schema([
                        Forms\Components\Radio::make('upload_type')
                            ->label('Tipe Unggahan')
                            ->options([
                                'image' => 'Gambar',
                                'pdf' => 'PDF',
                            ])
                            ->default('image')
                            ->live()
                            ->required(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '16:9',
                                '1:1',
                                null,
                            ])
                            ->disk('public')
                            ->label('Gambar Thumbnail')
                            ->maxSize(2048)
                            ->directory('services')
                            ->visible(fn ($get) => $get('upload_type') === 'image'),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('Unggah PDF')
                            ->disk('public')
                            ->directory('service-files')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->visible(fn ($get) => $get('upload_type') === 'pdf')
                            ->required(fn ($get) => $get('upload_type') === 'pdf'),
                    ]),

                Forms\Components\Section::make('Galeri Gambar')
                    ->description('Upload gambar-gambar untuk slider di halaman detail layanan')
                    ->schema([
                        Forms\Components\FileUpload::make('gallery_images')
                            ->label('Gambar Galeri')
                            ->helperText('Pilih beberapa gambar sekaligus. Gambar akan otomatis di-compress.')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                                null, // Free crop
                            ])
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth(1200)
                            ->imageResizeTargetHeight(900)
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('service-galleries')
                            ->maxFiles(20)
                            ->maxSize(10240)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan Lainnya')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Layanan Utama')
                            ->helperText('Centang jika ini adalah layanan utama yang akan ditampilkan di halaman home')
                            ->default(false),

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
                            ->url()
                            ->helperText('Opsional: Tambahkan link kontak untuk layanan ini.'),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Layanan')
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label('Nama Layanan'),
                        Infolists\Components\TextEntry::make('category')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                $categories = [
                                    'rawat_jalan' => 'Rawat Jalan',
                                    'rawat_inap' => 'Rawat Inap',
                                    'penunjang' => 'Penunjang',
                                ];
                                return $categories[$state] ?? $state;
                            })
                            ->label('Kategori'),
                        Infolists\Components\IconEntry::make('is_featured')
                            ->label('Layanan Utama')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('content')
                            ->html()
                            ->columnSpanFull()
                            ->label('Deskripsi'),
                    ])->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Removed ImagesRelationManager to avoid modal bugs
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
