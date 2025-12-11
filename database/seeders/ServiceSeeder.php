<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Daftar layanan utama berdasarkan nama file (tanpa ekstensi)
        $featuredServices = [
            'FisioTerapi',
            'KonsultasiGigi',
            'PemeriksaanUmum',
            'Radiologi',
            'Laboraturium', // Ini mewakili 'Test Laboratorium'
            'Vaksinasi',
        ];

        $imagePath = public_path('assets/images/services');
        
        if (!File::isDirectory($imagePath)) {
            $this->command->error('Direktori gambar layanan tidak ditemukan di: ' . $imagePath);
            return;
        }

        $files = File::files($imagePath);

        foreach ($files as $file) {
            $fileName = $file->getFilenameWithoutExtension();
            
            // Membuat judul yang lebih mudah dibaca dari nama file PascalCase
            $title = trim(preg_replace('/(?<!^)[A-Z]/', ' $0', $fileName));

            // Periksa apakah layanan ini adalah layanan utama
            $isFeatured = in_array($fileName, $featuredServices);
            
            // Konten placeholder
            $content = "Deskripsi lengkap untuk layanan {$title} akan segera tersedia. Kami menyediakan layanan {$title} dengan dukungan tenaga medis profesional dan peralatan modern untuk memastikan Anda mendapatkan penanganan terbaik.";

            // Gunakan updateOrCreate untuk menghindari duplikasi data
            // Cocokkan berdasarkan 'title' untuk memastikan konsistensi
            Service::updateOrCreate(
                ['title' => $title],
                [
                    'slug' => Str::slug($title),
                    'image' => 'services/' . $file->getFilename(), // Menambahkan path direktori
                    'content' => $content,
                    'is_featured' => $isFeatured,
                ]
            );

            $this->command->info("Layanan '{$title}' telah di-seed ke database.");
        }
    }
}
