<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    /**
     * Prefix route yang diabaikan (tidak ditrack)
     */
    protected array $excludedPrefixes = [
        'admin',
        'livewire',
        '_debugbar',
        'telescope',
        'horizon',
    ];

    /**
     * Ekstensi file yang diabaikan
     */
    protected array $excludedExtensions = [
        'css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico',
        'woff', 'woff2', 'ttf', 'eot', 'map', 'webp',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya track request GET yang menghasilkan halaman HTML
        if ($request->method() !== 'GET' || !$response->isSuccessful()) {
            return $response;
        }

        $url = $request->path();

        // Skip jika URL termasuk prefix yang dikecualikan
        foreach ($this->excludedPrefixes as $prefix) {
            if (str_starts_with($url, $prefix)) {
                return $response;
            }
        }

        // Skip jika URL memiliki ekstensi file yang dikecualikan
        $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));
        if (in_array($extension, $this->excludedExtensions)) {
            return $response;
        }

        // Tentukan nama halaman yang mudah dibaca
        $pageName = $this->getPageName($url, $request);

        // Simpan kunjungan
        try {
            PageVisit::create([
                'url'        => '/' . ltrim($url, '/'),
                'page_name'  => $pageName,
                'ip_address' => $request->ip(),
                'session_id' => $request->session()->getId(),
                'user_agent' => $request->userAgent(),
                'referer'    => $request->header('referer'),
            ]);
        } catch (\Exception $e) {
            // Jangan sampai error tracking mengganggu response
            logger()->error('TrackPageVisit error: ' . $e->getMessage());
        }

        return $response;
    }

    protected function getPageName(string $url, Request $request): string
    {
        $routeName = $request->route()?->getName() ?? '';

        $pageNames = [
            ''                    => 'Beranda',
            'home'                => 'Beranda',
            'doctors.index'       => 'Dokter',
            'articles.index'      => 'Artikel',
            'services.featured'   => 'Layanan Utama',
            'services.other'      => 'Layanan Lainnya',
            'gallery.photos'      => 'Galeri Foto',
            'gallery.videos'      => 'Galeri Video',
        ];

        if (isset($pageNames[$routeName])) {
            return $pageNames[$routeName];
        }

        // Untuk halaman detail (service, artikel, dokter)
        if (str_starts_with($routeName, 'services.show')) return 'Detail Layanan';
        if (str_starts_with($routeName, 'articles.show')) return 'Detail Artikel';
        if (str_starts_with($routeName, 'doctors.show')) return 'Detail Dokter';

        // Fallback: gunakan URL path
        return '/' . ltrim($url, '/');
    }
}
