<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    // Store gallery images temporarily
    public array $galleryImagesData = [];

    // Remove gallery_images before saving to prevent SQL error
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store gallery images data
        $this->galleryImagesData = $data['gallery_images'] ?? [];
        
        // Remove from data to prevent SQL error
        unset($data['gallery_images']);
        
        return $data;
    }

    // Save gallery images after creating the main record
    protected function afterCreate(): void
    {
        $record = $this->getRecord();
        $galleryImages = $this->galleryImagesData;
        
        // Ensure it's an array
        if (!is_array($galleryImages)) {
            $galleryImages = [];
        }
        
        foreach ($galleryImages as $imagePath) {
            $record->images()->create([
                'image_path' => $imagePath,
            ]);
        }
    }
}
