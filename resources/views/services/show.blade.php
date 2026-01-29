@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden p-8 mb-12">
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
                @if($service->upload_type === 'pdf' && !empty($service->file_path))
                    <a href="{{ Illuminate\Support\Facades\Storage::url($service->file_path) }}" download class="block mb-6 group">
                        <x-service-media :service="$service" class="w-full h-auto object-cover rounded-lg shadow-md group-hover:opacity-90 transition" />
                        <span class="block text-center mt-2 text-sm text-blue-600 font-medium group-hover:underline">Download PDF</span>
                    </a>
                @else
                    <x-service-media :service="$service" class="w-full h-auto object-cover rounded-lg shadow-md mb-6" />
                @endif
                
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

        {{-- Image Gallery Slider --}}
        @if($service->images->isNotEmpty())
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Galeri</h2>
                
                {{-- Swiper Slider --}}
                <div class="swiper service-gallery-slider">
                    <div class="swiper-wrapper">
                        @foreach($service->images as $image)
                            <div class="swiper-slide">
                                <a href="{{ asset('storage/' . $image->image_path) }}" data-fancybox="gallery" class="block">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="Galeri gambar untuk {{ $service->title }}" 
                                         class="w-full h-64 object-cover rounded-lg shadow-md hover:opacity-90 transition cursor-pointer">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Navigation Buttons --}}
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    
                    {{-- Pagination --}}
                    <div class="swiper-pagination mt-4"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- Swiper CSS & JS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    
    <style>
        .service-gallery-slider {
            padding-bottom: 50px;
        }
        .service-gallery-slider .swiper-button-next,
        .service-gallery-slider .swiper-button-prev {
            color: #2563eb;
            background: rgba(255,255,255,0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .service-gallery-slider .swiper-button-next::after,
        .service-gallery-slider .swiper-button-prev::after {
            font-size: 18px;
            font-weight: bold;
        }
        .service-gallery-slider .swiper-pagination-bullet-active {
            background: #2563eb;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            new Swiper('.service-gallery-slider', {
                slidesPerView: 1,
                spaceBetween: 16,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
            });
            
            // Initialize Fancybox for gallery
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="gallery"]', {
                    Thumbs: {
                        type: "classic",
                    },
                });
            }
        });
    </script>
@endsection
