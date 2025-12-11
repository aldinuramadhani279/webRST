@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('uploads/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>
                <p class="text-gray-600 text-sm mb-6">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</p>
                <div class="prose max-w-none">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('articles.index') }}" class="text-blue-600 hover:underline">
                &larr; Kembali ke Artikel
            </a>
        </div>
    </div>
@endsection