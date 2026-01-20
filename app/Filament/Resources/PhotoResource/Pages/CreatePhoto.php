<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use App\Models\Photo;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePhoto extends CreateRecord
{
    protected static string $resource = PhotoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // This method is called before creating the record
        // We'll handle multiple photos in handleRecordCreation instead
        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $albumId = $data['album_id'];
        $title = $data['title'] ?? null;
        $paths = $data['path'];

        // If paths is not an array (single upload), convert to array
        if (!is_array($paths)) {
            $paths = [$paths];
        }

        $createdPhotos = [];
        
        foreach ($paths as $index => $path) {
            $photoTitle = $title;
            
            // If no title provided, use filename without extension
            if (empty($photoTitle)) {
                $photoTitle = pathinfo($path, PATHINFO_FILENAME);
            } elseif (count($paths) > 1) {
                // If multiple photos and title provided, append number
                $photoTitle = $title . ' (' . ($index + 1) . ')';
            }

            $photo = Photo::create([
                'album_id' => $albumId,
                'title' => $photoTitle,
                'path' => $path,
            ]);

            $createdPhotos[] = $photo;
        }

        // Show success notification with count
        $count = count($createdPhotos);
        Notification::make()
            ->title($count > 1 ? "{$count} foto berhasil diunggah!" : 'Foto berhasil diunggah!')
            ->success()
            ->send();

        // Return the first photo (Filament expects a single model)
        return $createdPhotos[0];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        // We handle notification in handleRecordCreation, so return null here
        return null;
    }
}
