@extends('admins.dashboard')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Trip Orders</h1>

        <div class="overflow-x-auto scrollbar-gutter-stable bg-white rounded-lg shadow">
            <table class="min-w-[1400px] w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">No</th>
                        <th class="px-4 py-3 text-left font-bold">Nama Pemesan</th>
                        <th class="px-4 py-3 text-left font-bold">Nama Trip</th>
                        <th class="px-4 py-3 text-left font-bold">Jumlah Peserta</th>
                        <th class="px-6 py-3 text-left font-bold">Total Harga</th>
                        <th class="px-6 py-3 text-left font-bold">Metode Pembayaran</th>
                        <th class="px-6 py-3 text-left font-bold">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left font-bold">Status</th>
                        <th class="px-6 py-3 text-left font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($TOs as $index => $TO)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4 text-center font-medium text-gray-900">
                                {{ $index + $TOs->firstItem() }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $TO->user->name }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $TO->rizal_trip->title }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $TO->participants }}
                            </td>
                            <td class="px-7 py-2 text-center font-semibold text-green-600">
                                Rp {{ number_format($TO->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 text-gray-900 font-medium">
                                {{ $TO->payment_methods }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ $TO->payment_status }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-4 py-4 text-center">
                                @php
                                    $statusColor = match ($TO->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200',
                                    };
                                @endphp

                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full border {{ $statusColor }}">
                                    @if ($TO->status === 'pending')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @elseif($TO->status === 'confirmed')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @elseif($TO->status === 'cancelled')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                    {{ ucfirst($TO->status) }}
                                </span>

                                <!-- STATUS ACTION BUTTONS -->
                                <div class="mt-3 flex justify-center gap-2">
                                    @if ($TO->status !== 'confirmed')
                                        <form action="{{ route('updateStatus', $TO->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-md transition duration-150 shadow-sm transform hover:scale-105">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Konfirmasi
                                            </button>
                                        </form>
                                    @endif

                                    @if ($TO->status !== 'cancelled')
                                        <form action="{{ route('updateStatus', $TO->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition duration-150 shadow-sm transform hover:scale-105">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif

                                    @if ($TO->status === 'cancelled' && $TO->status !== 'pending')
                                        <form action="{{ route('updateStatus', $TO->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-md transition duration-150 shadow-sm transform hover:scale-105">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
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
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Show
                                    </a>

                                    <form action="{{ route('deleteOr', $TO->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this trip?')">
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
            {{ $TOs->links() }}
        </div>
    </div>
@endsection
