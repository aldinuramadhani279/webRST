@extends('layouts.app')

@section('title', $label)

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="flex items-center gap-2 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $label }}</h1>
        <span class="text-gray-400 text-sm ml-4">HOME</span>
        <span class="text-gray-400">→</span>
        <a href="{{ route('ppid.index') }}" class="text-gray-400 text-sm hover:text-blue-600">PPID</a>
        <span class="text-gray-400">→</span>
        <span class="text-gray-400 text-sm">{{ $label }}</span>
    </div>

    <hr class="mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($items as $item)
            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="ppid-box">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ $item->title }}</span>
            </a>
        @empty
            <p class="text-gray-500 col-span-2">Belum ada dokumen untuk {{ $label }}.</p>
        @endforelse
    </div>
</div>
@endsection