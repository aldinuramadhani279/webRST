<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $services = Service::select('slug', 'updated_at')->get();
        $articles = Article::select('id', 'updated_at')
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->get();
        $doctors  = Doctor::select('id', 'updated_at')->where('is_active', true)->get();

        $content = view('sitemap', compact('services', 'articles', 'doctors'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
