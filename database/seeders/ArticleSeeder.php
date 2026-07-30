<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Jantung di Usia Produktif',
                'content' => '<p>Menjaga kesehatan jantung sangat penting sejak usia muda. Lakukan olahraga teratur minimal 30 menit sehari, konsumsi makanan bergizi seimbang, hindari merokok, dan kelola stres dengan baik.</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Pentingnya Imunisasi Rutin Bagi Tumbuh Kembang Anak',
                'content' => '<p>Imunisasi merupakan langkah efektif untuk melindungi anak dari berbagai penyakit berbahaya seperti campak, polio, dan hepatitis. Pastikan anak mendapatkan vaksinasi sesuai jadwal rekomendasi dokter anak.</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Cara Mencegah Gigi Berlubang pada Anak dan Dewasa',
                'content' => '<p>Gigi berlubang dapat dicegah dengan menyikat gigi dua kali sehari menggunakan pasta gigi berfluoride, membatasi konsumsi makanan manis, dan rutin memeriksakan gigi ke dokter setiap 6 bulan sekali.</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(
                ['slug' => Str::slug($art['title'])],
                [
                    'title' => $art['title'],
                    'content' => $art['content'],
                    'thumbnail' => null,
                    'status' => $art['status'],
                    'published_at' => $art['published_at'],
                ]
            );
        }
    }
}
