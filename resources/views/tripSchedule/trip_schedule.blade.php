@extends('layouts.templets')
@section('content')
    <div class="container">
        <h1 class="mb-4">Data Trip</h1>
        <a href="/create-trip-schedule" class="btn btn-primary mb-4">Tambah Trip</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Nomor</th>
                        <th>Tempat Trip</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tripSchedules as $index => $tripSchedule)
                        <tr>
                            <td>{{ $index + $tripSchedules->firstItem() }}</td>
                            <td>{{ $tripSchedule->rizal_trip->title ?? '-' }}</td>
                            <td>{{ $tripSchedule->start_date }}</td>
                            <td>{{ $tripSchedule->end_date }}</td>
                            <td>{{ $tripSchedule->quota }}</td>
                            <td>Rp {{ number_format($tripSchedule->price, 2, ',', '.') }}</td>
                            <td>{{ $tripSchedule->status }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-sm btn-primary">Show</a>
                                    <a href="/edit-trip-schedule/{{ $tripSchedule->id }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/delete-trip-schedule/{{ $tripSchedule->id }}" method="post"
                                        onsubmit="return confirm('Are you sure to delete this Item_rental?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>

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
        {{ $tripSchedules->links() }}
    </div>
@endsection
