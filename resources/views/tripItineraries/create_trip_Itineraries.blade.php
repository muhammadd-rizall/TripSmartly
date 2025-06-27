@extends('layouts.templets')
@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Itinerary</h3>

    <form action="/input-itinerary" method="POST">
        @csrf
        <div class="mb-3">
            <label for="trip_id" class="form-label">Pilih Trip</label>
            <select name="trip_id" id="trip_id" class="form-control" required>
                <option value="">-- Pilih Trip --</option>
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}">{{ $trip->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="day" class="form-label">Hari</label>
            <input type="text" name="day" id="day" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="activity" class="form-label">Aktivitas (Pisahkan baris per jadwal)</label>
            <textarea name="activity" id="activity" class="form-control" rows="5" required></textarea>
        </div>

        <a href="/itinerary" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>


</div>
@endsection
