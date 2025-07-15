@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Data Trip Destination</h3>

            <form action="{{ route('inputTD') }}" method="POST">
                @csrf

                {{-- Pilih Trip --}}
                <div class="mb-6">
                    <label for="trip_id" class="block text-sm font-medium text-gray-800">
                        Pilih Nama Trip <span class="text-red-500">*</span>
                    </label>
                    <select name="trip_id" id="trip_id"
                        class="mt-2 block w-full border rounded-md py-2 px-2 text-black border-gray-500 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none {{ $errors->has('trip_id') ? 'border-red-500' : '' }}"
                        required>
                        <option value="">-- Pilih Trip --</option>
                        @foreach ($trips as $trip)
                            <option value="{{ $trip->id }}" {{ old('trip_id') == $trip->id ? 'selected' : '' }}>
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
                    <textarea name="places" id="places" rows="5"
                        class="mt-2 block w-full border rounded-md py-2 px-2 text-black border-gray-500 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none {{ $errors->has('places') ? 'border-red-500' : '' }}"
                        required>{{ old('places') }}</textarea>
                    <small class="text-sm text-gray-600">Pisahkan dengan ',' atau Enter</small>
                    @error('places')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-800">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-2 block w-full border rounded-md py-2 px-2 text-black border-gray-500 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none {{ $errors->has('description') ? 'border-red-500' : '' }}"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between pt-4">
                    <a href="{{ route('tripDestination') }}"
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
