@extends('layouts.app')

{{-- SEO: Title spesifik untuk halaman Home --}}
@section('title', 'Beranda - RST dr. Asmir Salatiga | Rumah Sakit TNI Terpercaya')

{{-- SEO: Meta description yang kaya keyword untuk halaman Home --}}
@section('meta_description', 'RST dr. Asmir Salatiga - Rumah Sakit TNI dengan layanan IGD 24 jam, Rawat Jalan, Rawat Inap, dan dokter spesialis berpengalaman. Melayani dengan hati, profesional dan terpercaya di Salatiga, Jawa Tengah.')

{{-- SEO: Canonical URL menunjuk ke halaman utama --}}
@section('canonical', url('/'))

{{-- SEO: JSON-LD Schema.org Hospital untuk hasil pencarian yang kaya (rich results) --}}
@section('schema_json'){
    "@context": "https://schema.org",
    "@type": "Hospital",
    "name": "RST dr. Asmir Salatiga",
    "alternateName": ["Rumah Sakit TNI dr. Asmir", "RST Asmir Salatiga", "RS Asmir"],
    "description": "Rumah Sakit TNI dr. Asmir Salatiga memberikan pelayanan kesehatan profesional dengan dokter spesialis berpengalaman, IGD 24 jam, rawat jalan, rawat inap, dan fasilitas medis lengkap.",
    "url": "{{ url('/') }}",
    "logo": "{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}",
    "image": "{{ !empty($settings['banner_image']) ? asset('storage/' . $settings['banner_image']) : asset('assets/images/bannerbaru.jpg') }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings['address'] ?? 'Jl. Osamaliki No.24' }}",
        "addressLocality": "Salatiga",
        "addressRegion": "Jawa Tengah",
        "postalCode": "50722",
        "addressCountry": "ID"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-7.3311",
        "longitude": "110.4981"
    },
    "telephone": "{{ $settings['phone'] ?? '+62298324568' }}",
    "email": "{{ $settings['email'] ?? 'info@rstdrasmir.com' }}",
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "name": "IGD",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            "opens": "00:00",
            "closes": "23:59"
        },
        {
            "@type": "OpeningHoursSpecification",
            "name": "Poliklinik",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            "opens": "08:00",
            "closes": "21:00"
        }
    ],
    "hasMap": "https://maps.google.com/?q=RST+dr+Asmir+Salatiga",
    "sameAs": []
}
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="relative max-h-[400px] overflow-hidden rounded-xl mx-3 mt-3 mb-3 border-4 border-white shadow-xl">
        <!-- Background Image -->
        <img src="{{ !empty($settings['banner_image']) ? asset('storage/' . $settings['banner_image']) : asset('assets/images/bannerbaru.jpg') }}"
             alt="Banner RST dr Asmir Salatiga - Rumah Sakit TNI Salatiga"
             class="w-full h-full object-cover">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="text-center text-white p-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selamat Datang di RST dr Asmir Salatiga</h1>
                <p class="text-lg md:text-xl mb-6">kami melayani dengan hati, Profesional dan Terpercaya</p>
                <a href="{{ route('doctors.index') }}" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                    Lihat Jadwal Dokter
                </a>
            </div>
        </div>
    </div>

    {{-- Partner Logos Section --}}
    @php
        $partnerLogos = $settings['partner_logos'] ?? [];
        // Fallback: decode if it's a JSON string (handling stale cache or provider miss)
        if (!is_array($partnerLogos) && is_string($partnerLogos)) {
            $partnerLogos = json_decode($partnerLogos, true);
        }
    @endphp
    @if(is_array($partnerLogos) && count($partnerLogos) > 0)
    <div class="bg-white rounded-xl shadow-md p-3 mb-2 border border-gray-100">
        <div class="flex items-center justify-center flex-wrap gap-6">
            @foreach($partnerLogos as $partner)
                <div class="flex flex-col items-center group">
                    <img src="{{ asset('storage/' . $partner['logo']) }}" 
                         alt="{{ $partner['name'] }}" 
                         class="h-[60px] w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                         style="height: 60px;">
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Services Section --}}
    <div class="py-2">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-3">Layanan Unggulan</h2>
            <div class="w-full flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-200px),transparent_100%)]">
                <div class="flex shrink-0 animate-marquee-right">
                    @foreach($services as $service)
                        <!-- Service Card -->
                        <a href="{{ route('services.show', $service) }}" class="w-72 md:w-80 flex-shrink-0 block mx-4">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl h-full border border-gray-200">
                                <x-service-media :service="$service" class="w-full h-40 object-cover" />
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2">{{ $service->title }}</h3>
                                    <p class="text-gray-600">{{ Str::limit(strip_tags($service->content), 100) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                 <div class="flex shrink-0 animate-marquee-right" aria-hidden="true">
                    @foreach($services as $service)
                        <!-- Service Card -->
                        <a href="{{ route('services.show', $service) }}" class="w-72 md:w-80 flex-shrink-0 block mx-4">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl h-full border border-gray-200">
                                <x-service-media :service="$service" class="w-full h-40 object-cover" />
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2">{{ $service->title }}</h3>
                                    <p class="text-gray-600">{{ Str::limit(strip_tags($service->content), 100) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Doctor Section --}}
    <div class="py-2 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-3">Dokter Kami</h2>
            <div class="w-full flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-200px),transparent_100%)]">
                @php
                    // Ambil 8 dokter secara acak dari database untuk memastikan cukup untuk scroll
                    $doctors = \App\Models\Doctor::with('specialization')->where('is_active', true)->inRandomOrder()->take(8)->get();
                @endphp
                <div class="flex shrink-0 animate-marquee-left">
                    @foreach($doctors as $doctor)
                        <a href="{{ route('doctors.show', $doctor) }}" class="block bg-white rounded-lg shadow-md p-6 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200 w-64 flex-shrink-0 mx-4">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=3b82f6&color=fff" alt="{{ $doctor->name }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                            @endif
                            <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $doctor->specialization->name }}</p>
                        </a>
                    @endforeach
                </div>
                <div class="flex shrink-0 animate-marquee-left" aria-hidden="true">
                    @foreach($doctors as $doctor)
                        <a href="{{ route('doctors.show', $doctor) }}" class="block bg-white rounded-lg shadow-md p-6 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200 w-64 flex-shrink-0 mx-4">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=3b82f6&color=fff" alt="{{ $doctor->name }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                            @endif
                            <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $doctor->specialization->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('doctors.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Lihat Semua Dokter</a>
            </div>
        </div>
    </div>

    {{-- Articles Section --}}
    <div class="py-2">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-3">Artikel Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article) }}" class="block bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    {{-- About Section --}}
    @if(!empty($settings['about_us_title']) && !empty($settings['about_us_content']))
    <div class="py-4 pb-6"> <!-- Adjusted padding -->
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-50">
                <div class="md:flex">
                    <!-- Decorative Side (Optional, or just styling) -->
                    <div class="hidden md:block md:w-2/12 bg-gradient-to-b from-blue-600 to-cyan-500 relative">
                        <div class="absolute inset-0 flex items-center justify-center text-white/20">
                            <i class="fas fa-hospital text-6xl"></i>
                        </div>
                    </div>
                    
                    <!-- Content Side -->
                    <div class="w-full md:w-10/12 p-8 md:p-10">
                        <div class="flex items-center space-x-3 mb-4">
                            <i class="fas fa-info-circle text-blue-600 text-2xl md:hidden"></i> <!-- Icon for mobile -->
                            <h2 class="text-3xl font-bold text-gray-800">{{ $settings['about_us_title'] }}</h2>
                        </div>
                        
                        @if(!empty($settings['about_us_subtitle']))
                            <p class="text-lg text-blue-500 font-medium mb-6 italic">{{ $settings['about_us_subtitle'] }}</p>
                        @endif
                        
                        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                            {!! $settings['about_us_content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
