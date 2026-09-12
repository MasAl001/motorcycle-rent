<x-site-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('motors.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali ke daftar motor</a>

        <div class="mt-4 bg-white rounded-lg shadow-sm overflow-hidden md:flex">
            <div class="md:w-1/2">
                @if ($motor->image)
                    <img src="{{ asset('storage/' . $motor->image) }}" alt="{{ $motor->merk }} {{ $motor->model }}" class="w-full h-72 md:h-full object-cover">
                @else
                    <div class="w-full h-72 bg-gray-200 flex items-center justify-center text-gray-400">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            <div class="p-6 md:w-1/2">
                <p class="text-xs text-gray-500">{{ $motor->category->name }}</p>
                <h1 class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $motor->merk }} {{ $motor->model }} ({{ $motor->year }})
                </h1>
                <p class="text-gray-500 mt-1">Warna: {{ $motor->warna }}</p>

                <p class="text-2xl font-bold text-indigo-600 mt-4">
                    Rp {{ number_format($motor->price_per_day, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ hari</span>
                </p>
                <p class="text-sm text-gray-500">Deposit: Rp {{ number_format($motor->deposit, 0, ',', '.') }}</p>

                @if ($motor->description)
                    <p class="text-gray-700 mt-4">{{ $motor->description }}</p>
                @endif

                <div class="mt-6">
                    @if ($motor->status === 'available')
                        <span class="inline-block bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">Tersedia</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-500 text-sm px-3 py-1 rounded-full">Tidak tersedia saat ini</span>
                    @endif
                </div>

                <p class="text-xs text-gray-400 mt-6">
                    Fitur cek ketersediaan tanggal & booking akan aktif di Phase 3.
                </p>
            </div>
        </div>
    </div>
</x-site-layout>
