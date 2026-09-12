<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Kategori Motor</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm">{{ session('error') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-md hover:bg-indigo-700">
                + Tambah Kategori
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Jumlah Motor</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $category->slug }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $category->motors_count }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
