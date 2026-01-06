<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

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
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('emergency_number')
                    ->label('Emergency Number (UGD)')
                    ->required(),

                FileUpload::make('logo')
                    ->label('Site Logo')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['1:1', '4:3']) // Square and standard
                    ->imageCropAspectRatio('1:1')
                    ->directory('settings')
                    ->disk('public'),

                FileUpload::make('banner_image')
                    ->label('Homepage Banner')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['16:9', '4:3']) // Wide and standard
                    ->imageCropAspectRatio('16:9')
                    ->directory('settings')
                    ->disk('public'),
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
    }
}
