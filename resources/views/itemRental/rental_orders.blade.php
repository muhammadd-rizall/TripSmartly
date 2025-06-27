@extends('layouts.templets')
@section('content')
    <div class="container">
        <h1 class="mb-4">Data Rental Order</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal akhir</th>
                        <th>Status Pengembalian</th>
                        <th>Lokasi Penjemputan</th>
                        <th>Lokasi Pengantaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentalOrders as $index => $rentalOrder)
                        <tr>
                            <td>{{ $index + $rentalOrders->firstItem() }}</td>
                            <td>{{ $rentalOrder->user_id }}</td>
                            <td>{{ $rentalOrder->start_date }}</td>
                            <td>{{ $rentalOrder->end_date }}</td>
                            <td>Rp {{ number_format($rentalOrder->total_price, 2, ',', '.') }}</td>
                            <td>{{ $rentalOrder->retrun_status }}</td>
                            <td>{{ $rentalOrder->pickup_location }}</td>
                            <td>{{ $rentalOrder->delevery_location }}</td>
                            <td>{{ $rentalOrder->payment_methods }}</td>
                            <td>{{ $rentalOrder->payment_status }}</td>
                            <td>{{ $rentalOrder->status }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-sm btn-primary">Show</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $rentalOrders->links() }}
    </div>
@endsection
