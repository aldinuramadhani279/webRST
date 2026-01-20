@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8 text-center">Galeri Video</h1>

    @if($videos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($videos as $video)
                @php
                    $youtubeID = null;
                    if(preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->youtube_link, $matches)) {
                        $youtubeID = $matches[1];
                    }
                @endphp
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative pb-[56.25%] h-0">
                        @if($youtubeID)
                            <iframe 
                                class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $youtubeID }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
                                <i class="fas fa-video-slash text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $video->title }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg shadow-sm">
            <i class="fas fa-film text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada video yang tersedia saat ini.</p>
        </div>
    @endif
@endsection
