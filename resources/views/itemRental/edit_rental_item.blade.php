@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Item Rental</h3>

            <form action="/update-rental/{{ $item->id }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Nama barang --}}
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-800">
                        Nama Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('name') ? 'border-red-500' : '' }}"
                        value="{{ $item->name }}" required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="rental_categories_id" class="block text-sm font-medium text-gray-800">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="rental_categories_id" id="rental_categories_id"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('rental_categories_id') ?  'border-red-500' : '' }}"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $rental)
                            <option value="{{ $rental->id }}" {{ old('rental_categories_id') == $rental->id ? 'selected' : '' }}>
                                {{ $rental->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('rental_categories_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="block text-sm font-medium text-gray-800">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('description') ?  'border-red-500' : '' }}"
                        rows="4" required>{{ $item->description }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="mb-3">
                    <label for="stock" class="block text-sm font-medium text-gray-800">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" id="stock"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('stock') ? 'border-red-500' : '' }}"
                        value="{{ $item->stock }}" required>
                    @error('stock')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga perhari --}}
                <div class="mb-3">
                    <label for="price_per_day" class="block text-sm font-medium text-gray-800">
                        Harga Perhari <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price_per_day" id="price_per_day"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('price_per_day') ? 'border-red-500' : '' }}"
                        value="{{ $item->price_per_day }}" required>
                    @error('price_per_day')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label for="image" class="block text-sm font-medium text-gray-800">
                        Gambar Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" id="image"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{  $errors->has('image') ? 'border-red-500' : '' }}">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    @if ($item->image)
                        <div class="mt-2">
                            <strong>Gambar saat ini:</strong><br>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar {{ $item->name }}"
                                class="rounded-lg shadow-md border border-gray-200" width="150">
                        </div>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between pt-4">
                    <a href="/rental_item"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
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
