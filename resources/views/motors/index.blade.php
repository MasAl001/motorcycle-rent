<x-site-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Motor</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($motors as $motor)
                <a href="{{ route('motors.show', $motor) }}" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    @if ($motor->image)
                        <img src="{{ asset('storage/' . $motor->image) }}" alt="{{ $motor->merk }} {{ $motor->model }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            Tidak ada foto
                        </div>
                    @endif

                    <div class="p-4">
                        <p class="text-xs text-gray-500">{{ $motor->category->name }}</p>
                        <h2 class="font-semibold text-gray-800">{{ $motor->merk }} {{ $motor->model }} ({{ $motor->year }})</h2>
                        <p class="text-indigo-600 font-bold mt-2">
                            Rp {{ number_format($motor->price_per_day, 0, ',', '.') }} / hari
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada motor yang tersedia.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $motors->links() }}
        </div>
    </div>
</x-site-layout>
