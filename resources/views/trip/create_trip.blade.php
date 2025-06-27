@extends('layouts.templets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-centr">
                            <div class="mb-4">
                                <h3>Input Data Trip</h3>
                            </div>


                            <form action="/input-trip" method="post" enctype="multipart/form-data">
                                @csrf

                                {{-- judul --}}
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul*</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" id="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- choose Category --</option>
                                        @foreach ($categories as $trip)
                                            <option value="{{ $trip->id }}"
                                                {{ old('category_id') == $trip->id ? 'selected' : '' }}>
                                                {{ $trip->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- region --}}
                                <div class="mb-3">
                                    <label for="region_id" class="form-label">Provinsi</label>
                                    <select name="region_id" id="region_id"
                                        class="form-select @error('region_id') is-invalid @enderror" required>
                                        <option value="">-- choose Provinsi --</option>
                                        @foreach ($regions as $trip)
                                            <option value="{{ $trip->id }}"
                                                {{ old('region_id') == $trip->id ? 'selected' : '' }}>
                                                {{ $trip->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- meeting_point --}}
                                <div class="mb-3">
                                    <label for="meeting_point" class="form-label">Titik Kumpul*</label>
                                    <input type="text" name="meeting_point" id="meeting_point"
                                        class="form-control @error('meeting_point') is-invalid @enderror"
                                        value="{{ old('meeting_point') }}" required>
                                    @error('meeting_point')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- base price --}}
                                <div class="mb-3">
                                    <label for="base_price" class="form-label">Harga*(100,00)</label>
                                    <input type="number" name="base_price" id="base_price"
                                        class="form-control @error('base_price') is-invalid @enderror"
                                        value="{{ old('base_price') }}" required>
                                    @error('base_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- kuota --}}
                                <div class="mb-3">
                                    <label for="quota" class="form-label">Quota*</label>
                                    <input type="number" name="quota" id="quota"
                                        class="form-control @error('quota') is-invalid @enderror"
                                        value="{{ old('quota') }}" required>
                                    @error('quota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- harga termasuk --}}
                                <div class="mb-3">
                                    <label for="includes" class="form-label">Harga Termasuk</label>
                                    <textarea name="includes" id="includes"
                                        class="form-control @error('includes') is-invalid @enderror"
                                        rows="4" placeholder="Pisahkan dengan koma" required>{{ old('includes') }}</textarea>
                                    @error('includes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- harga tidak termasuk --}}
                                <div class="mb-3">
                                    <label for="excludes" class="form-label">Harga Tidak Termasuk</label>
                                    <textarea name="excludes" id="excludes"
                                        class="form-control @error('excludes') is-invalid @enderror"
                                        rows="4" placeholder="Pisahkan dengan koma"required>{{ old('excludes') }}</textarea>
                                    @error('excludes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- image --}}
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Barang*</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image') }}" required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status*</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active"
                                            value="active" {{ old('status') == 'active' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="inactive"
                                            value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inactive">
                                            Inactive
                                        </label>
                                    </div>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                {{-- Buttons --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/trip" class="btn btn-secondary">Back</a>
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
