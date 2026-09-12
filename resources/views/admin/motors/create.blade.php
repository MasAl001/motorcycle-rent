<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Motor</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.motors.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="motor_category_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('motor_category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('motor_category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Merk</label>
                    <input type="text" name="merk" value="{{ old('merk') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('merk') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" name="model" value="{{ old('model') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('model') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('color') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" name="year" value="{{ old('year') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('year') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Plat Nomor</label>
                    <input type="text" name="plate_number" value="{{ old('plate_number') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('plate_number') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @foreach (['available', 'rented', 'maintenance', 'inactive'] as $status)
                            <option value="{{ $status }}" @selected(old('status') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga / Hari (Rp)</label>
                    <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('price_per_day') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deposit (Rp)</label>
                    <input type="number" step="0.01" name="deposit" value="{{ old('deposit') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    @error('deposit') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Motor</label>
                <input type="file" name="image" class="mt-1 w-full">
                @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.motors.index') }}" class="px-4 py-2 text-sm text-gray-600">Batal</a>
                <button type="submit" class="bg-indigo-600 text-black text-sm px-4 py-2 rounded-md hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
