<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RST dr Asmir Salatiga</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logorst.png') }}"
                         alt="Logo"
                         class="h-10 w-auto"
                         onerror="this.onerror=null; this.src='https://placehold.co/40x40/3b82f6/ffffff?text=LOGO';">
                    <span class="text-xl font-bold text-blue-600">RST dr Asmir</span>
                </div>
                <div class="relative">
                    <a href="/" class="text-gray-600 hover:text-blue-600 px-3">Home</a>
                    <a href="{{ route('doctors.index') }}" class="text-gray-600 hover:text-blue-600 px-3">Dokter</a>
                    <!-- Dropdown Layanan -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block">
                        <button @click="open = !open" class="text-gray-600 hover:text-blue-600 px-3 focus:outline-none">
                            Layanan
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md z-10 py-2">
                            <a href="{{ route('services.featured') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Layanan Utama</a>
                            <a href="{{ route('services.other') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Layanan Lainnya</a>
                        </div>
                    </div>
                    <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-blue-600 px-3">Artikel</a>
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
                <img src="{{ asset('assets/images/logorst.png') }}"
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
