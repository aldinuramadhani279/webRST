<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidResource\Pages;
use App\Filament\Resources\PpidResource\RelationManagers;
use App\Models\Ppid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PpidResource extends Resource
{
    protected static ?string $model = Ppid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'PPID';
    protected static ?string $modelLabel = 'PPID';
    protected static ?string $pluralModelLabel = 'PPID';

    public static function form(Form $form): Form
    {
    return $form->schema([
        Forms\Components\TextInput::make('title')->required(),
        Forms\Components\Select::make('category')->options([
            'sk' => 'SK PPID',
            'struktur' => 'Struktur PPID',
            'permintaan' => 'Permintaan Informasi',
            'informasi_publik' => 'Informasi Publik',
            'pengaduan' => 'Pengaduan Layanan',
            'survey' => 'Hasil Survey',
            'tanya_jawab' => 'Tanya Jawab',
            'informasi_umum' => 'Informasi Umum Layanan',
            'maklumat' => 'Maklumat',
        ])->required(),
        Forms\Components\Textarea::make('description'),
        Forms\Components\FileUpload::make('file')->directory('ppid'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'sk' => 'SK PPID',
                        'struktur' => 'Struktur PPID',
                        'permintaan' => 'Permintaan Informasi',
                        'informasi_publik' => 'Informasi Publik',
                        'pengaduan' => 'Pengaduan Layanan',
                        'survey' => 'Hasil Survey',
                        'tanya_jawab' => 'Tanya Jawab',
                        'informasi_umum' => 'Informasi Umum Layanan',
                        'maklumat' => 'Maklumat',
                        default => $state,
                        }),
                Tables\Columns\TextColumn::make('file')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : '-')
                    ->url(fn ($record) => $record->file ? asset('storage/' . $record->file) : null)
                    ->openUrlInNewTab()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPpids::route('/'),
            'create' => Pages\CreatePpid::route('/create'),
            'edit' => Pages\EditPpid::route('/{record}/edit'),
        ];
    }
}
