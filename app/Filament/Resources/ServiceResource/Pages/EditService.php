<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    // Store gallery images temporarily
    public array $galleryImagesData = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Load existing gallery images into form
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();
        
        // Get existing gallery images
        $data['gallery_images'] = $record->images->pluck('image_path')->toArray();
        
        return $data;
    }

    // Remove gallery_images before saving to prevent SQL error
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Store gallery images data
        $this->galleryImagesData = $data['gallery_images'] ?? [];
        
        // Remove from data to prevent SQL error
        unset($data['gallery_images']);
        
        return $data;
    }

    // Save gallery images after saving the main record
    protected function afterSave(): void
    {
        $record = $this->getRecord();
        $galleryImages = $this->galleryImagesData;
        
        // Ensure it's an array
        if (!is_array($galleryImages)) {
            $galleryImages = [];
        }
        
        // Refresh record to get current images
        $record->refresh();
        
        // Get current image paths
        $currentPaths = $record->images->pluck('image_path')->toArray();
        
        // Delete removed images
        $toDelete = array_diff($currentPaths, $galleryImages);
        if (!empty($toDelete)) {
            $record->images()->whereIn('image_path', $toDelete)->delete();
        }
        
        // Add new images
        $toAdd = array_diff($galleryImages, $currentPaths);
        foreach ($toAdd as $imagePath) {
            $record->images()->create([
                'image_path' => $imagePath,
            ]);
        }
    }
}
