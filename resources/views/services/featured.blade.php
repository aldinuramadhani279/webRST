@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Layanan Utama</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
<img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $service->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit(strip_tags($service->content), 100) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full">Belum ada layanan utama yang tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
@endsection