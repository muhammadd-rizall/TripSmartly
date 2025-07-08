@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Item Rental</h3>
            <form action="/input-rental-item" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Nama Barang --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-800">
                        Nama Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('name') ? 'border-red-500' : '' }}"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-800">Deskripsi</label>
                    <textarea name="description" id="description"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('description') ? 'border-red-500' : '' }}"
                        rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-800">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" id="stock"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('stock') ? 'border-red-500' : '' }}"
                        value="{{ old('stock') }}" required>
                    @error('stock')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga Perhari --}}
                <div class="mb-4">
                    <label for="price_per_day" class="block text-sm font-medium text-gray-800">
                        Harga Perhari <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price_per_day" id="price_per_day"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('price_per_day') ? 'border-red-500' : '' }}"
                        value="{{ old('price_per_day') }}" required>
                    @error('price_per_day')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-800">
                        Gambar Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" id="image"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('image') ? 'border-red-500' : '' }}"
                        required>
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between">
                    <a href="/rental_item"
                        class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
