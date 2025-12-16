@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden p-8">
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-gray-800">{{ $service->title }}</h1>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="md:col-span-2">
                <div class="prose max-w-none">
                    {!! $service->content !!}
                </div>
            </div>

            {{-- Sidebar with Main Image and Contact --}}
            <div>
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-auto object-cover rounded-lg shadow-md mb-6">
                
                {{-- Contact Link --}}
                @if($service->contact_link)
                    @php
                        $iconClass = '';
                        switch ($service->contact_icon) {
                            case 'whatsapp':
                                $iconClass = 'fab fa-whatsapp';
                                break;
                            case 'instagram':
                                $iconClass = 'fab fa-instagram';
                                break;
                            case 'facebook':
                                $iconClass = 'fab fa-facebook';
                                break;
                            case 'globe':
                                $iconClass = 'fas fa-globe';
                                break;
                        }
                    @endphp
                    <a href="{{ $service->contact_link }}" target="_blank" class="flex items-center justify-center space-x-2 w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        @if($iconClass)
                            <i class="{{ $iconClass }} fa-lg"></i>
                        @endif
                        <span>Kontak Layanan</span>
                    </a>
                @endif
            </div>
        </div>

        {{-- Image Gallery --}}
        @if($service->images->isNotEmpty())
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Galeri</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($service->images as $image)
                        <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Galeri gambar untuk {{ $service->title }}" class="w-full h-auto object-cover rounded-lg shadow-md hover:opacity-80 transition">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
