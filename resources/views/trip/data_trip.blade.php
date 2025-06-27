@extends('layouts.templets')
@section('content')
    <div class="container">
        <h1 class="mb-4">Data Trip</h1>
        <a href="/create-trip" class="btn btn-primary mb-4">Tambah Trip</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Nomor</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th>Titik Kumpul</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th>Harga Termasuk</th>
                        <th>Harga Tidak Termasuk</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $index => $trip)
                        <tr>
                            <td>{{ $index + $trips->firstItem() }}</td>
                            <td>{{ $trip->title }}</td>
                            <td>{{ $trip->rizal_categories->name }}</td>
                            <td>{{ $trip->rizal_regions->name }}</td>
                            <td>{{ $trip->description }}</td>
                            <td>{{ $trip->meeting_point }}</td>
                            <td>Rp {{ number_format($trip->base_price, 2, ',', '.') }}</td>
                            <td>{{ $trip->quota }}</td>
                            <td>
                                @foreach (explode(',', $trip->includes) as $item)
                                    - {{ trim($item) }} <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach (explode(',', $trip->excludes) as $item)
                                    - {{ trim($item) }} <br>
                                @endforeach
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $trip->image) }}" alt="{{ $trip->name }}" width="80">
                            </td>
                            <td>{{ $trip->status }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-sm btn-primary">Show</a>
                                    <a href="/edit-trip/{{ $trip->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/delete-trip/{{ $trip->id }}" method="post"
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
        {{ $trips->links() }}
    </div>
@endsection
