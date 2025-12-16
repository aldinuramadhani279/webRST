@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Artikel Kesehatan</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <a href="{{ route('articles.show', $article) }}" class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</p>
                        <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                    </div>
                </a>
            @empty
                <p class="text-center col-span-full">Belum ada artikel yang dipublikasikan.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
@endsection