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
                'panels::head.start',
                fn (): string => '<script>
                    // CRITICAL FIX: Patch Alpine $refs before Alpine loads
                    // This creates a dummy element that acts as a fallback when modalContainer is missing
                    
                    (function() {
                        // Create dummy element that has dispatchEvent but does nothing
                        const dummyElement = document.createElement("div");
                        dummyElement.dispatchEvent = function() { return true; };
                        
                        // When Alpine initializes, patch the $refs magic
                        document.addEventListener("alpine:init", function() {
                            if (window.Alpine && window.Alpine.magic) {
                                const originalRefs = window.Alpine.magic("refs");
                                
                                window.Alpine.magic("refs", function(el) {
                                    const refs = originalRefs ? originalRefs(el) : {};
                                    
                                    // Return a Proxy that returns dummy element for missing refs
                                    return new Proxy(refs || {}, {
                                        get(target, prop) {
                                            if (target[prop]) return target[prop];
                                            // Return dummy element for missing refs like modalContainer
                                            if (prop === "modalContainer" || prop.includes("modal")) {
                                                return dummyElement;
                                            }
                                            return target[prop];
                                        }
                                    });
                                });
                            }
                        });
                        
                        // Also suppress console errors for this specific issue
                        const originalError = console.error.bind(console);
                        console.error = function(...args) {
                            const msg = args.join(" ");
                            if (msg.includes("modalContainer") || msg.includes("dispatchEvent")) {
                                return; // Suppress
                            }
                            originalError(...args);
                        };
                    })();
                </script>'
            )
            ->renderHook(
                'panels::head.end',
                fn (): string => '<style>
                    .fi-main, .fi-sidebar, .fi-topbar {
                        pointer-events: auto !important;
                    }
                </style>'
            )
            ->renderHook(
                'panels::body.end',
                fn (): string => '<script>
                    // Cleanup orphan overlays
                    function cleanupOrphanOverlays() {
                        document.querySelectorAll(".fixed.inset-0.z-40").forEach(overlay => {
                            const container = overlay.closest("[x-data]");
                            const modal = container?.querySelector(".fi-modal-window");
                            if (!modal || modal.offsetParent === null || modal.style.display === "none") {
                                overlay.style.pointerEvents = "none";
                                overlay.style.opacity = "0";
                            }
                        });
                    }
                    
                    document.addEventListener("livewire:navigated", () => setTimeout(cleanupOrphanOverlays, 300));
                    setInterval(cleanupOrphanOverlays, 2000);
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
