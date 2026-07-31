@extends('layouts.app')

@section('title', 'PPID')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="flex items-center gap-2 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">PPID</h1>
    </div>

    <hr class="mb-6">

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            Pejabat Pengelola Informasi dan Dokumentasi (PPID)
        </h2>
        <div class="w-16 h-1 bg-green-500 mb-4"></div>
        <p class="text-gray-600 leading-relaxed">
            Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah kepanjangan dari Pejabat Pengelola Informasi
            dan Dokumentasi, dimana PPID berfungsi sebagai pengelola dan penyampai dokumen yang dimiliki oleh badan
            publik sesuai dengan amanat UU 14/2008 tentang Keterbukaan Informasi Publik. Dengan keberadaan PPID
            maka masyarakat yang akan menyampaikan permohonan informasi lebih mudah dan tidak berbelit karena
            dilayani lewat satu pintu. Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang
            bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi
            di badan publik.
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('ppid.category', 'sk') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span>SK PPID</span>
        </a>
        <a href="{{ route('ppid.category', 'struktur') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20H4v-2a3 3 0 015.356-1.857M9 20h6m-6 0v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 20h5v-2a3 3 0 00-5.356-1.857M15 20v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 00-9.288 0"/></svg>
            <span>Struktur PPID</span>
        </a>
        <a href="{{ route('ppid.category', 'permintaan') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <span>Permintaan Informasi</span>
        </a>
        <a href="{{ route('ppid.category', 'informasi_publik') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>Informasi Publik</span>
        </a>
        <a href="{{ route('ppid.category', 'pengaduan') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>Pengaduan Layanan</span>
        </a>
        <a href="{{ route('ppid.category', 'survey') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            <span>Hasil Survey</span>
        </a>
        <a href="{{ route('ppid.category', 'tanya_jawab') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Tanya Jawab</span>
        </a>
        <a href="{{ route('ppid.category', 'informasi_umum') }}" class="ppid-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m0 0l-4-4m4 4l-4 4m0 6H5a2 2 0 01-2-2V5a2 2 0 012-2h6l2 2h6a2 2 0 012 2v1"/></svg>
            <span>Informasi Umum Layanan</span>
        </a>
        <a href="{{ route('ppid.category', 'maklumat') }}" class="ppid-btn col-span-2 md:col-span-4 justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/></svg>
            <span>Maklumat</span>
        </a>
    </div>
</div>
@endsection

@push('styles') 
<style>
.ppid-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 1.5rem;
    border-radius: 0.375rem;
    color: white;
    font-weight: 500;
    background: linear-gradient(to bottom, #7FB3C7, #5A93AD);
    transition: opacity 0.2s;
}
.ppid-btn:hover {
    opacity: 0.9;
}
</style>
@endpush