<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.site-settings';
    protected static ?string $title = 'Site Settings';
    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        // Decode JSON fields for repeater
        if (isset($settings['emergency_numbers'])) {
            $decoded = json_decode($settings['emergency_numbers'], true);
            $settings['emergency_numbers'] = is_array($decoded) ? $decoded : [];
        }

        if (isset($settings['partner_logos'])) {
            $decoded = json_decode($settings['partner_logos'], true);
            $settings['partner_logos'] = is_array($decoded) ? $decoded : [];
        }

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Logo & Banner')
                    ->description('Pengaturan logo dan banner website')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Website')
                            ->image()
                            ->directory('settings')
                            ->disk('public'),
                        FileUpload::make('banner_image')
                            ->label('Banner Homepage')
                            ->image()
                            ->directory('settings')
                            ->disk('public'),
                    ])->columns(2),

                Section::make('Logo Partner / Mitra')
                    ->description('Upload logo-logo mitra/partner yang akan ditampilkan di halaman utama')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Repeater::make('partner_logos')
                            ->label('')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->directory('partners')
                                    ->disk('public')
                                    ->required(),
                                TextInput::make('name')
                                    ->label('Nama Mitra')
                                    ->placeholder('Contoh: BPJS Kesehatan')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Logo Mitra')
                            ->reorderable()
                            ->collapsible(),
                    ]),

                Section::make('Informasi Kontak')
                    ->description('Alamat dan kontak yang akan ditampilkan di footer')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(2),
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email(),
                    ]),

                Section::make('Social Media')
                    ->description('Link social media footer')
                    ->icon('heroicon-o-share')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->prefix('https://'),
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->prefix('https://'),
                        TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->prefix('https://'),
                    ])->columns(3),

                Section::make('Jam Operasional')
                    ->description('Jadwal operasional yang tampil di footer')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        TextInput::make('hours_igd')
                            ->label('Jam IGD')
                            ->default('24 Jam'),
                        TextInput::make('hours_poliklinik')
                            ->label('Jam Poliklinik')
                            ->placeholder('Contoh: 08:00 - 21:00'),
                        TextInput::make('hours_admin')
                            ->label('Jam Administrasi')
                            ->placeholder('Contoh: 08:00 - 16:00'),
                    ])->columns(3),
                
                Section::make('Nomor Darurat / Emergency')
                    ->description('Kelola nomor telepon darurat yang akan ditampilkan di website')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Repeater::make('emergency_numbers')
                            ->label('Daftar Nomor')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->placeholder('Contoh: IGD')
                                    ->required(),
                                TextInput::make('number')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Nomor')
                            ->reorderable()
                            ->collapsible(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

        public function save(): void
        {
            $data = $this->form->getState();
    
            foreach ($data as $key => $value) {
                // Only update the setting if a new value is provided.
                // This prevents overwriting existing images with null when only other fields are updated.
                if ($value !== null) {
                    Setting::updateOrCreate(['key' => $key], ['value' => $value]);
                }
            }
            
            // Clear the settings cache to apply changes immediately
            cache()->forget('settings');
    
            Notification::make()
                ->title('Settings saved successfully!')
                ->success()
                ->send();
        }}
