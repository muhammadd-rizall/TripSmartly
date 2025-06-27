@extends('layouts.templets')
@section('content')
<div class="container">
    <h3 class="mb-4">Data Itinerary</h3>
    <a href="/create-itinerary" class="btn btn-primary mb-3">Tambah Itinerary</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Trip</th>
                <th>Hari</th>
                <th>Aktivitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itineraries as $index => $item)
            <tr>
                <td>{{ $index + $itineraries->firstItem() }}</td>
                <td>{{ $item->rizal_trip->title }}</td>
                <td>{{ $item->day }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach(explode(',', $item->activity) as $line)
                            <li>{{ trim($line) }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="/edit-itinerary/{{ $item->id }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/delete-itinerary/{{ $item->id }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $itineraries->links() }}
</div>
@endsection
