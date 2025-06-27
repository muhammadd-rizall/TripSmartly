@extends('layouts.templets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-centr">
                            <div class="mb-4">
                                <h3>Input Data Trip Schedule</h3>
                            </div>


                            <form action="/update-trip-schedule/{{ $tripS->id }}" method="post" enctype="multipart/form-data">
                                @csrf


                                {{-- trip --}}
                                <div class="mb-3">
                                    <label for="trip_id" class="form-label">Trip</label>
                                    <select name="trip_id" id="trip_id"
                                        class="form-select @error('trip_id') is-invalid @enderror" required>
                                        <option value="">-- choose Trip --</option>
                                        @foreach ($tripSchedules as $tripSchedule)
                                            <option value="{{ $tripSchedule->id }}"
                                                {{ $tripS->trip_id == $tripSchedule->id ? 'selected' : '' }}>
                                                {{ $tripSchedule->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('trip_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- tanggal mulai --}}
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai*</label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ $tripS->start_date }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- tanggal akhir --}}
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Akhir*</label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ $tripS->end_date }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- kuota --}}
                                <div class="mb-3">
                                    <label for="quota" class="form-label">Quota*</label>
                                    <input type="number" name="quota" id="quota"
                                        class="form-control @error('quota') is-invalid @enderror"
                                        value="{{ $tripS->quota }}" required>
                                    @error('quota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--  price --}}
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga*</label>
                                    <input type="number" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ $tripS->price }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status*</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="open"
                                            value="open" {{$tripS->status == 'open' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="open">
                                            open
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="closed"
                                            value="closed" {{ $tripS->status == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="closed">
                                            closed
                                        </label>
                                    </div>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                {{-- Buttons --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/trip-schedule" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
