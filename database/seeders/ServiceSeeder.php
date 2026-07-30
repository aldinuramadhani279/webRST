<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
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
        $defaultServices = [
            ['title' => 'Pemeriksaan Umum', 'category' => 'rawat_jalan', 'is_featured' => true],
            ['title' => 'Konsultasi Gigi', 'category' => 'rawat_jalan', 'is_featured' => true],
            ['title' => 'Fisioterapi', 'category' => 'rawat_jalan', 'is_featured' => true],
            ['title' => 'Vaksinasi', 'category' => 'rawat_jalan', 'is_featured' => true],
            ['title' => 'Test Laboratorium', 'category' => 'penunjang', 'is_featured' => true],
            ['title' => 'Radiologi', 'category' => 'penunjang', 'is_featured' => true],
            ['title' => 'Rawat Inap VIP', 'category' => 'rawat_inap', 'is_featured' => false],
            ['title' => 'Rawat Inap Kelas 1', 'category' => 'rawat_inap', 'is_featured' => false],
        ];

        $imagePath = public_path('assets/images/services');

        if (File::isDirectory($imagePath)) {
            $files = File::files($imagePath);
            foreach ($files as $file) {
                $fileName = $file->getFilenameWithoutExtension();
                $title = trim(preg_replace('/(?<!^)[A-Z]/', ' $0', $fileName));
                
                // Tentukan kategori sederhana berdasarkan judul
                $category = 'rawat_jalan';
                if (Str::contains(strtolower($title), ['laborat', 'radiologi'])) {
                    $category = 'penunjang';
                } elseif (Str::contains(strtolower($title), ['inap'])) {
                    $category = 'rawat_inap';
                }

                Service::updateOrCreate(
                    ['title' => $title],
                    [
                        'slug' => Str::slug($title),
                        'category' => $category,
                        'image' => 'services/'.$file->getFilename(),
                        'content' => "Deskripsi lengkap untuk layanan {$title} akan segera tersedia. Kami menyediakan layanan {$title} dengan dukungan tenaga medis profesional dan peralatan modern.",
                        'is_featured' => true,
                    ]
                );
            }
        }

        // Pastikan sampel dasar selalu terisi
        foreach ($defaultServices as $srv) {
            Service::firstOrCreate(
                ['title' => $srv['title']],
                [
                    'slug' => Str::slug($srv['title']),
                    'category' => $srv['category'],
                    'content' => "Deskripsi lengkap untuk layanan {$srv['title']} dengan fasilitas lengkap dan dokter ahli.",
                    'image' => null,
                    'is_featured' => $srv['is_featured'],
                ]
            );
        }
    }
}
