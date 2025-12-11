<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getImagePath($imageName, $defaultPath = null)
    {
        $path = public_path('assets/images/' . $imageName);
        
        if (file_exists($path)) {
            return asset('assets/images/' . $imageName);
        }
        
        if ($defaultPath) {
            return asset($defaultPath);
        }
        
        // Jika tidak ada gambar default, kembalikan placeholder SVG
        return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23e2e8f0'/%3E%3Ctext x='200' y='150' font-family='Arial' font-size='16' fill='%2394a3b8' text-anchor='middle'%3E{$imageName}%3C/text%3E%3C/svg%3E";
    }
}