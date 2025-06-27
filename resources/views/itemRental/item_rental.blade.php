@extends('layouts.templets')
@section('content')
    <div class="container">
        <h1 class="mb-4">Data Item rental</h1>
        <a href="/create-item-rental" class="btn btn-primary mb-4">Tambah Item Rental</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Harga Perhari</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            <td>{{ $index + $items->firstItem() }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>Rp {{ number_format($item->price_per_day, 2, ',', '.') }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" width="80">
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-sm btn-primary">Show</a>
                                    <a href="/edit-rental/{{ $item->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/delete-rental/{{ $item->id }}" method="post"
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
        {{ $items->links() }}
    </div>
@endsection
