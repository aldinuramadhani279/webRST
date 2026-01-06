<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateValidPlaceholders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-valid-placeholders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create valid SVG placeholder images in storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create valid SVG content with proper XML declaration
        $frontPhoto = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="400" viewBox="0 0 1200 400">
  <rect width="1200" height="400" fill="#3b82f6"/>
  <text x="600" y="200" font-family="Arial, sans-serif" font-size="24" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">
    Foto Nampak Depan RST dr Asmir Salatiga
  </text>
</svg>';

        $logoDiponegoro = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
  <rect width="200" height="200" fill="#3b82f6"/>
  <text x="100" y="100" font-family="Arial, sans-serif" font-size="16" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">
    LOGO DIPONEGORO
  </text>
</svg>';

        $logoRST = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
  <rect width="200" height="200" fill="#3b82f6"/>
  <text x="100" y="100" font-family="Arial, sans-serif" font-size="16" fill="#ffffff" text-anchor="middle" dominant-baseline="middle">
    LOGO RST
  </text>
</svg>';

        // Store the valid SVG placeholder images
        Storage::disk('public')->put('placeholders/fotonampakdepan.svg', $frontPhoto);
        Storage::disk('public')->put('placeholders/logodiponegoro.svg', $logoDiponegoro);
        Storage::disk('public')->put('placeholders/logorst.svg', $logoRST);

        $this->info('Valid SVG placeholder images created successfully in storage/app/public/placeholders/');

        // Also create JPG versions that redirect to SVG or use a different approach
        $jpgPlaceholder = imagecreate(1200, 400);
        $bgColor = imagecolorallocate($jpgPlaceholder, 59, 130, 246); // #3b82f6
        $textColor = imagecolorallocate($jpgPlaceholder, 255, 255, 255);

        // Add text
        $text = 'Foto Nampak Depan RST dr Asmir Salatiga';
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $x = (1200 - $textWidth) / 2;
        $y = 400 / 2;

        imagestring($jpgPlaceholder, $fontSize, $x, $y, $text, $textColor);

        // Save as temporary file and move to storage
        $tempFile = tempnam(sys_get_temp_dir(), 'placeholder_');
        imagejpeg($jpgPlaceholder, $tempFile);

        // Copy to storage
        $content = file_get_contents($tempFile);
        Storage::disk('public')->put('placeholders/fotonampakdepan.jpg', $content);

        // Clean up
        imagedestroy($jpgPlaceholder);
        unlink($tempFile);

        $this->info('JPG placeholder also created for compatibility.');
    }
}
