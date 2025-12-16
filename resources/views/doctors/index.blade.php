@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Daftar Dokter</h1>
        <form action="{{ route('doctors.index') }}" method="GET">
            <select name="specialization_id" onchange="this.form.submit()" class="border-gray-300 rounded-md">
                <option value="">Semua Spesialisasi</option>
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}" {{ request('specialization_id') == $specialization->id ? 'selected' : '' }}>
                        {{ $specialization->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($doctors as $doctor)
            <a href="{{ route('doctors.show', $doctor) }}" class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">{{ $doctor->name }}</h3>
                    <p class="text-gray-600">{{ $doctor->specialization->name }}</p>
                </div>
            </a>
        @empty
            <p>Tidak ada dokter yang ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $doctors->links() }}
    </div>
@endsection
