@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Galeri Video</h1>

    @if($videos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($videos as $video)
                @php
                    // Helper logic to extract YouTube ID from various URL formats
                    $youtubeId = null;
                    $url = $video->youtube_link;
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                        $youtubeId = $match[1];
                    }
                @endphp

                @if($youtubeId)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <a href="{{ $video->youtube_link }}" target="_blank" rel="noopener noreferrer">
                            <div class="relative">
                                <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $video->title }}</h3>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <p class="text-xl text-gray-500">Belum ada video yang tersedia saat ini.</p>
        </div>
    @endif
</div>
@endsection
