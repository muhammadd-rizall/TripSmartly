@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Trip</h3>

            <form action="{{route('update-trip' ,$trip->id) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-800">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        value="{{ old('title', $trip->title) }}" required>
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-800">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $trip->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Region --}}
                <div>
                    <label for="region_id" class="block text-sm font-medium text-gray-800">Provinsi <span class="text-red-500">*</span></label>
                    <select name="region_id" id="region_id"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}" {{ $trip->region_id == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-800">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        required>{{ old('description', $trip->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meeting Point --}}
                <div>
                    <label for="meeting_point" class="block text-sm font-medium text-gray-800">Titik Kumpul <span class="text-red-500">*</span></label>
                    <input type="text" name="meeting_point" id="meeting_point"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        value="{{ old('meeting_point', $trip->meeting_point) }}" required>
                    @error('meeting_point')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Base Price --}}
                <div>
                    <label for="base_price" class="block text-sm font-medium text-gray-800">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="base_price" id="base_price"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        value="{{ old('base_price', $trip->base_price) }}" required>
                    @error('base_price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quota --}}
                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-800">Quota <span class="text-red-500">*</span></label>
                    <input type="number" name="quota" id="quota"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        value="{{ old('quota', $trip->quota) }}" required>
                    @error('quota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Includes --}}
                <div>
                    <label for="includes" class="block text-sm font-medium text-gray-800">Harga Termasuk <span class="text-red-500">*</span></label>
                    <textarea name="includes" id="includes"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        placeholder="Pisahkan dengan koma" required>{{ old('includes', $trip->includes) }}</textarea>
                    <small class="text-sm text-gray-600">Pisahkan dengan ',' atau 'enter'</small>
                    @error('includes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excludes --}}
                <div>
                    <label for="excludes" class="block text-sm font-medium text-gray-800">Harga Tidak Termasuk <span class="text-red-500">*</span></label>
                    <textarea name="excludes" id="excludes"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2"
                        placeholder="Pisahkan dengan koma" required>{{ old('excludes', $trip->excludes) }}</textarea>
                    <small class="text-sm text-gray-600">Pisahkan dengan ',' atau 'enter'</small>
                    @error('excludes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-800">Gambar <span class="text-red-500">*</span></label>
                    <input type="file" name="image" id="image"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    @if ($trip->image)
                        <div class="mt-2">
                            <strong>Gambar Saat Ini:</strong><br>
                            <img src="{{ asset('storage/' . $trip->image) }}" alt="Gambar {{ $trip->title }}"
                                class="rounded shadow-md" width="150">
                        </div>
                    @endif
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800">Status <span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-8 mt-2">
                        <label class="inline-flex items-center space-x-2">
                            <input class="text-black focus:ring-blue-200" type="radio" name="status" value="active"
                                {{ $trip->status == 'active' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Active</span>
                        </label>

                        <label class="inline-flex items-center space-x-2">
                            <input class="text-black focus:ring-blue-200" type="radio" name="status" value="inactive"
                                {{ $trip->status == 'inactive' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Inactive</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between pt-6">
                    <a href="{{ route('openTrip') }}"
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
