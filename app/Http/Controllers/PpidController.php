<?php

namespace App\Http\Controllers;

use App\Models\Ppid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Abort;

class PpidController extends Controller
{
    protected array $categories = [
        'sk' => 'SK PPID',
        'struktur' => 'Struktur PPID',
        'permintaan' => 'Permintaan Informasi',
        'informasi_publik' => 'Informasi Publik',
        'pengaduan' => 'Pengaduan Layanan',
        'survey' => 'Hasil Survey',
        'tanya_jawab' => 'Tanya Jawab',
        'informasi_umum' => 'Informasi Umum Layanan',
        'maklumat' => 'Maklumat',
    ];

    public function index()
    {
        return view('ppid.index');
    }

    public function category(string $category)
    {
    abort_unless(array_key_exists($category, $this->categories), 404);

    $items = Ppid::where('category', $category)->latest()->get();
    $label = $this->categories[$category];

    // If there's exactly one file, redirect straight to it
    if ($items->count() === 1 && $items->first()->file) {
        return redirect(asset('storage/' . $items->first()->file));
    }
    return view('ppid.category', compact('items', 'label', 'category'));
    }
}