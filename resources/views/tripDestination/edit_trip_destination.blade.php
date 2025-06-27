@extends('layouts.templets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h3>Edit Data Destinasi Trip</h3>
                        </div>

                        <form action="/updateTD/{{ $td->id }}" method="POST">
                            @csrf

                            {{-- Pilih Trip --}}
                            <div class="mb-3">
                                <label for="trip_id" class="form-label">Pilih Nama Trip</label>
                                <select name="trip_id" id="trip_id" class="form-control" required>
                                    @foreach ($trips as $trip)
                                        <option value="{{ $trip->id }}"
                                            {{ $trip->id == $td->trip_id ? 'selected' : '' }}>
                                            {{ $trip->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tempat Destinasi --}}
                            <div class="mb-3">
                                <label for="places" class="form-label">Masukkan Tempat Destinasi (satu per baris)</label>
                                <textarea name="places" id="places" class="form-control" rows="5" required>{{ str_replace(', ', "\n", $td->place_name) }}</textarea>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required>{{ $td->description }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/trip-destination" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
