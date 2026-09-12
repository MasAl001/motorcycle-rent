<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Selamat datang, {{ auth()->user()->name }}.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.categories.index') }}" class="bg-white shadow-sm rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800">Kelola Kategori Motor</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus kategori motor.</p>
                </a>
                <a href="{{ route('admin.motors.index') }}" class="bg-white shadow-sm rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800">Kelola Motor</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus data motor.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
