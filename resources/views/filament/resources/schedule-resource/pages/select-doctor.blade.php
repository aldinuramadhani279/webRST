<x-filament-panels::page>
    <div class="space-y-4">
        {{-- Search Bar --}}
        <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 ring-gray-950/10 dark:ring-white/20 bg-white dark:bg-white/5">
            <div class="min-w-0 flex-1">
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Cari nama dokter..."
                    class="block w-full border-0 bg-transparent py-3 px-4 text-sm text-gray-950 placeholder:text-gray-400 focus:ring-0 dark:text-white dark:placeholder:text-gray-500"
                />
            </div>
            <div class="flex items-center pe-3">
                <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400" />
            </div>
        </div>

        {{-- Doctor Grid --}}
        @php $doctors = $this->getDoctors(); @endphp

        @if($doctors->isEmpty())
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-user-group class="mx-auto h-12 w-12 mb-3 opacity-40" />
                <p class="text-sm">Tidak ada dokter ditemukan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($doctors as $doctor)
                    <a
                        href="{{ \App\Filament\Resources\ScheduleResource::getUrl('manage', ['doctorId' => $doctor->id]) }}"
                        class="group flex items-center gap-4 rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-4 shadow-sm hover:border-primary-500 hover:shadow-md transition-all duration-200"
                    >
                        {{-- Avatar --}}
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <span class="text-primary-600 dark:text-primary-400 font-bold text-lg">
                                {{ strtoupper(substr($doctor->name, 0, 1)) }}
                            </span>
                        </div>
                        {{-- Info --}}
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                {{ $doctor->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                {{ $doctor->specialization?->name ?? 'Umum' }}
                            </p>
                        </div>
                        {{-- Arrow --}}
                        <x-heroicon-o-chevron-right class="h-4 w-4 text-gray-400 group-hover:text-primary-500 flex-shrink-0 transition-colors" />
                    </a>
                @endforeach
            </div>

            <p class="text-xs text-gray-400 dark:text-gray-500 text-right">
                {{ $doctors->count() }} dokter ditemukan
            </p>
        @endif
    </div>
</x-filament-panels::page>
