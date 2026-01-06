<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Specialization;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $services = Cache::remember('home_services', 3600, function () {
            return Service::where('is_featured', true)->take(12)->get();
        });

        $articles = Cache::remember('home_articles', 3600, function () {
            return Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        $specializations = Cache::remember('home_specializations', 3600, function () {
            return Specialization::all();
        });

        return view('home', compact('services', 'articles', 'specializations'));
    }
}
