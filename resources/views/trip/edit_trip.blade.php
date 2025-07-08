@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl max-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Trip</h3>

            <form action="/update-trip/{{ $trip->id }}" method="post" enctype="multipart/form-data" class="space-y-6">
                {{-- CSRF Token --}}
                @csrf

                {{-- judul --}}
                <div>
                    <label for="title" class="block text-s font-small text-gray-800 ">Judul <span
                            class="text-red-500">*</span> </label>
                    <input type="text" name="title" id="title"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('title') is-invalid @enderror"
                        value="{{ $trip->title }}" required>
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-s font-small text-gray-800 ">Kategori<span
                            class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('category_id') is-invalid @enderror"
                        required>
                        <option value="">-- choose Category --</option>
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

                {{-- region --}}
                <div>
                    <label for="region_id" class="block text-s font-small text-gray-800 ">Provinsi<span
                            class="text-red-500">*</span></label>
                    <select name="region_id" id="region_id"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('region_id') is-invalid @enderror"
                        required>
                        <option value="">-- choose Provinsi --</option>
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
                    <label for="description" class="block text-s font-small text-gray-800 ">Deskripsi</label>
                    <textarea name="description" id="description"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('description') is-invalid @enderror"
                        required>{{ $trip->description }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- meeting_point --}}
                <div class="mb-3">
                    <label for="meeting_point" class="block text-s font-small text-gray-800 ">Titik Kumpul<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="meeting_point" id="meeting_point"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('meeting_point') is-invalid @enderror"
                        value="{{ $trip->meeting_point }}" required>
                    @error('meeting_point')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- base price --}}
                <div>
                    <label for="base_price" class="block text-s font-small text-gray-800 ">Harga<span
                            class="text-red-500">*</span></label>
                    <input type="number" name="base_price" id="base_price"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('base_price') is-invalid @enderror"
                        value="{{ $trip->base_price }}" required>
                    @error('base_price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- quota --}}
                <div>
                    <label for="quota" class="block text-s font-small text-gray-800 ">Quota<span
                            class="text-red-500">*</span></label>
                    <input type="number" name="quota" id="quota"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('quota') is-invalid @enderror"
                        value="{{ $trip->quota }}" required>
                    @error('quota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- harga termasuk --}}
                <div>
                    <label for="includes" class="block text-s font-small text-gray-800 ">Harga Termasuk<span
                            class="text-red-500">*</span></label>
                    <textarea name="includes" id="includes"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('includes') is-invalid @enderror"
                        placeholder="Pisahkan dengan koma" required>{{ $trip->includes }}</textarea>
                    <small class="text-l text-gray-600 ">pisahkan dengan( ',' atau 'enter' )</small>
                    @error('includes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- harga tidak termasuk --}}
                <div>
                    <label for="excludes" class="block text-s font-small text-gray-800 ">Harga Tidak Termasuk<span
                            class="text-red-500">*</span></label>
                    <textarea name="excludes" id="excludes"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('excludes') is-invalid @enderror"
                        placeholder="Pisahkan dengan koma" required>{{ $trip->excludes }}</textarea>
                    <small class="text-l text-gray-600 ">pisahkan dengan( ',' atau 'enter' )</small>
                    @error('excludes')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- image --}}
                <div>
                    <label for="image" class="block text-s font-small text-gray-800 ">Gambar<span
                            class="text-red-500">*</span></label>
                    <input type="file" name="image" id="image"
                        class="mt-2 block w-full  border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 @error('image') is-invalid @enderror">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    @if ($trip->image)
                        <div class="mt-2">
                            <strong>Gambar saat ini:</strong><br>
                            <img src="{{ asset('storage/' . $trip->image) }}" alt="Gambar {{ $trip->name }}"
                                class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-s font-small text-gray-800 ">Status<span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-8 mt-2">
                       <label class="inline-flex items-center space-x-2">
                        <input class="text-black focus:ring-blue-200" type="radio" name="status" id="active" value="active"
                            {{ $trip->status == 'active' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Active</span>
                       </label>

                       <label class="inline-flex items-center space-x-2">
                        <input class="text-black focus:ring-blue-200" type="radio" name="status" id="inactive" value="inactive"
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
