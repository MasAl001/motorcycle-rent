<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Selamat datang, {{ auth()->user()->name }}.</p>
                <p class="text-sm text-gray-500 mt-2">
                    Halaman ini masih placeholder — fitur operasional
                    (CRUD motor, kelola booking, verifikasi pembayaran, dll)
                    akan diisi bertahap mulai Phase 2.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>