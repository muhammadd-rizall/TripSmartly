@extends('layouts.templets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-centr">
                            <div class="mb-4">
                                <h3>Input Data Item Rental</h3>
                            </div>


                            <form action="/input-rental-item" method="post" enctype="multipart/form-data">
                                @csrf

                                {{-- Nama barang --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Barang*</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- stock --}}
                                <div class="mb-3">
                                    <label for="stock" class="form-label">stock*</label>
                                    <input type="number" name="stock" id="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock') }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- price_per_day --}}
                                <div class="mb-3">
                                    <label for="price_per_day" class="form-label">Harga perhari*</label>
                                    <input type="number" name="price_per_day" id="price_per_day"
                                        class="form-control @error('price_per_day') is-invalid @enderror"
                                        value="{{ old('price_per_day') }}" required>
                                    @error('price_per_day')
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


                                {{-- Buttons --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/rental_item" class="btn btn-secondary">Back</a>
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
