<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    /**
     * Display a listing of featured services.
     */
    public function featured()
    {
        $services = Cache::remember('services.featured', now()->addHour(), function () {
            return Service::where('is_featured', true)->orderBy('title')->get();
        });

        return view('services.featured', compact('services'));
    }

    /**
     * Display a listing of other services.
     */
    public function other()
    {
        $services = Cache::remember('services.other', now()->addHour(), function () {
            return Service::where('is_featured', false)->orderBy('title')->get();
        });

        return view('services.other', compact('services'));
    }
}
