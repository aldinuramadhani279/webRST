<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Halaman Utama (prioritas tertinggi) --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Dokter --}}
    <url>
        <loc>{{ route('doctors.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Layanan Utama --}}
    <url>
        <loc>{{ route('services.featured') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Layanan Lainnya --}}
    <url>
        <loc>{{ route('services.other') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Artikel --}}
    <url>
        <loc>{{ route('articles.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.7</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Galeri Foto --}}
    <url>
        <loc>{{ route('gallery.photos') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Halaman Galeri Video --}}
    <url>
        <loc>{{ route('gallery.videos') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>

    {{-- Detail Layanan --}}
    @foreach($services as $service)
    <url>
        <loc>{{ route('services.show', $service->slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        <lastmod>{{ $service->updated_at->toDateString() }}</lastmod>
    </url>
    @endforeach

    {{-- Detail Artikel --}}
    @foreach($articles as $article)
    <url>
        <loc>{{ route('articles.show', $article->id) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
        <lastmod>{{ $article->updated_at->toDateString() }}</lastmod>
    </url>
    @endforeach

    {{-- Detail Dokter --}}
    @foreach($doctors as $doctor)
    <url>
        <loc>{{ route('doctors.show', $doctor->id) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
        <lastmod>{{ $doctor->updated_at->toDateString() }}</lastmod>
    </url>
    @endforeach

</urlset>
