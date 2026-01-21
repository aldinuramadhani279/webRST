<?php

namespace App\Providers\Filament;

use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->font('Segoe UI', provider: LocalFontProvider::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName('RST dr Asmir') // Set custom brand name
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class, // Remove Filament info widget
            ])
            ->spa(false) // Disable SPA to prevent Alpine/Livewire state issues
            ->renderHook(
                'panels::head.end',
                fn (): string => '<style>
                    /* NUCLEAR FIX: Hide ALL stuck modal overlays completely */
                    .fi-modal-close-overlay,
                    [x-show="isOpen"][x-transition],
                    .fixed.inset-0.bg-gray-900\/50,
                    .fixed.inset-0[aria-hidden="true"],
                    div[x-ref="modalContainer"] > div.fixed,
                    .fi-modal-window ~ div.fixed {
                        display: none !important;
                        visibility: hidden !important;
                        opacity: 0 !important;
                        pointer-events: none !important;
                        z-index: -9999 !important;
                        width: 0 !important;
                        height: 0 !important;
                    }
                    /* Ensure main content is always clickable */
                    .fi-main, .fi-sidebar, .fi-topbar, .fi-ta-table {
                        pointer-events: auto !important;
                        position: relative;
                        z-index: 1;
                    }
                </style>'
            )
            ->renderHook(
                'panels::body.end',
                fn (): string => '<script>
                    // Remove stuck overlays after every Livewire update
                    function removeStuckOverlays() {
                        const overlaySelectors = [
                            ".fixed.inset-0.z-40",
                            ".fixed.inset-0.bg-gray-900\\/50",
                            "[aria-hidden=\"true\"].fixed.inset-0",
                            ".fi-modal-close-overlay"
                        ];
                        overlaySelectors.forEach(selector => {
                            document.querySelectorAll(selector).forEach(el => {
                                el.style.display = "none";
                                el.style.pointerEvents = "none";
                                el.remove();
                            });
                        });
                    }
                    
                    // Run on initial load
                    document.addEventListener("DOMContentLoaded", removeStuckOverlays);
                    
                    // Run after every Livewire update
                    document.addEventListener("livewire:navigated", removeStuckOverlays);
                    document.addEventListener("livewire:load", removeStuckOverlays);
                    
                    // Also use MutationObserver to catch dynamically added overlays
                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            mutation.addedNodes.forEach((node) => {
                                if (node.nodeType === 1 && node.classList && 
                                    (node.classList.contains("fixed") || node.classList.contains("fi-modal"))) {
                                    setTimeout(removeStuckOverlays, 100);
                                }
                            });
                        });
                    });
                    observer.observe(document.body, { childList: true, subtree: true });
                    
                    // Periodic cleanup every 2 seconds
                    setInterval(removeStuckOverlays, 2000);
                </script>'
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
