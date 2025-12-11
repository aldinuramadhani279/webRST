@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="w-full rounded-lg shadow-md">
        </div>
        <div class="md:col-span-2">
            <h1 class="text-4xl font-bold">{{ $doctor->name }}</h1>
            <p class="text-2xl text-gray-600">{{ $doctor->specialization->name }}</p>
            <p class="text-lg mt-2">Nomor SIP: {{ $doctor->sip_number }}</p>

            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Bio</h2>
                <div class="prose max-w-none">
                    {!! $doctor->bio !!}
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Jadwal Praktik</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Hari</th>
                                <th class="text-left py-2">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctor->schedules as $schedule)
                                <tr class="border-b">
                                    <td class="py-2">{{ $schedule->day }}</td>
                                    <td class="py-2">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-2">Jadwal tidak tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
