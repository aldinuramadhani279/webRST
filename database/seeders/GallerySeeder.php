<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Albums & Photos
        $album1 = Album::firstOrCreate(
            ['slug' => 'kegiatan-pelayanan-kesehatan'],
            ['title' => 'Kegiatan Pelayanan Kesehatan']
        );

        Photo::firstOrCreate(
            ['album_id' => $album1->id, 'path' => 'photos/pelayanan-1.jpg'],
            ['title' => 'Pemeriksaan Kesehatan Gratis']
        );

        $album2 = Album::firstOrCreate(
            ['slug' => 'fasilitas-rumah-sakit'],
            ['title' => 'Fasilitas Rumah Sakit']
        );

        Photo::firstOrCreate(
            ['album_id' => $album2->id, 'path' => 'photos/fasilitas-1.jpg'],
            ['title' => 'Gedung Rawat Jalan']
        );

        // Sample Videos
        Video::firstOrCreate(
            ['youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ['title' => 'Profil RS dr. Asmir Salatiga']
        );
        Video::firstOrCreate(
            ['youtube_link' => 'https://www.youtube.com/watch?v=3JZ_D3ELwOQ'],
            ['title' => 'Edukasi Kesehatan Jantung']
        );
    }
}
