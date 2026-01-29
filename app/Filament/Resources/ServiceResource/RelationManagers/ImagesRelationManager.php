<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Galeri Gambar';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('service-galleries')
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(20)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image_path')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(100),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Gambar')
                    ->using(function (array $data, string $model): \Illuminate\Database\Eloquent\Model {
                        $ownerRecord = $this->getOwnerRecord();
                        $createdRecords = [];
                        
                        // Handle multiple images
                        $images = $data['image_path'];
                        if (is_array($images)) {
                            foreach ($images as $imagePath) {
                                $createdRecords[] = $ownerRecord->images()->create([
                                    'image_path' => $imagePath,
                                ]);
                            }
                            // Return the first one for Filament
                            return $createdRecords[0] ?? $ownerRecord->images()->create(['image_path' => '']);
                        }
                        
                        // Single image fallback
                        return $ownerRecord->images()->create([
                            'image_path' => $images,
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
