@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Trip Itinerary</h3>

            <form action="{{route('updateIT' ,$itinerary->id )}}" method="POST">
                @csrf


                {{-- Pilih Trip --}}
                <div class="mb-4">
                    <label for="trip_id" class="block text-sm font-medium text-gray-800">
                        Pilih Trip <span class="text-red-500">*</span>
                    </label>
                    <select name="trip_id" id="trip_id"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none"
                        required>
                        <option value="">-- Pilih Trip --</option>
                        @foreach ($trips as $trip)
                            <option value="{{ $trip->id }}" {{ $itinerary->trip_id == $trip->id ? 'selected' : '' }}>
                                {{ $trip->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('trip_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Hari --}}
                <div class="mb-4">
                    <label for="day" class="block text-sm font-medium text-gray-800">
                        Hari <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="day" id="day"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none"
                        value="{{ $itinerary->day }}" required>
                    @error('day')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Aktivitas --}}
                <div class="mb-4">
                    <label for="activity" class="block text-sm font-medium text-gray-800">
                        Aktivitas <span class="text-red-500">*</span>
                    </label>
                    <textarea name="activity" id="activity"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring focus:ring-blue-200 focus:outline-none"
                        rows="5" required>{{ $itinerary->activity }}</textarea>
                    @error('activity')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between pt-4">
                    <a href="{{ route('tripItineraries') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Kembali
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
