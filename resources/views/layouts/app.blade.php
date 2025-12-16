<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RST dr Asmir Salatiga</title>
    <link rel="icon" href="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                </div>

                <!-- Contact Button (Single WhatsApp) -->
                <div class="hidden md:flex items-center">
                    <a href="https://wa.me/62{{ preg_replace('/[^0-9]/', '', $settings['emergency_number'] ?? '0298324568') }}" target="_blank" class="flex items-center space-x-2 px-3 py-2 rounded-md text-base font-medium transition-colors text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fab fa-whatsapp"></i>
                        <span>IGD {{ $settings['emergency_number'] ?? '(0298) 324568' }}</span>
                    </a>
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

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center items-center space-x-4 mb-4">
                <img src="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('assets/images/logorst.png') }}"
                     alt="Logo RST"
                     class="h-12 w-auto"
                     onerror="this.onerror=null; this.src='https://placehold.co/48x48/3b82f6/ffffff?text=RST';">
                <span>Rumah Sakit</span>
            </div>
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="hover:text-blue-300">Tentang Kami</a>
                <a href="#" class="hover:text-blue-300">Layanan</a>
                <a href="#" class="hover:text-blue-300">Kontak</a>
                <a href="#" class="hover:text-blue-300">Karir</a>
            </div>
            &copy; {{ date('Y') }} RST dr Asmir Salatiga. All rights reserved.
        </div>
    </footer>
</body>
</html>
