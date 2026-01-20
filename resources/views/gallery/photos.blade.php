@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8 text-center">Galeri Foto</h1>

    @forelse($albums as $album)
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6 border-l-4 border-blue-600 pl-4">{{ $album->title }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($album->photos as $photo)
                    <a href="{{ asset('storage/' . $photo->path) }}" data-fancybox="gallery-{{ $album->id }}" class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->title ?? 'Foto Galeri' }}" class="w-full h-48 object-cover transform hover:scale-105 transition-transform duration-300">
                    </a>
                @endforeach
            </div>
        </section>
    @empty
        <div class="text-center py-16 bg-white rounded-lg shadow-sm">
            <i class="far fa-images text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada album foto yang tersedia saat ini.</p>
        </div>
    @endforelse

    <div class="mt-8">
        {{ $albums->links() }}
    </div>
@endsection