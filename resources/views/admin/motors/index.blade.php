<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Motor</h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm">{{ session('error') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.motors.create') }}" class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-md hover:bg-indigo-700">
                + Tambah Motor
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Motor</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Plat</th>
                        <th class="px-4 py-3">Harga/Hari</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($motors as $motor)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $motor->merk }} {{ $motor->model }} ({{ $motor->year }})</td>
                            <td class="px-4 py-3 text-gray-500">{{ $motor->category->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $motor->plate_number }}</td>
                            <td class="px-4 py-3 text-gray-500">Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span @class([
                                    'text-xs px-2 py-1 rounded-full',
                                    'bg-green-100 text-green-700' => $motor->status === 'available',
                                    'bg-yellow-100 text-yellow-700' => $motor->status === 'rented',
                                    'bg-orange-100 text-orange-700' => $motor->status === 'maintenance',
                                    'bg-gray-100 text-gray-500' => $motor->status === 'inactive',
                                ])>
                                    {{ $motor->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.motors.edit', $motor) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.motors.destroy', $motor) }}" method="POST" class="inline" onsubmit="return confirm('Hapus motor ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">Belum ada motor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $motors->links() }}
        </div>
    </div>
</x-app-layout>
