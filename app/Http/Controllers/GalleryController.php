<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Video;

class GalleryController extends Controller
{
    /**
     * Display the photo gallery page.
     */
    public function photos()
    {
        $albums = Album::with('photos')->latest()->get();

        return view('gallery.photos', compact('albums'));
    }

    /**
     * Display the video gallery page.
     */
    public function videos()
    {
        $videos = Video::latest()->get();

        return view('gallery.videos', compact('videos'));
    }
}
