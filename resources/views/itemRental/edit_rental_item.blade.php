@extends('layouts.templets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-centr">
                            <div class="mb-4">
                                <h3>Edit Data Item Rental</h3>
                            </div>


                            <form action="/update-rental/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @csrf

                                {{-- Nama barang --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Barang*</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ $item->name }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        rows="4" required>{{ $item->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- stock --}}
                                <div class="mb-3">
                                    <label for="stock" class="form-label">stock*</label>
                                    <input type="number" name="stock" id="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ $item->stock }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- price_per_day --}}
                                <div class="mb-3">
                                    <label for="price_per_day" class="form-label">Harga perhari*(100,00)</label>
                                    <input type="number" name="price_per_day" id="price_per_day"
                                        class="form-control @error('price_per_day') is-invalid @enderror"
                                        value="{{ $item->price_per_day }}" required>
                                    @error('price_per_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- image --}}
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Barang</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($item->image)
                                        <div class="mt-2">
                                            <strong>Gambar saat ini:</strong><br>
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                alt="Gambar {{ $item->name }}" class="img-thumbnail" width="150">
                                        </div>
                                    @endif
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
