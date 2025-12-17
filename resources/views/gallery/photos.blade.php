@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Galeri Foto</h1>

    @forelse($albums as $album)
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6 border-l-4 border-blue-600 pl-4">{{ $album->title }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($album->photos as $photo)
                    <a href="{{ asset('storage/' . $photo->path) }}" data-fancybox="gallery-{{ $album->slug }}" data-caption="{{ $photo->title }}">
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-105">
                    </a>
                @empty
                    <p class="text-gray-500 col-span-full">Belum ada foto di album ini.</p>
                @endforelse
            </div>
        </section>
    @empty
        <div class="text-center py-16">
            <p class="text-xl text-gray-500">Belum ada album foto yang tersedia saat ini.</p>
        </div>
    @endforelse
</div>
@endsection