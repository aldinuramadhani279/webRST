<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceObserver
{
    /**
     * Handle the Service "saved" event.
     *
     * @return void
     */
    public function saved(Service $service)
    {
        Cache::forget('services.featured');
        Cache::forget('services.other');
        Cache::forget('home_services');
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @return void
     */
    public function deleted(Service $service)
    {
        Cache::forget('services.featured');
        Cache::forget('services.other');
        Cache::forget('home_services');
    }
}
