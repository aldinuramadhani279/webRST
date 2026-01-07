@props(['service', 'class' => 'w-full h-40 object-cover'])

@if ($service->upload_type === 'pdf' && !empty($service->file_path))
    <a href="{{ Illuminate\Support\Facades\Storage::url($service->file_path) }}" download>
        <div {{ $attributes->merge(['class' => 'w-full h-40 flex items-center justify-center bg-gray-100 text-red-500 hover:bg-gray-200 transition']) }}>
            <!-- Heroicons document-text (simplified SVG) -->
            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"></path>
                <path d="M10 12H8v2h2v-2zm4 0h-2v2h2v-2zm-4 4H8v2h2v-2zm4 0h-2v2h2v-2z"></path>
            </svg>
        </div>
    </a>
@else
    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" {{ $attributes->merge(['class' => $class]) }}>
@endif
