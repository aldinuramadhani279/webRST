<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        // Hanya artikel yang statusnya published dan tanggal publikasinya sudah tercapai yang bisa dilihat
        $publishedAt = \Carbon\Carbon::parse($article->published_at);
        if ($article->status !== 'published' || $publishedAt->gt(now())) {
            abort(404);
        }

        return view('articles.show', compact('article'));
    }
}