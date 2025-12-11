<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateImagePlaceholders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-image-placeholders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create placeholder images in storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create placeholder SVG content
        $frontPhoto = '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="400" viewBox="0 0 1200 400"><rect width="1200" height="400" fill="#3b82f6"/><text x="600" y="200" font-family="Arial" font-size="24" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">Foto Nampak Depan RST dr Asmir Salatiga</text></svg>';

        $logoDiponegoro = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"><rect width="200" height="200" fill="#3b82f6"/><text x="100" y="100" font-family="Arial" font-size="16" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">LOGO DIPONEGORO</text></svg>';

        $logoRST = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"><rect width="200" height="200" fill="#3b82f6"/><text x="100" y="100" font-family="Arial" font-size="16" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">LOGO RST</text></svg>';

        // Store the placeholder images
        Storage::disk('public')->put('placeholders/fotonampakdepan.jpg', $frontPhoto);
        Storage::disk('public')->put('placeholders/logodiponegoro.png', $logoDiponegoro);
        Storage::disk('public')->put('placeholders/logorst.png', $logoRST);

        $this->info('Placeholder images created successfully in storage/app/public/placeholders/');
    }
}
