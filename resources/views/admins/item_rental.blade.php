@extends('layouts.templets')
@section('content')

    <div class="container">
        <div class="mb-4">
            <div class="table-responsive">
                <div class="table table-bordered table-striped align-middle"></div>
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
                    @foreach ($items as $index => $item )
                    <tr>
                        <td>{{ $index + $items->firstItem() }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->price_per_day }}</td>
                        <td>{{ $item->image }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="#" class="btn btn-sm btn-primary">Show</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                @can('delete')
                                        <form action="#" method="POST" onsubmit="return confirm('Are you sure to delete this Item_rental')" >
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                @endcan
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $items->links() }}
    </div>
@endsection
