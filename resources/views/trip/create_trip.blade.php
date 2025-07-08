@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Data Trip</h3>

            <form action="/input-trip" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-800">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('title') ?  'border-red-500' : '' }}"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-800">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('category_id') ?  'border-red-500' : '' }}"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $trip)
                            <option value="{{ $trip->id }}" {{ old('category_id') == $trip->id ? 'selected' : '' }}>
                                {{ $trip->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Provinsi --}}
                <div>
                    <label for="region_id" class="block text-sm font-medium text-gray-800">
                        Provinsi <span class="text-red-500">*</span>
                    </label>
                    <select name="region_id" id="region_id"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('region_id') ? 'border-red-500' : '' }}"
                        required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($regions as $trip)
                            <option value="{{ $trip->id }}" {{ old('region_id') == $trip->id ? 'selected' : '' }}>
                                {{ $trip->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-800">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('description') ?  'border-red-500' : '' }}"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titik Kumpul --}}
                <div>
                    <label for="meeting_point" class="block text-sm font-medium text-gray-800">
                        Titik Kumpul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="meeting_point" id="meeting_point"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2  {{ $errors->has('meeting_point') ?  'border-red-500' : '' }}"
                        value="{{ old('meeting_point') }}" required>
                    @error('meeting_point')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label for="base_price" class="block text-sm font-medium text-gray-800">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="base_price" id="base_price"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('base_price') ? 'border-red-500' : '' }}"
                        value="{{ old('base_price') }}" required>
                    @error('base_price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kuota --}}
                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-800">
                        Kuota <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="quota" id="quota"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('quota') ? 'border-red-500' :  '' }}"
                        value="{{ old('quota') }}" required>
                    @error('quota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga Termasuk --}}
                <div>
                    <label for="includes" class="block text-sm font-medium text-gray-800">
                        Harga Termasuk <span class="text-red-500">*</span>
                    </label>
                    <textarea name="includes" id="includes" rows="4" placeholder="Transportasi, Akomodasi, Makan"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2  {{ $errors->has('includes') ? 'border-red-500' : '' }}"
                        required>{{ old('includes') }}</textarea>
                        <small class="text-l text-gray-600 ">pisahkan dengan( ',' atau 'enter' )</small>
                    @error('includes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga Tidak Termasuk --}}
                <div>
                    <label for="excludes" class="block text-sm font-medium text-gray-800">
                        Harga Tidak Termasuk <span class="text-red-500">*</span>
                    </label>
                    <textarea name="excludes" id="excludes" rows="4" placeholder="Obat pribadi, Uang pribadi, Dll"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('excludes') ?  'border-red-500' : '' }}"
                        required>{{ old('excludes') }}</textarea>
                        <small class="text-l text-gray-600 ">pisahkan dengan( ',' atau 'enter' )</small>
                    @error('excludes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-800">
                        Gambar Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" id="image"
                        class="mt-2 block w-full text-sm text-black border border-gray-500 rounded-md cursor-pointer focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none py-3 px-2 {{ $errors->has('image') ? 'border-red-500' : '' }}"
                        required>
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-8 mt-2">
                        <label class="inline-flex items-center space-x-2">
                            <input type="radio" name="status" value="active"
                                class="text-black focus:ring-blue-200 {{ $errors->has('status') ?  'border-red-500' : '' }}"
                                {{ old('status') == 'active' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Active</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="radio" name="status" value="inactive"
                                class="text-black focus:ring-blue-200 {{ $errors->has('status') ?  'border-red-500' : '' }}"
                                {{ old('status') == 'inactive' ? 'checked' : '' }}>
                            <span class="text-black text-sm">Inactive</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between pt-6">
                    <a href="/trip"
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
