@extends('admins.dashboard')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Trip Schedule</h3>

            <form action="{{route('updateSchedule', $tripS->id) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Trip --}}
                <div>
                    <label for="trip_id" class="block text-sm font-medium text-gray-800">Trip <span class="text-red-500">*</span></label>
                    <select name="trip_id" id="trip_id"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none"
                        required>
                        <option value="">-- Pilih Trip --</option>
                        @foreach ($tripSchedules as $tripSchedule)
                            <option value="{{ $tripSchedule->id }}" {{ $tripS->trip_id == $tripSchedule->id ? 'selected' : '' }}>
                                {{ $tripSchedule->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('trip_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Mulai --}}
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-800">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none"
                        value="{{ $tripS->start_date }}" required>
                    @error('start_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-800">Tanggal Akhir <span class="text-red-500">*</span></label>
                    <input type="date" name="end_date" id="end_date"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none"
                        value="{{ $tripS->end_date }}" required>
                    @error('end_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kuota --}}
                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-800">Quota <span class="text-red-500">*</span></label>
                    <input type="number" name="quota" id="quota"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none"
                        value="{{ $tripS->quota }}" required>
                    @error('quota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-800">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price"
                        class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none"
                        value="{{ $tripS->price }}" required>
                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800">Status <span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-8 mt-2">
                        <label class="inline-flex items-center space-x-2">
                            <input type="radio" name="status" value="open"
                                class="text-black focus:ring-blue-200"
                                {{ $tripS->status == 'open' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Open</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="radio" name="status" value="closed"
                                class="text-black focus:ring-blue-200"
                                {{ $tripS->status == 'closed' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Closed</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between pt-4">
                    <a href="{{ route('tripSchedule') }}"
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
