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
            ->brandName('RST dr Asmir')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->spa(false)
            ->renderHook(
                'panels::head.end',
                fn (): string => '<style>
                    /* Prevent overlay from blocking content */
                    .fi-modal-close-overlay {
                        pointer-events: none !important;
                    }
                    .fi-main, .fi-sidebar, .fi-topbar, .fi-header, .fi-ta-table, .fi-resource-relation-manager {
                        position: relative;
                        z-index: 1;
                    }
                    /* Hide stuck dark overlays */
                    .fixed.inset-0.z-40[style*="opacity: 0"] {
                        display: none !important;
                    }
                </style>
                <script>
                    // Catch and suppress dispatchEvent errors on undefined elements
                    window.addEventListener("error", function(e) {
                        if (e.message && e.message.includes("dispatchEvent")) {
                            e.preventDefault();
                            e.stopPropagation();
                            console.warn("Suppressed modal dispatchEvent error");
                            // Force cleanup
                            document.querySelectorAll(".fi-modal-close-overlay, .fixed.inset-0.z-40").forEach(el => {
                                el.style.pointerEvents = "none";
                                el.style.opacity = "0";
                            });
                            return true;
                        }
                    }, true);
                </script>'
            )
            ->renderHook(
                'panels::body.end',
                fn (): string => '<script>
                    function cleanupOrphanOverlays() {
                        document.querySelectorAll(".fi-modal-close-overlay, .fixed.inset-0.z-40").forEach(overlay => {
                            const container = overlay.closest("[x-data]");
                            const modal = container?.querySelector(".fi-modal-window");
                            const isHidden = !modal || 
                                modal.style.display === "none" || 
                                window.getComputedStyle(modal).display === "none" ||
                                !modal.offsetParent;
                            if (isHidden) {
                                overlay.style.pointerEvents = "none";
                                overlay.style.opacity = "0";
                                overlay.style.display = "none";
                            }
                        });
                    }
                    
                    // Run on various events
                    document.addEventListener("DOMContentLoaded", () => setTimeout(cleanupOrphanOverlays, 500));
                    document.addEventListener("livewire:navigated", () => setTimeout(cleanupOrphanOverlays, 300));
                    document.addEventListener("livewire:morph.updated", () => setTimeout(cleanupOrphanOverlays, 300));
                    document.addEventListener("click", () => setTimeout(cleanupOrphanOverlays, 500));
                    
                    // More frequent cleanup
                    setInterval(cleanupOrphanOverlays, 1500);
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
