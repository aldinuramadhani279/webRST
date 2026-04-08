<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Doctor Header --}}
        <div class="flex items-center gap-4 p-4 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 shadow-sm">
            <div class="h-14 w-14 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                <span class="text-primary-600 dark:text-primary-400 font-bold text-xl">
                    {{ strtoupper(substr($this->doctor->name, 0, 1)) }}
                </span>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $this->doctor->name }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $this->doctor->specialization?->name ?? 'Umum' }} &bull; SIP: {{ $this->doctor->sip_number }}</p>
            </div>
            <div class="ml-auto">
                <a href="{{ \App\Filament\Resources\ScheduleResource::getUrl('index') }}"
                   class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 flex items-center gap-1">
                    <x-heroicon-o-arrow-left class="h-4 w-4" />
                    Ganti Dokter
                </a>
            </div>
        </div>

        {{-- Schedule Per Day --}}
        <div class="space-y-3">
            @foreach(\App\Filament\Resources\ScheduleResource\Pages\ManageDoctorSchedule::$days as $day)
                <div
                    class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm overflow-hidden"
                >
                    {{-- Day Header --}}
                    <div class="flex items-center justify-between px-5 py-3 bg-gray-50 dark:bg-white/5 border-b border-gray-200 dark:border-white/10">
                        <span class="font-semibold text-sm text-gray-700 dark:text-gray-200">{{ $day }}</span>
                        <button
                            wire:click="addSession('{{ $day }}')"
                            type="button"
                            class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors"
                        >
                            <x-heroicon-o-plus-circle class="h-4 w-4" />
                            Tambah Sesi
                        </button>
                    </div>

                    {{-- Sessions --}}
                    <div class="divide-y divide-gray-100 dark:divide-white/5">
                        @foreach($schedules[$day] as $index => $session)
                            <div class="flex items-center gap-3 px-5 py-3">
                                {{-- Session number badge --}}
                                <span class="flex-shrink-0 inline-flex items-center justify-center h-6 w-6 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold">
                                    {{ $index + 1 }}
                                </span>

                                {{-- Start Time --}}
                                <div class="flex items-center gap-2 flex-1">
                                    <label class="text-xs text-gray-500 dark:text-gray-400 w-16 flex-shrink-0">Mulai</label>
                                    <input
                                        type="time"
                                        wire:model.live="schedules.{{ $day }}.{{ $index }}.start"
                                        class="block w-full rounded-lg border-0 bg-gray-50 dark:bg-white/5 py-1.5 px-3 text-sm text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-white/20 focus:ring-2 focus:ring-primary-500 transition-shadow"
                                    />
                                </div>

                                <span class="text-gray-400 dark:text-gray-500 text-sm font-medium flex-shrink-0">hingga</span>

                                {{-- End Time --}}
                                <div class="flex items-center gap-2 flex-1">
                                    <label class="text-xs text-gray-500 dark:text-gray-400 w-16 flex-shrink-0">Selesai</label>
                                    <input
                                        type="time"
                                        wire:model.live="schedules.{{ $day }}.{{ $index }}.end"
                                        class="block w-full rounded-lg border-0 bg-gray-50 dark:bg-white/5 py-1.5 px-3 text-sm text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-white/20 focus:ring-2 focus:ring-primary-500 transition-shadow"
                                    />
                                </div>

                                {{-- Remove Button --}}
                                <button
                                    wire:click="removeSession('{{ $day }}', {{ $index }})"
                                    type="button"
                                    class="flex-shrink-0 text-gray-400 hover:text-danger-500 dark:hover:text-danger-400 transition-colors p-1 rounded"
                                    title="Hapus sesi ini"
                                >
                                    <x-heroicon-o-trash class="h-4 w-4" />
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end pt-2">
            <button
                wire:click="save"
                wire:loading.attr="disabled"
                type="button"
                class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:opacity-70 transition-colors"
            >
                <span wire:loading.remove wire:target="save">
                    <x-heroicon-o-check class="h-4 w-4 inline -mt-0.5" />
                </span>
                <span wire:loading wire:target="save">
                    <svg class="animate-spin h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </span>
                Simpan Jadwal
            </button>
        </div>

    </div>
</x-filament-panels::page>
