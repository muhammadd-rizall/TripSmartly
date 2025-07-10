@extends('admins.dashboard')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Rental Orders</h1>

        <div class="overflow-x-auto scrollbar-gutter-stable bg-white rounded-lg shadow">
            <table class="min-w-[1400px] w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">No</th>
                        <th class="px-4 py-3 text-left font-bold">Nama Penyewa</th>
                        <th class="px-4 py-3 text-left font-bold">Nama Barang</th>
                        <th class="px-4 py-3 text-left font-bold">Tanggal Mulai</th>
                        <th class="px-4 py-3 text-left font-bold">Tanggal Akhir</th>
                        <th class="px-6 py-3 text-left font-bold">Total Harga</th>
                        <th class="px-4 py-3 text-left font-bold">Lokasi Penjemputan</th>
                        <th class="px-4 py-3 text-left font-bold">Lokasi Pengantaran</th>
                        <th class="px-6 py-3 text-left font-bold">Metode Pembayaran</th>
                        <th class="px-6 py-3 text-left font-bold">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left font-bold">Catatan</th>
                        <th class="px-4 py-3 text-center min-w-[400px] font-bol">Status Pengembalian</th>
                        <th class="px-4 py-3 text-center font-bold">Status Order</th>
                        <th class="px-4 py-3 text-center min-w-[200px] font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($rentalOrders as $index => $rentalOrder)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4 text-center font-medium text-gray-900">
                                {{ $index + $rentalOrders->firstItem() }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $rentalOrder->user->name }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $rentalOrder->rizal_rental_item->name }}
                            </td>
                            <td class="px-4 py-4 text-gray-900">
                                {{ $rentalOrder->start_date }}
                            </td>
                            <td class="px-4 py-4 text-gray-900">
                                {{ $rentalOrder->end_date }}
                            </td>
                            <td class="px-6 py-2 text-center font-semibold text-green-600">
                                Rp {{ number_format($rentalOrder->total_price, 0, ',', '.') }}
                            </td>



                            <td class="px-4 py-4 text-gray-700">
                                {{ $rentalOrder->pickup_location }}
                            </td>
                            <td class="px-4 py-4 text-gray-700">
                                {{ $rentalOrder->delivery_location }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $rentalOrder->payment_methods }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $rentalOrder->payment_status }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $rentalOrder->notes }}
                            </td>


                            <!-- STATUS PENGEMBALIAN -->
                            <td class="px-4 py-4 text-center">
                                @php
                                    $returnStatusColors = [
                                        'belum kembali' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'kembali' => 'bg-green-100 text-green-800 border-green-200',
                                        'terlambat' => 'bg-red-100 text-red-800 border-red-200',
                                        'hilang' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    ];

                                    $badgeColor =
                                        $returnStatusColors[$rentalOrder->retrun_status] ??
                                        'bg-gray-100 text-gray-800 border-gray-200';
                                @endphp

                                <!-- Badge Status -->
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full border {{ $badgeColor }}">
                                    {{ ucfirst($rentalOrder->retrun_status) }}
                                </span>

                                <!-- Tombol Ubah Status -->
                                <div class="mt-4 flex justify-center gap-2 flex-wrap">
                                    @foreach (['belum kembali', 'kembali', 'terlambat', 'hilang'] as $status)
                                        @if ($rentalOrder->retrun_status !== $status)
                                            <form action="/update-return-status/{{ $rentalOrder->id }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="retrun_status" value="{{ $status }}">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-xs font-semibold
                               shadow-sm hover:shadow-md transition-all duration-150
                               @if ($status == 'kembali') bg-green-500 hover:bg-green-600
                               @elseif($status == 'terlambat') bg-red-500 hover:bg-red-600
                               @elseif($status == 'hilang') bg-gray-500 hover:bg-gray-600
                               @else bg-yellow-500 hover:bg-yellow-600 @endif">
                                                    @if ($status === 'kembali')
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @elseif ($status === 'terlambat')
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 8v4l3 3" />
                                                        </svg>
                                                    @elseif ($status === 'hilang')
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 8v4l3 3" />
                                                        </svg>
                                                    @endif
                                                    {{ ucfirst($status) }}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            <!-- STATUS ORDER -->
                            <td class="px-4 py-4 text-center">
                                @php
                                    $statusColor = match ($rentalOrder->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200',
                                    };
                                @endphp

                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full border {{ $statusColor }}">
                                    {{ ucfirst($rentalOrder->status) }}
                                </span>

                                <div class="mt-4 flex justify-center gap-2 flex-wrap">
                                    @if ($rentalOrder->status !== 'confirmed')
                                        <form action="/update-order-status/{{ $rentalOrder->id }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-500 hover:bg-green-600 text-white text-xs font-semibold shadow-sm hover:shadow-md transition-all">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Konfirmasi
                                            </button>
                                        </form>
                                    @endif

                                    @if ($rentalOrder->status !== 'cancelled')
                                        <form action="/update-order-status/{{ $rentalOrder->id }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-500 hover:bg-red-600 text-white text-xs font-semibold shadow-sm hover:shadow-md transition-all">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif

                                    @if ($rentalOrder->status !== 'pending')
                                        <form action="/update-order-status/{{ $rentalOrder->id }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold shadow-sm hover:shadow-md transition-all">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4l3 3" />
                                                </svg>
                                                Pending
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="#"
                                        class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm transform hover:scale-105">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Show
                                    </a>

                                    <form action="#" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this rental order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm transform hover:scale-105">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
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
            {{ $rentalOrders->links() }}
        </div>
    </div>
@endsection
