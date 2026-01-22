<x-filament-panels::page>
    <form wire:submit="import">
        <div class="fi-fo-field-wrp">
            <div class="grid gap-y-2">
                <label for="excelFile" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        File Excel (.xlsx atau .xls) <span class="text-danger-600">*</span>
                    </span>
                </label>
                
                <input 
                    type="file" 
                    id="excelFile"
                    wire:model="excelFile"
                    accept=".xlsx,.xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 p-2"
                />
                
                @error('excelFile') 
                    <p class="text-sm text-danger-600">{{ $message }}</p>
                @enderror
                
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Upload file Excel dengan format sesuai template. Maksimal 10MB.
                </p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <x-filament::button type="submit" size="lg" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="import">
                    <x-heroicon-o-arrow-up-tray class="w-5 h-5 mr-2 inline" />
                    Import Jadwal
                </span>
                <span wire:loading wire:target="import">
                    Processing...
                </span>
            </x-filament::button>

            <x-filament::button 
                tag="a" 
                href="{{ \App\Filament\Resources\ScheduleResource::getUrl('index') }}"
                color="gray"
            >
                Kembali
            </x-filament::button>
        </div>
        
        <!-- Loading indicator for file upload -->
        <div wire:loading wire:target="excelFile" class="mt-4">
            <p class="text-sm text-primary-600">Mengupload file...</p>
        </div>
    </form>

    <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
        <h3 class="font-semibold text-lg mb-2">Petunjuk Import:</h3>
        <ul class="list-disc list-inside space-y-1 text-sm text-gray-600 dark:text-gray-400">
            <li>Download template Excel terlebih dahulu dari halaman Jadwal</li>
            <li>Hapus baris contoh (baris kuning) sebelum import</li>
            <li>Isi data sesuai format template</li>
            <li>Upload file Excel yang sudah diisi</li>
            <li><strong>Tunggu sampai upload selesai</strong> (loading hilang), baru klik Import</li>
        </ul>
    </div>
</x-filament-panels::page>
