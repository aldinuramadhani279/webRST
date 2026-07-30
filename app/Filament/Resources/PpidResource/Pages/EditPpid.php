<?php

namespace App\Filament\Resources\PpidResource\Pages;

use App\Filament\Resources\PpidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPpid extends EditRecord
{
    protected static string $resource = PpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
