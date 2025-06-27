@extends('layouts.templets')
@section('content')
    <div class="container">
        <h1 class="mb-4">Data Item rental</h1>
        <a href="/createTD" class="btn btn-primary mb-4">Tambah Item Rental</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Trip</th>
                        <th>Nama Destinasi</th>
                        <th>deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tds as $index => $td)
                        <tr>
                            <td>{{ $index + $tds->firstItem() }}</td>
                            <td>{{ $td->rizal_trip->title }}</td>
                            <td>
                                <ul class="mb-0">
                                    @foreach (explode(',', $td->place_name) as $place)
                                        <li>{{ trim($place) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $td->description }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-sm btn-primary">Show</a>
                                    <a href="/editTD/{{ $td->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/deleteTD/{{ $td->id }}" method="post"
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
        {{ $tds->links() }}
    </div>
@endsection
