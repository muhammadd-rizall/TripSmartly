@extends('admins.dashboard')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Item Rental</h1>

        <a href="{{ route('createItemRental') }}"
            class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow transition duration-200">
            Tambah Item Rental
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">Nomor</th>
                        <th class="px-4 py-3 text-center font-bold">Nama Barang</th>
                        <th class="px-4 py-3 text-center font-bold">Kategori</th>
                        <th class="px-4 py-3 text-center font-bold">Deskripsi</th>
                        <th class="px-4 py-3 text-center font-bold">Stok</th>
                        <th class="px-4 py-3 text-left font-bold">Lokasi Penjemputan</th>
                        <th class="px-4 py-3 text-center font-bold">Harga Perhari</th>
                        <th class="px-4 py-3 text-center font-bold">Gambar</th>
                        <th class="px-4 py-3 text-center min-w-[200px] font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($items as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4 text-center font-medium text-gray-900">
                                {{ $index + $items->firstItem() }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium text-center">{{ $item->name }}</td>
                            <td class="px-4 py-4 text-gray-900 font-medium">{{ $item->description }}</td>
                            <td class="px-4 py-4 text-gray-900 font-medium">{{ $item->rizal_rental_categories->name }}</td>
                            <td class="px-4 py-4 text-gray-900 font-medium text-center">{{ $item->stock }}</td>
                             <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $item->pickup_location }}
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-green-600">
                                Rp {{ number_format($item->price_per_day, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                        class="w-20 h-20 object-cover rounded-lg shadow-md border-gray-200">
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="#"
                                        class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Show
                                    </a>
                                    <a href="{{route('editItem', $item->id) }}"
                                        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{route('deleteItem', $item->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $items->links() }}
        </div>
    </div>
@endsection
