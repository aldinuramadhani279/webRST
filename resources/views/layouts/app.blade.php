<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RST dr Asmir Salatiga</title>
    <link rel="icon" href="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="/" class="flex items-center space-x-3">
                        <img src="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}" alt="Logo" class="h-12 w-auto">
                        <span class="text-xl font-bold text-gray-800">RST dr. Asmir</span>
                    </a>
                </div>

                <!-- Primary Nav -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="/" class="px-3 py-2 rounded-md text-base font-medium transition-colors {{ request()->is('/') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">Home</a>
                    <a href="{{ route('doctors.index') }}" class="px-3 py-2 rounded-md text-base font-medium transition-colors {{ request()->routeIs('doctors.index') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">Dokter</a>
                    <!-- Dropdown Layanan -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center w-full px-3 py-2 rounded-md text-base font-medium transition-colors {{ request()->routeIs('services.featured') || request()->routeIs('services.other') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                            <span>Layanan</span>
                            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 py-1">
                            <a href="{{ route('services.featured') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Layanan Utama</a>
                            <a href="{{ route('services.other') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Layanan Lainnya</a>
                        </div>
                    </div>
                    <a href="{{ route('articles.index') }}" class="px-3 py-2 rounded-md text-base font-medium transition-colors {{ request()->routeIs('articles.index') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">Artikel</a>
                    <!-- Dropdown Galeri -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center w-full px-3 py-2 rounded-md text-base font-medium transition-colors {{ request()->routeIs('gallery.photos') || request()->routeIs('gallery.videos') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                            <span>Galeri</span>
                            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 py-1">
                            <a href="{{ route('gallery.photos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Foto</a>
                            <a href="{{ route('gallery.videos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Video</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Button (Dynamic) -->
                <div class="hidden md:flex items-center">
                    @php
                        $emergencyNumbers = $settings['emergency_numbers'] ?? [];
                        // Defensive decode
                        if (!is_array($emergencyNumbers) && is_string($emergencyNumbers)) {
                            $emergencyNumbers = json_decode($emergencyNumbers, true);
                        }
                    @endphp

                    @if(is_array($emergencyNumbers) && count($emergencyNumbers) >= 2)
                        <!-- Dropdown for >= 2 numbers -->
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 px-4 py-2 rounded-md text-base font-bold transition-colors bg-red-600 text-white hover:bg-red-700 shadow-md"
                                    style="background-color: #dc2626; color: #ffffff;">
                                <i class="fas fa-phone-alt animate-pulse"></i>
                                <span>Hubungi Kami</span>
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-full bg-white rounded-lg shadow-xl z-50 py-2 border border-gray-100 overflow-hidden">
                                <div class="px-4 py-2 bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nomor Darurat
                                </div>
                                @foreach($emergencyNumbers as $emergency)
                                    <a href="https://wa.me/62{{ preg_replace('/[^0-9]/', '', $emergency['number'] ?? '') }}" target="_blank" class="flex items-center justify-between px-4 py-3 hover:bg-blue-50 border-b border-gray-50 last:border-0 group transition-colors">
                                        <div>
                                            <div class="font-bold text-gray-800 text-sm group-hover:text-blue-600">{{ $emergency['label'] ?? 'IGD' }}</div>
                                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                                {{ $emergency['number'] ?? '' }}
                                            </div>
                                        </div>
                                        <i class="fab fa-whatsapp text-green-500 text-xl group-hover:scale-110 transition-transform"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Single Button (Fallback) -->
                        @php
                            $singleNum = isset($emergencyNumbers[0]['number']) ? $emergencyNumbers[0]['number'] : ($settings['emergency_number'] ?? '0298324568');
                            $singleLabel = isset($emergencyNumbers[0]['label']) ? $emergencyNumbers[0]['label'] : 'IGD';
                        @endphp
                        <a href="https://wa.me/62{{ preg_replace('/[^0-9]/', '', $singleNum) }}" target="_blank" class="flex items-center space-x-2 px-3 py-2 rounded-md text-base font-medium transition-colors text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                            <div class="bg-green-100 p-1.5 rounded-full">
                                <i class="fab fa-whatsapp text-green-600 text-sm"></i>
                            </div>
                            <span class="font-semibold">{{ $singleLabel }} <span class="text-gray-500 font-normal">{{ $singleNum }}</span></span>
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-800 hover:text-blue-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-4 6h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-8">
        <div class="container mx-auto px-4 pt-12 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About -->
                <div class="flex flex-col">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}" 
                             alt="Logo" 
                             class="w-10 h-10 object-contain bg-white rounded p-1 flex-shrink-0"
                             style="max-width: 40px; max-height: 40px;"
                             onerror="this.src='https://placehold.co/40x40/3b82f6/ffffff?text=RST';">
                        <div>
                            <p class="font-bold text-white">RST dr. Asmir</p>
                            <p class="text-gray-400 text-xs">Salatiga</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Rumah Sakit yang berkomitmen memberikan pelayanan kesehatan terbaik.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('doctors.index') }}" class="text-gray-300 hover:text-white transition">Jadwal Dokter</a></li>
                        <li><a href="{{ route('services.featured') }}" class="text-gray-300 hover:text-white transition">Layanan Kami</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-300 hover:text-white transition">Artikel</a></li>
                        <li><a href="{{ route('gallery.photos') }}" class="text-gray-300 hover:text-white transition">Galeri</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1 text-blue-400"></i>
                            <span>{{ $settings['address'] ?? 'Jl. Osamaliki No.24, Salatiga' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-blue-400"></i>
                            <span>{{ $settings['phone'] ?? '(0298) 324568' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <span>{{ $settings['email'] ?? 'info@rstdrasmir.com' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Hours -->
                <div>
                    <h4 class="font-bold mb-4">Jam Operasional</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex justify-between"><span>IGD</span><span class="text-green-400 font-medium">{{ $settings['hours_igd'] ?? '24 Jam' }}</span></li>
                        <li class="flex justify-between"><span>Poliklinik</span><span>{{ $settings['hours_poliklinik'] ?? '08:00 - 21:00' }}</span></li>
                        <li class="flex justify-between"><span>Administrasi</span><span>{{ $settings['hours_admin'] ?? '08:00 - 16:00' }}</span></li>
                    </ul>
                    <div class="flex gap-3 mt-4">
                        @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" class="w-9 h-9 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition"><i class="fab fa-facebook-f text-sm"></i></a>
                        @endif
                        @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" class="w-9 h-9 bg-gray-700 hover:bg-pink-600 rounded-full flex items-center justify-center transition"><i class="fab fa-instagram text-sm"></i></a>
                        @endif
                        @if(!empty($settings['youtube_url']))
                        <a href="{{ $settings['youtube_url'] }}" target="_blank" class="w-9 h-9 bg-gray-700 hover:bg-red-600 rounded-full flex items-center justify-center transition"><i class="fab fa-youtube text-sm"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700">
            <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} RST dr Asmir Salatiga. All rights reserved.
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Fancybox.bind("[data-fancybox]", {
                // Your custom options
            });
        });
    </script>
</body>
</html>
