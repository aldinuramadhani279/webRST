@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="relative max-h-[400px] overflow-hidden rounded-xl mx-auto mt-4 mb-2 border-4 border-white shadow-lg">
        <!-- Background Image -->
        <img src="{{ !empty($settings['banner_image']) ? asset('storage/' . $settings['banner_image']) : asset('assets/images/bannerbaru.jpg') }}"
             alt="Banner RST dr Asmir"
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
    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border border-gray-100">
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
    <div class="py-4">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Layanan Unggulan</h2>
            <!-- Scrollable container -->
            <div class="flex overflow-x-auto space-x-8 snap-x snap-mandatory pb-4">
                @foreach($services as $service)
                    <!-- Service Card -->
                    <a href="{{ route('services.show', $service) }}" class="snap-start w-72 md:w-80 flex-shrink-0 block">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl h-full border border-gray-200">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-40 object-cover">
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

    {{-- Doctor Section --}}
    <div class="py-4 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Dokter Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    // Ambil 4 dokter secara acak dari database
                    $doctors = \App\Models\Doctor::with('specialization')->where('is_active', true)->inRandomOrder()->take(4)->get();
                @endphp
                @foreach($doctors as $doctor)
                    <a href="{{ route('doctors.show', $doctor) }}" class="block bg-white rounded-lg shadow-md p-6 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200">
                        @if($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}"
                                 alt="{{ $doctor->name }}"
                                 class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                        @else
                            <!-- Placeholder menggunakan gambar generik dokter -->
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=3b82f6&color=fff"
                                 alt="{{ $doctor->name }}"
                                 class="w-16 h-16 rounded-full mx-auto mb-4 object-cover border-2 border-white shadow">
                        @endif
                        <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $doctor->specialization->name }}</p>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('doctors.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Lihat Semua Dokter</a>
            </div>
        </div>
    </div>

    {{-- Articles Section --}}
    <div class="py-4">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Artikel Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article) }}" class="block bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
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
    <div class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-3">{{ $settings['about_us_title'] }}</h2>
            @if(!empty($settings['about_us_subtitle']))
                <p class="text-lg text-gray-300 mb-4">{{ $settings['about_us_subtitle'] }}</p>
            @endif
            <div class="prose prose-invert max-w-3xl mx-auto">
                {!! $settings['about_us_content'] !!}
            </div>
        </div>
    </div>
    @endif
@endsection
