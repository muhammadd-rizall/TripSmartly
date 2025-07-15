@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Trip Destination</h3>
            <form action="{{route('updateTd' ,$td->id) }}" method="POST" enctype="multipart/form-data">
                @csrf


                {{-- Pilih Trip --}}
                <div class="mb-6">
                    <label for="trip_id" class="block text-sm font-medium text-gray-800">
                        Pilih Nama Trip <span class="text-red-500">*</span>
                    </label>
                    <select name="trip_id" id="trip_id"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none "
                        required>
                        <option value="">-- Pilih Trip --</option>
                        @foreach ($trips as $trip)
                            <option value="{{ $trip->id }}" {{ $trip->id == $td->trip_id ? 'selected' : '' }}>
                                {{ $trip->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('trip_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tempat Destinasi --}}
                <div class="mb-6">
                    <label for="places" class="block text-sm font-medium text-gray-800">
                        Masukkan Tempat Destinasi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="places" id="places"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none "
                        rows="5" required>{{ old('places', $td->place_name) }}</textarea>
                    <small class="text-sm text-gray-600">Pisahkan dengan ',' atau Enter</small>
                    @error('places')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-800">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none "
                        rows="3" required>{{ old('description', $td->description) }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between pt-4">
                    <a href="{{ route('tripDestination') }}"
                        class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
